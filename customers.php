<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
$conn = new mysqli("localhost", "root", "", "pharmacy");
$customers = $conn->query("SELECT * FROM customer");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Customer Management</title>
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
  <?php while($c = $customers->fetch_assoc()): ?>
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

</body>
</html>
