<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$role = $_SESSION['role'];
$users_link = ($role === 'admin') ? 'users/admin.php' : 'users/pharmacist.php';

$conn = new mysqli("localhost", "root", "", "pharmacy");

$meds = $conn->query("SELECT * FROM medicine");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medicine Management</title>
  <link rel="stylesheet" href="css/medicine.css">


</head>

<body>
  <div class="container">
    <!-- <div class="sidebar">
      <div class="logo">
        <i class="fa-solid fa-prescription-bottle-medical"></i>
        <h1> Master Pharmacy </h1>
      </div>

      <ul class="sidebar-menu">
        <li><a href="./dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="medicine.php"><i class="fas fa-pills"></i> Medicine</a></li>
        <li><a href="suppliers.php"><i class="fas fa-truck"></i> Suppliers</a></li>
        <li><a href="purchase.php"><i class="fas fa-boxes"></i> Purchase</a></li>
        <li><a href="employees.php"><i class="fas fa-user-md"></i> Employees</a></li>
        <li><a href="customers.php"><i class="fas fa-user"></i> Customers</a></li>
        <li><a href="sales.php"><i class="fas fa-cash-register"></i> Sales</a></li>
        <li><a href="payment.php.php"><i class="fas fa-receipt"></i> Payment Invoice</a></li>
        <li><a href="sales_report.php"><i class="fas fa-chart-line"></i> Sales Report</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div> -->

    <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
      <a href="dashboard.php"
        style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
      <a href="logout.php"
        style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
    </div>
    <br>
    <h2>Add New Medicine</h2>

    <form action="add_medicine.php" method="POST">
      <input type="text" name="Med_Name" placeholder="Medicine Name" required>
      <input type="number" name="Med_Qty" placeholder="Quantity" required>
      <input type="number" step="0.01" name="Med_Price" placeholder="Price" required>
      <select name="Category">
        <option value="Capsule">Capsule</option>
        <option value="Capsule">Tablet</option>
        <option value="Tablet">Inhaler</option>
        <option value="Syrup">Syrup</option>
        <option value="Drops">Drops</option>
        <option value="Injection">Injection</option>
      </select>
      <input type="text" name="Location_Rack" placeholder="Rack Location">
      <br><br>
      <button type="submit">Add Medicine</button>
    </form>

    <br>
    <h2>Medicine List</h2>

    <div class="table-responsive">
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Category</th>
          <th>Rack</th>
          <th>Actions</th>
        </tr>

        <?php while ($row = $meds->fetch_assoc()): ?>
          <tr>
            <td><?= $row['Med_ID'] ?></td>
            <td><?= $row['Med_Name'] ?></td>
            <td><?= $row['Med_Qty'] ?></td>
            <td><?= $row['Med_Price'] ?></td>
            <td><?= $row['Category'] ?></td>
            <td><?= $row['Location_Rack'] ?></td>
            <td>

              <a class="btn-edit" href="edit_medicine.php?id=<?= $row['Med_ID'] ?>">Edit</a>
              <a class="btn-del" href="delete_medicine.php?id=<?= $row['Med_ID'] ?>"
                onclick="return confirm('Delete this medicine?')">Delete</a>

              <!-- <?php
              if ($role == 'admin'): ?>
              <a class="btn-edit" href="edit_medicine.php?id=<?= $row['Med_ID'] ?>">Edit</a>
              <a class="btn-del" href="delete_medicine.php?id=<?= $row['Med_ID'] ?>"
                onclick="return confirm('Delete this medicine?')">Delete</a>
            <?php else: ?>
              <span style="color: gray;">View Only</span>
            <?php endif; ?> -->

            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>

  </div>

</body>

</html>