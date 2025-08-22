<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$role = $_SESSION['role']; // 'admin' or 'pharmacist'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PMS Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    body {
      background-color: white;
    }
    .main-content{
      overflow: hidden;
    }
    .card:hover {
      transform: translateY(-5px);
      transition: 0.3s;
    }
    .logout-btn {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 231px;
      background-color: #343a40;
      padding-top: 75px;
      color: white;
    }
    .sidebar a {
      display: block;
      color: white;
      padding: 15px;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .main-content {
      margin-left: 240px;
    }
  </style>
</head>
<body>

<!-- Sidebar Navigation -->
<div class="sidebar">
    <h2 style="text-align:center;">📋 Modules</h2>
    <a href="medicine.php">💊 Medicine</a>
    <a href="suppliers.php">🚚 Suppliers</a>
    <a href="purchase.php">📦 Purchase</a>
    <a href="employees.php">👨‍⚕️ Employees</a>
    <a href="customers.php">👥 Customers</a>
    <a href="sales.php">🛒 Sales</a>
    <a href="sales_report.php">📊 Sales Report</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main-content container mt-5">
 
  <a href="logout.php" class="btn btn-danger logout-btn"><i class="fas fa-sign-out-alt"></i>Logout</a>

  <h2 class="mb-4 text-center animate__animated animate__fadeInDown">Welcome to Master Pharmacy</h2>

  <div class="row text-center animate__animated animate__fadeInUp animate__delay-1s">
    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-body bg-primary text-white">
          <i class="fas fa-pills fa-2x"></i>
          <h5 class="mt-2">Total Medicines</h5>
          <h3>150</h3>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-body bg-success text-white">
          <i class="fas fa-cash-register fa-2x"></i>
          <h5 class="mt-2">Total Sales</h5>
          <h3>Rs. 1,20,000</h3>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-body bg-warning text-dark">
          <i class="fas fa-receipt fa-2x"></i>
          <h5 class="mt-2">Today’s Bills</h5>
          <h3>42</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- Chart Section -->
  <div class="card mt-4">
    <div class="card-header bg-info text-white">
      <i class="fas fa-chart-bar"></i> Monthly Sales Chart
    </div>
    <div class="card-body">
      <canvas id="salesChart" height="100"></canvas>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('salesChart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Monthly Sales',
        data: [12000, 15000, 18000, 10000, 13000, 17000],
        backgroundColor: 'rgba(54, 162, 235, 0.7)'
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>
