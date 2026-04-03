<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");

if (!isset($_GET['sale_id'])) {
  echo "No sale selected!";
  exit();
}
$sale_id = intval($_GET['sale_id']);

// Get sale details WITH payment info
$saleQuery = "
  SELECT 
    s.Sale_ID,
    s.S_Date,
    s.S_Time,
    s.Total_Amount,
    s.payment_method,
    s.payment_reference,
    s.payment_status,
    CONCAT(c.C_Fname, ' ', c.C_Lname) AS customer_name
  FROM sales s
  LEFT JOIN customer c ON s.C_ID = c.C_ID
  WHERE s.Sale_ID = $sale_id
";
$saleResult = $conn->query($saleQuery);
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
  <title>Payment Invoice</title>
  <link rel="stylesheet" href="css/payment.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <div class="invoice-box">
    <h2>Master Pharmacy - Payment Invoice</h2>

    <p><b>Sale ID:</b> <?= $sale['Sale_ID'] ?></p>
    <p><b>Customer:</b> <?= $sale['customer_name'] ?? 'Guest' ?></p>
    <p><b>Date:</b> <?= $sale['S_Date'] ?> | <b>Time:</b> <?= $sale['S_Time'] ?></p>
    
    <!-- Payment Method Display -->
    <div>
      <b>Payment Method:</b>
      <span class="payment-method-badge payment-<?= strtolower($sale['payment_method']) ?>">
        <?php
        $icons = [
          'Cash' => 'fa-money-bill-wave',
          'eSewa' => 'fa-mobile-alt',
          'Bank' => 'fa-university',
          'Credit' => 'fa-credit-card'
        ];
        $icon = $icons[$sale['payment_method']] ?? 'fa-money-bill';
        ?>
        <i class="fas <?= $icon ?>"></i> <?= $sale['payment_method'] ?>
      </span>
    </div>
    
    <?php if ($sale['payment_reference']): ?>
      <p><b>Reference:</b> <?= htmlspecialchars($sale['payment_reference']) ?></p>
    <?php endif; ?>
    
    <div class="payment-status status-<?= strtolower($sale['payment_status']) ?>">
      Status: <?= $sale['payment_status'] === 'Paid' ? 'PAID' : 'PENDING' ?>
    </div>

    <table>
      <tr>
        <th>Medicine</th>
        <th>Qty</th>
        <th>Unit Price</th>
        <th>Total</th>
      </tr>
      <?php while ($item = $itemResult->fetch_assoc()): ?>
        <tr>
          <td><?= $item['Med_Name'] ?></td>
          <td><?= $item['Sale_Qty'] ?></td>
          <td>Rs. <?= $item['Med_Price'] ?></td>
          <td>Rs. <?= $item['Tot_Price'] ?></td>
        </tr>
      <?php endwhile; ?>
      <tr class="total">
        <td colspan="3">Grand Total</td>
        <td>Rs. <?= $sale['Total_Amount'] ?></td>
      </tr>
    </table>

    <div class="footer">
      Thank you for your purchase! <br>
      Master Pharmacy
    </div>

    <div style="text-align:right;">
      <button class="btn-print" onclick="window.print()">Print Invoice</button>
    </div>
  </div>

</body>
</html>