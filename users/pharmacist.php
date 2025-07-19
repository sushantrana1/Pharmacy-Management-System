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

  <!-- Link to medicine manage.php -->
  <a href="../medicine.php">Manage Medicines</a>

  <!-- Link to sales manage -->
  <a href="../sales.php">Sales / Billing</a>

  <!-- Link to sales report -->
  <a href="../sales_report.php">Sales Report</a>

   <!-- Link to supplier management -->
  <a href="../suppliers.php">Supplier Management</a>

  <!-- Link to purchase management -->
  <a href="../purchase.php">Purchase Management</a>

  <!-- Link to manage customer -->
  <a href="../customers.php">Manage Customers</a>

  <!-- Add more: Prescriptions, Billing etc. -->
  <a class="logout" href="../logout.php">Logout</a>
</div>

</body>
</html>
