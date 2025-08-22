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
  <h2>Add New Medicine</h2>

  <form action="add_medicine.php" method="POST">
    <input type="text" name="Med_Name" placeholder="Medicine Name" required>
    <input type="number" name="Med_Qty" placeholder="Quantity" required>
    <input type="number" step="0.01" name="Med_Price" placeholder="Price" required>
    <select name="Category">
      <option value="Capsule">Capsule</option>
      <option value="Tablet">Tablet</option>
      <option value="Syrup">Syrup</option>
      <option value="Drops">Drops</option>
      <option value="Injection">Injection</option>
    </select>
    <input type="text" name="Location_Rack" placeholder="Rack Location">
    <button type="submit">Add Medicine</button>
  </form>

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

            <?php if ($role == 'admin'): ?>
              <a class="btn-edit" href="edit_medicine.php?id=<?= $row['Med_ID'] ?>">Edit</a>
              <a class="btn-del" href="delete_medicine.php?id=<?= $row['Med_ID'] ?>"
                onclick="return confirm('Delete this medicine?')">Delete</a>
            <?php else: ?>
              <span style="color: gray;">View Only</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

</body>

</html>