<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
$role = $_SESSION['role'];
$users_link = ($role === 'admin') ? 'users/admin.php' : 'users/pharmacist.php';

$conn = new mysqli("localhost", "root", "", "pharmacy");
$suppliers = $conn->query("SELECT * FROM suppliers");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supplier Management</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2>Add Supplier</h2>
  <form action="add_supplier.php" method="POST">
    <input type="text" name="Sup_Name" placeholder="Supplier Name" required>
    <input type="text" name="Sup_Phno" placeholder="Phone">
    <input type="email" name="Sup_Mail" placeholder="Email">
    <input type="text" name="Sup_Add" placeholder="Address">
    <button type="submit">Add Supplier</button>
  </form>

  <h2>Supplier List</h2>
  <div class="table-responsive">
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>
      <?php while ($row = $suppliers->fetch_assoc()): ?>
        <tr>
          <td><?= $row['Sup_ID'] ?></td>
          <td><?= $row['Sup_Name'] ?></td>
          <td><?= $row['Sup_Phno'] ?></td>
          <td><?= $row['Sup_Mail'] ?></td>
          <td><?= $row['Sup_Add'] ?></td>
          <td>
            <a class="btn-edit" href="edit_supplier.php?id=<?= $row['Sup_ID'] ?>">Edit</a>
            <a class="btn-del" href="delete_supplier.php?id=<?= $row['Sup_ID'] ?>"
              onclick="return confirm('Delete this supplier?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

</body>

</html>