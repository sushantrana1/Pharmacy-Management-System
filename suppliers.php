<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
$conn = new mysqli("localhost", "root", "", "pharmacy");
$suppliers = $conn->query("SELECT * FROM suppliers");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Supplier Management</title>
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

<h2>Add Supplier</h2>
<form action="add_supplier.php" method="POST">
  <input type="text" name="Sup_Name" placeholder="Supplier Name" required>
  <input type="text" name="Sup_Phno" placeholder="Phone">
  <input type="email" name="Sup_Mail" placeholder="Email">
  <input type="text" name="Sup_Add" placeholder="Address">
  <button type="submit">Add Supplier</button>
</form>

<h2>Supplier List</h2>
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Address</th>
    <th>Actions</th>
  </tr>
  <?php while($row = $suppliers->fetch_assoc()): ?>
  <tr>
    <td><?= $row['Sup_ID'] ?></td>
    <td><?= $row['Sup_Name'] ?></td>
    <td><?= $row['Sup_Phno'] ?></td>
    <td><?= $row['Sup_Mail'] ?></td>
    <td><?= $row['Sup_Add'] ?></td>
    <td>
      <a class="btn-edit" href="edit_supplier.php?id=<?= $row['Sup_ID'] ?>">Edit</a>
      <a class="btn-del" href="delete_supplier.php?id=<?= $row['Sup_ID'] ?>" onclick="return confirm('Delete this supplier?')">Delete</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
