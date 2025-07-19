<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");

// JOIN sales + sales_items + medicine + employee + customer
$query = "
  SELECT 
  s.Sale_ID,
  m.Med_Name,
  si.Sale_Qty,
  m.Med_Price,
  si.Tot_Price,
  CONCAT(e.E_Fname, ' ', e.E_Lname) AS employee_name,
  CONCAT(c.C_Fname, ' ', c.C_Lname) AS customer_name,
  s.S_Date,
  s.S_Time
  FROM sales s
  JOIN sales_items si ON s.Sale_ID = si.Sale_ID
  JOIN medicine m ON si.Med_ID = m.Med_ID
  JOIN employee e ON s.E_ID = e.E_ID
  LEFT JOIN customer c ON s.C_ID = c.C_ID
  ORDER BY s.S_Date DESC, s.S_Time DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sales Report</title>
  <style>
    body { font-family: Arial; padding: 30px; background: #f5f5f5; }
    h2 { color: #2a62d3; }
    table { width: 100%; border-collapse: collapse; background: white; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
    th { background: #e8f0fe; }
  </style>
</head>
<body>

<h2>Sales Report</h2>

<table>
  <tr>
    <th>Sale ID</th>
    <th>Medicine</th>
    <th>Qty</th>
    <th>Unit Price</th>
    <th>Total</th>
    <th>Customer</th>
    <th>Employee</th>
    <th>Date</th>
    <th>Time</th>
  </tr>

  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $row['Sale_ID'] ?></td>
    <td><?= $row['Med_Name'] ?></td>
    <td><?= $row['Sale_Qty'] ?></td>
    <td>Rs. <?= $row['Med_Price'] ?></td>
    <td>Rs. <?= $row['Tot_Price'] ?></td>
    <td><?= $row['customer_name'] ?? 'Guest' ?></td>
    <td><?= $row['employee_name'] ?></td>
    <td><?= $row['S_Date'] ?></td>
    <td><?= $row['S_Time'] ?></td>
  </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
