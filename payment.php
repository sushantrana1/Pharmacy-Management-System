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

// Get sale details (without employee)
$saleQuery = "
  SELECT 
    s.Sale_ID,
    s.S_Date,
    s.S_Time,
    s.Total_Amount,
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
    <h2>🧾 Master Pharmacy - Payment Invoice</h2>

    <p><b>Sale ID:</b> <?= $sale['Sale_ID'] ?></p>
    <p><b>Customer:</b> <?= $sale['customer_name'] ?? 'Guest' ?></p>
    <p><b>Date:</b> <?= $sale['S_Date'] ?> | <b>Time:</b> <?= $sale['S_Time'] ?></p>

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