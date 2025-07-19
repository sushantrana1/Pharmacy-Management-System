<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
$conn = new mysqli("localhost", "root", "", "pharmacy");
$emps = $conn->query("SELECT * FROM employee");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Employee Management</title>
  <style>
  body { font-family: Arial; background: #f4f4f4; padding: 30px; }
  h2 { color: #2a62d3; }
  form, table { background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
  input { width: 200px; padding: 8px; margin: 5px; }
  button { padding: 10px 15px; background: green; color: white; }
  table { width: 100%; border-collapse: collapse; }
  th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
  .btn-edit { background: orange; color: white; padding: 5px 10px; text-decoration: none; }
  .btn-del { background: red; color: white; padding: 5px 10px; text-decoration: none; }
  </style>
</head>
<body>

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
  <input type="text" name="E_Type" placeholder="Role (Admin/Pharmacist)" required>
  <input type="number" step="0.01" name="E_Sal" placeholder="Salary" required>
  <input type="text" name="E_Phno" placeholder="Phone" required><br>
  <input type="date" name="E_date" placeholder="Join Date" required>
  <input type="email" name="E_Mail" placeholder="Email" required>
  <input type="text" name="E_Add" placeholder="Address" required>
  <button type="submit">Add Employee</button>
</form>

<h2>Employee List</h2>
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

</body>
</html>
