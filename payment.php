<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");

// Get sale_id from URL
if (!isset($_GET['sale_id'])) {
  echo "No sale selected!";
  exit();
}
$sale_id = intval($_GET['sale_id']);

// Get sale details WITH payment information
$saleQuery = "
  SELECT 
    s.Sale_ID,
    s.S_Date,
    s.S_Time,
    s.Total_Amount,
    s.Payment_Method,
    s.payment_reference,
    s.payment_status,
    CONCAT(c.C_Fname, ' ', c.C_Lname) AS customer_name
  FROM sales s
  LEFT JOIN customer c ON s.C_ID = c.C_ID
  WHERE s.Sale_ID = $sale_id
";
$saleResult = $conn->query($saleQuery);

if (!$saleResult || $saleResult->num_rows == 0) {
    echo "Sale not found!";
    exit();
}

$sale = $saleResult->fetch_assoc();

// Get sale items
$itemQuery = "
  SELECT 
    m.Med_Name,
    si.Sale_Qty,
    m.Med_Price,
    si.Tot_Price
  FROM sales_items si
  JOIN medicine m ON si.Med_ID = m.Med_ID
  WHERE si.Sale_ID = $sale_id
";
$itemResult = $conn->query($itemQuery);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Invoice #<?= $sale_id ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    
  * {
    margin: 0;
    padding: 0;
    box-sizing: 50px;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: light-gray;
    padding: 20px;
  }

  .invoice-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    border-radius: 15px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    overflow: hidden;
  }

  .invoice-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 30px;
    text-align: center;
  }

  .invoice-header h1 {
    font-size: 32px;
    margin-bottom: 5px;
  }

  .invoice-header p {
    opacity: 0.9;
    font-size: 16px;
  }

  .invoice-body {
    padding: 30px;
  }

  .invoice-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
  }

  .info-item {
    display: flex;
    flex-direction: column;
  }

  .info-label {
    font-size: 12px;
    color: #6c757d;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 5px;
  }

  .info-value {
    font-size: 16px;
    color: #2c3e50;
    font-weight: 600;
  }

  /* Payment Method Badge */
  .payment-section {
    background: #e8f5e9;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    border-left: 4px solid #28a745;
  }

  .payment-method-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: bold;
    font-size: 16px;
    margin-top: 10px;
  }
  
  .payment-cash {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
  }
  
  .payment-esewa {
    background: linear-gradient(135deg, #60bb46, #4a9d35);
    color: white;
  }
  
  .payment-bank {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
  }
  
  .payment-credit {
    background: linear-gradient(135deg, #ffc107, #ff9800);
    color: #333;
  }

  .payment-method-badge i {
    font-size: 20px;
  }
  
  .payment-reference {
    margin-top: 10px;
    padding: 10px;
    background: white;
    border-radius: 8px;
    font-size: 14px;
  }

  .payment-reference strong {
    color: #495057;
  }

  .payment-status {
    margin-top: 15px;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    text-align: center;
    font-size: 16px;
  }
  
  .status-paid {
    background: #d4edda;
    color: #155724;
    border: 2px solid #c3e6cb;
  }
  
  .status-pending {
    background: #fff3cd;
    color: #856404;
    border: 2px solid #ffeeba;
  }

  /* Items Table */
  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 20px 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  table thead {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
  }

  table th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
  }

  table tbody tr {
    background: white;
    border-bottom: 1px solid #e9ecef;
  }

  table tbody tr:hover {
    background: #f8f9fa;
  }

  table td {
    padding: 15px;
  }

  table tbody tr:last-child {
    border-bottom: none;
  }

  .total-row {
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    color: white !important;
    font-weight: bold;
    font-size: 18px;
  }

  .total-row td {
    padding: 20px 15px;
  }

  /* Footer */
  .invoice-footer {
    text-align: center;
    padding: 20px;
    background: #f8f9fa;
    border-top: 2px dashed #dee2e6;
    margin-top: 30px;
  }

  .invoice-footer p {
    color: #6c757d;
    margin: 5px 0;
  }

  /* Buttons */
  .button-container {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 30px;
  }

  .btn {
    padding: 12px 30px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
  }

  .btn-print {
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
  }

  .btn-back {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
  }

  .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
  }

  @media print {
    body {
      background: white;
    }
    
    .button-container,
    .btn {
      display: none !important;
    }
    
    .invoice-container {
      box-shadow: none;
      border-radius: 0;
    }
  }
  </style>
