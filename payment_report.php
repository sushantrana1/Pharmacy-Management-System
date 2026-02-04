<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  die('
    <div style="display:flex; flex-direction:column; justify-content:center; align-items:center; height:100vh; gap:20px;">
      <h2 style="color:red;">Access Denied: Admin Only.</h2>

      <a href="dashboard.php"
        style="padding: 10px 16px; background: #3498db; color: white; text-decoration: none; border-radius: 6px;">
        Back
      </a>
    </div>
  ');
}


$conn = new mysqli("localhost", "root", "", "pharmacy");

// Get date filter
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d');
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d');

// Get payment method summary
$summary = $conn->query("
  SELECT 
    SUM(CASE WHEN payment_method = 'Cash' THEN Total_Amount ELSE 0 END) as cash_total,
    SUM(CASE WHEN payment_method = 'eSewa' THEN Total_Amount ELSE 0 END) as esewa_total,
    SUM(CASE WHEN payment_method = 'Bank' THEN Total_Amount ELSE 0 END) as bank_total,
    SUM(CASE WHEN payment_method = 'Credit' THEN Total_Amount ELSE 0 END) as credit_total,
    SUM(Total_Amount) as grand_total
  FROM sales
  WHERE S_Date BETWEEN '$date_from' AND '$date_to'
")->fetch_assoc();

// Get detailed transactions
$transactions = $conn->query("
  SELECT 
    s.Sale_ID,
    s.S_Date,
    s.S_Time,
    CONCAT(c.C_Fname, ' ', c.C_Lname) as customer_name,
    s.Total_Amount,
    s.payment_method,
    s.payment_reference,
    s.payment_status
  FROM sales s
  LEFT JOIN customer c ON s.C_ID = c.C_ID
  WHERE s.S_Date BETWEEN '$date_from' AND '$date_to'
  ORDER BY s.S_Date DESC, s.S_Time DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Report</title>
  <link rel="stylesheet" href="css/sales_report.css">
  <style>
  .summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin: 20px 0;
  }
  
  .summary-card {
    padding: 20px;
    border-radius: 10px;
    color: white;
    text-align: center;
  }
  
  .summary-card.cash { background: linear-gradient(135deg, #28a745, #20c997); }
  .summary-card.esewa { background: linear-gradient(135deg, #60bb46, #4a9d35); }
  .summary-card.bank { background: linear-gradient(135deg, #007bff, #0056b3); }
  .summary-card.credit { background: linear-gradient(135deg, #ffc107, #ff9800); }
  .summary-card.total { background: linear-gradient(135deg, #6f42c1, #5a32a3); }
  
  .summary-card h3 {
    font-size: 16px;
    margin-bottom: 10px;
    opacity: 0.9;
  }
  
  .summary-card .amount {
    font-size: 28px;
    font-weight: bold;
  }
  
  .filter-box {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
  }
  
  .payment-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
  }
  
  .badge-cash { background: #28a745; color: white; }
  .badge-esewa { background: #60bb46; color: white; }
  .badge-bank { background: #007bff; color: white; }
  .badge-credit { background: #ffc107; color: #333; }
  </style>
</head>
<body>
  
  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php" style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2>💳 Payment Methods Report</h2>
  
  <!-- Date Filter -->
  <div class="filter-box">
    <form method="GET" style="display: flex; gap: 10px; align-items: end;">
      <div>
        <label>From Date:</label>
        <input type="date" name="date_from" value="<?= $date_from ?>" required>
      </div>
      <div>
        <label>To Date:</label>
        <input type="date" name="date_to" value="<?= $date_to ?>" required>
      </div>
      <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Filter</button>
    </form>
  </div>

  <!-- Summary Cards -->
  <div class="summary-cards">
    <div class="summary-card cash">
      <h3>💵 Cash</h3>
      <div class="amount">Rs. <?= number_format($summary['cash_total'], 2) ?></div>
    </div>
    
    <div class="summary-card esewa">
      <h3>📱 eSewa</h3>
      <div class="amount">Rs. <?= number_format($summary['esewa_total'], 2) ?></div>
    </div>
    
    <div class="summary-card bank">
      <h3>🏦 Bank</h3>
      <div class="amount">Rs. <?= number_format($summary['bank_total'], 2) ?></div>
    </div>
    
    <div class="summary-card credit">
      <h3>💳 Credit</h3>
      <div class="amount">Rs. <?= number_format($summary['credit_total'], 2) ?></div>
    </div>
    
    <div class="summary-card total">
      <h3>💰 Total</h3>
      <div class="amount">Rs. <?= number_format($summary['grand_total'], 2) ?></div>
    </div>
  </div>

  <!-- Detailed Transactions -->
  <h3>Transaction Details</h3>
  <table>
    <tr>
      <th>Sale ID</th>
      <th>Date</th>
      <th>Customer</th>
      <th>Amount</th>
      <th>Payment Method</th>
      <th>Reference</th>
      <th>Status</th>
    </tr>
    <?php while ($t = $transactions->fetch_assoc()): ?>
    <tr>
      <td><?= $t['Sale_ID'] ?></td>
      <td><?= $t['S_Date'] ?> <?= $t['S_Time'] ?></td>
      <td><?= $t['customer_name'] ?? 'Guest' ?></td>
      <td>Rs. <?= number_format($t['Total_Amount'], 2) ?></td>
      <td>
        <span class="payment-badge badge-<?= strtolower($t['payment_method']) ?>">
          <?= $t['payment_method'] ?>
        </span>
      </td>
      <td><?= $t['payment_reference'] ?? '-' ?></td>
      <td><?= $t['payment_status'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>

  <div style="text-align: right; margin-top: 20px;">
    <button onclick="window.print()" style="padding: 10px 20px; background: green; color: white; border: none; border-radius: 5px; cursor: pointer;">Print Report</button>
  </div>

</body>
</html>