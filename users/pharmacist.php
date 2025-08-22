<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pharmacist') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pharmacist Dashboard</title>
  <link rel="stylesheet" href="ph.css">
</head>
<body>

<div class="menu">
  <h2>Welcome, <?= $_SESSION['user'] ?> (Pharmacist)</h2>

  <!-- Link to medicine management -->
  <a href="../medicine.php">Medicine management</a>

  <!-- Link to supplier management -->
  <a href="../suppliers.php">Supplier Management</a>

  <!-- Link to purchase management -->
  <a href="../purchase.php">Purchase Management</a>

  <!-- Link to employees management -->
  <a href="../employees.php">Employees Management</a>

  <!-- Link to manage customer -->
  <a href="../customers.php">Customers Management</a>
  
  <!-- Link to sales -->
   <a href="../sales.php">Sales / Billing System</a>
  
  <!-- Link to sales_report -->
  <a href="../sales_report.php">Sales Report</a>

  <a class="logout" href="../logout.php">Logout</a>
</div>

</body>
</html>