</head>
<body>
  <div class="invoice-container">
    
    <!-- Invoice Header -->
    <div class="invoice-header">
      <h1>Master Pharmacy - Your Health Partner</h1>
    </div>

    <!-- Invoice Body -->
    <div class="invoice-body">
      
      <!-- Invoice Info Grid -->
      <div class="invoice-info">
        <div class="info-item">
          <span class="info-label">Invoice Number</span>
          <span class="info-value">#<?= str_pad($sale['Sale_ID'], 6, '0', STR_PAD_LEFT) ?></span>
        </div>
        
        <div class="info-item">
          <span class="info-label">Date & Time</span>
          <span class="info-value"><?= date('M d, Y', strtotime($sale['S_Date'])) ?> | <?= date('g:i A', strtotime($sale['S_Time'])) ?></span>
        </div>
        
        <div class="info-item">
          <span class="info-label">Customer Name</span>
          <span class="info-value"><?= $sale['customer_name'] ?? 'Walk-in Customer' ?></span>
        </div>
        
        <div class="info-item">
          <span class="info-label">Total Amount</span>
          <span class="info-value" style="color: #28a745; font-size: 20px;">Rs. <?= number_format($sale['Total_Amount'], 2) ?></span>
        </div>
      </div>

      <!-- Payment Information Section -->
      <div class="payment-section">
        <h3 style="color: #155724; margin-bottom: 15px; font-size: 18px;">
          <i class="fas fa-credit-card"></i> Payment Information
        </h3>
        
        <div>
          <span class="info-label">Payment Method:</span>
          <div>
            <?php
            $payment_method = $sale['Payment_Method'] ?? 'Cash';
            $icons = [
              'Cash' => 'fa-money-bill-wave',
              'eSewa' => 'fa-mobile-alt',
              'Bank' => 'fa-university',
              'Credit' => 'fa-credit-card'
            ];
            $icon = $icons[$payment_method] ?? 'fa-money-bill';
            ?>
            <span class="payment-method-badge payment-<?= strtolower($payment_method) ?>">
              <i class="fas <?= $icon ?>"></i>
              <?= $payment_method ?>
            </span>
          </div>
        </div>
        
        <?php if (!empty($sale['payment_reference'])): ?>
          <div class="payment-reference">
            <strong>Reference Details:</strong><br>
            <?= htmlspecialchars($sale['payment_reference']) ?>
          </div>
        <?php endif; ?>
        
        <?php 
        $payment_status = $sale['payment_status'] ?? 'Paid';
        ?>
        <div class="payment-status status-<?= strtolower($payment_status) ?>">
          <?php if ($payment_status === 'Paid'): ?>
            <i class="fas fa-check-circle"></i> PAYMENT COMPLETED
          <?php else: ?>
            <i class="fas fa-clock"></i> PAYMENT PENDING
          <?php endif; ?>
        </div>
      </div>

      <!-- Items Table -->
      <h3 style="color: #2c3e50; margin: 25px 0 15px 0;">
        <i class="fas fa-pills"></i> Purchased Items
      </h3>
      
      <table>
        <thead>
          <tr>
            <th>Medicine</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($item = $itemResult->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($item['Med_Name']) ?></td>
              <td><?= $item['Sale_Qty'] ?></td>
              <td>Rs. <?= number_format($item['Med_Price'], 2) ?></td>
              <td>Rs. <?= number_format($item['Tot_Price'], 2) ?></td>
            </tr>
          <?php endwhile; ?>
          
          <tr class="total-row">
            <td colspan="3" style="text-align: right;">GRAND TOTAL</td>
            <td>Rs. <?= number_format($sale['Total_Amount'], 2) ?></td>
          </tr>
        </tbody>
      </table>

      <!-- Invoice Footer -->
      <div class="invoice-footer">
        <p><strong>Thank you for your purchase!</strong></p>
        <p>Master Pharmacy - Geta-5, Attriya, Nepal</p>
        <p>Phone: +977 981-8738232 | Email: mastercare2@gmail.com</p>
      </div>

      <!-- Action Buttons -->
      <div class="button-container">
        <button onclick="window.print()" class="btn btn-print">
          <i class="fas fa-print"></i> Print Invoice
        </button>
        <a href="sales.php" class="btn btn-back">
          <i class="fas fa-arrow-left"></i> Back to Sales
        </a>
      </div>

    </div>
  </div>

</body>
</html>