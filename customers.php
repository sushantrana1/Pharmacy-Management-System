<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$role = $_SESSION['role'];
$users_link = ($role === 'admin') ? 'users/admin.php' : 'users/pharmacist.php';

$conn = new mysqli("localhost", "root", "", "pharmacy");
$customers = $conn->query("SELECT * FROM customer");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Management</title>
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

  <h2>Add Customer</h2>
  <form action="add_customer.php" method="POST">
    <input type="text" name="C_Fname" placeholder="First Name" required>
    <input type="text" name="C_Lname" placeholder="Last Name" required>
    <select name="C_Sex">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    <input type="number" name="C_Age" placeholder="Age">
    <input type="text" name="C_Phno" placeholder="Phone Number">
    <input type="email" name="C_Mail" placeholder="Email">
    <button type="submit">Add Customer</button>
  </form>

  <h2>Customer List</h2>

  <div class="table-responsive">
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Sex</th>
        <th>Age</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
      <?php while ($c = $customers->fetch_assoc()): ?>
        <tr>
          <td><?= $c['C_ID'] ?></td>
          <td><?= $c['C_Fname'] . ' ' . $c['C_Lname'] ?></td>
          <td><?= $c['C_Sex'] ?></td>
          <td><?= $c['C_Age'] ?></td>
          <td><?= $c['C_Phno'] ?></td>
          <td><?= $c['C_Mail'] ?></td>
          <td>

            <?php
            $role = $_SESSION['role'];

            if ($role == 'admin') {
              echo "<a class='btn-edit' href='edit_customer.php?id={$c['C_ID']}'>Edit</a>";
              echo "<a class='btn-del' href='delete_customer.php?id={$c['C_ID']}' onclick='return confirm(\"Delete this customer?\")'>Delete</a>";
            } else {
              echo "<span style='color: gray;'>View Only</span>";
            }
            ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

</body>

</html>