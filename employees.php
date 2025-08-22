<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$role = $_SESSION['role'];
$users_link = ($role === 'admin') ? 'users/admin.php' : 'users/pharmacist.php';

$conn = new mysqli("localhost", "root", "", "pharmacy");
$emps = $conn->query("SELECT * FROM employee");
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Management</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
  <a href="dashboard.php" style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
  <a href="logout.php" style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
</div>
<br>

<h2>Add Employee</h2>
<form action="add_employee.php" method="POST">
  <input type="text" name="E_Fname" placeholder="First Name" required>
  <input type="text" name="E_Lname" placeholder="Last Name" required>
  <select name="E_Sex">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
  <input type="date" name="Bdate" required>
  <input type="number" name="E_Age" placeholder="Age" required><br>
   <select type="text">
    <option value="Admin">Admin</option>
    <option value="Pharmacist">Pharmacist</option>
  </select>
  <input type="number" step="0.01" name="E_Sal" placeholder="Salary" required>
  <input type="text" name="E_Phno" placeholder="Phone" required><br>
  <input type="date" name="E_date" placeholder="Join Date" required>
  <input type="email" name="E_Mail" placeholder="Email" required>
  <input type="text" name="E_Add" placeholder="Address" required>
  <button type="submit">Add Employee</button>
</form>

<h2>Employee List</h2>
<div class="table-responsive">
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Sex</th>
    <th>Age</th>
    <th>Type</th>
    <th>Salary</th>
    <th>Phone</th>
    <th>Join Date</th>
    <th>Email</th>
    <th>Address</th>
    <th>Actions</th>
  </tr>
  <?php while($e = $emps->fetch_assoc()): ?>
  <tr>
    <td><?= $e['E_ID'] ?></td>
    <td><?= $e['E_Fname'] ?> <?= $e['E_Lname'] ?></td>
    <td><?= $e['E_Sex'] ?></td>
    <td><?= $e['E_Age'] ?></td>
    <td><?= $e['E_Type'] ?></td>
    <td>Rs. <?= $e['E_Sal'] ?></td>
    <td><?= $e['E_Phno'] ?></td>
    <td><?= $e['E_date'] ?></td>
    <td><?= $e['E_Mail'] ?></td>
    <td><?= $e['E_Add'] ?></td>
    <td>
      <a class="btn-edit" href="edit_employee.php?id=<?= $e['E_ID'] ?>">Edit</a>
      <a class="btn-del" href="delete_employee.php?id=<?= $e['E_ID'] ?>" onclick="return confirm('Delete this employee?')">Delete</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
</div>

</body>
</html>
