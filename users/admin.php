<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="ad.css">
</head>
<body>

<div class="menu">
  <h2>Welcome, <?= $_SESSION['user'] ?> (Admin)</h2>

  <!-- Link to medicine management -->
  <a href="../medicine.php">Manage Medicines</a>

  <!-- Link to sales -->
   <a href="../sales.php">Sales / Billing </a>
  
  <!-- Link to sales_report -->
  <a href="../sales_report.php">Sales Report</a>

  <!-- Link to supplier management -->
  <a href="../suppliers.php"> Manage Supplier</a>

  <!-- Link to purchase management -->
  <a href="../purchase.php">Manage Purchase</a>

  <!-- Link to employees management -->
  <a href="../employees.php">Manage Employees</a>

  <!-- Link to manage customer -->
  <a href="../customers.php">Manage Customers</a>


  <a class="logout" href="../logout.php">Logout</a>
</div>

</body>
</html>
