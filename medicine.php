<?php
// Start session to track user role (admin/pharmacist)
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
$role = $_SESSION['role'];

// Connect to database
$conn = new mysqli("localhost", "root", "", "pharmacy");

// Fetch all medicine records
$meds = $conn->query("SELECT * FROM medicine");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Medicine Management</title>
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

<h2>Add New Medicine</h2>

<!-- Form to add medicine -->
<form action="add_medicine.php" method="POST">
  <input type="text" name="Med_Name" placeholder="Medicine Name" required>
  <input type="number" name="Med_Qty" placeholder="Quantity" required>
  <input type="number" step="0.01" name="Med_Price" placeholder="Price" required>
  <input type="text" name="Category" placeholder="Category">
  <input type="text" name="Location_Rack" placeholder="Rack Location">
  <button type="submit">Add Medicine</button>
</form>

<h2>Medicine List</h2>

<!-- Display list of medicine records -->
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

  <!-- Loop through and show each row -->
  <?php while($row = $meds->fetch_assoc()): ?>
  <tr>
    <td><?= $row['Med_ID'] ?></td>
    <td><?= $row['Med_Name'] ?></td>
    <td><?= $row['Med_Qty'] ?></td>
    <td>Rs. <?= $row['Med_Price'] ?></td>
    <td><?= $row['Category'] ?></td>
    <td><?= $row['Location_Rack'] ?></td>
    <td>
      <?php if ($role == 'admin'): ?>
        <a class="btn-edit" href="edit_medicine.php?id=<?= $row['Med_ID'] ?>">Edit</a>
        <a class="btn-del" href="delete_medicine.php?id=<?= $row['Med_ID'] ?>" onclick="return confirm('Delete this medicine?')">Delete</a>
      <?php else: ?>
        <span style="color: gray;">View Only</span>
      <?php endif; ?>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
