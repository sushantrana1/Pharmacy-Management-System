<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM customer WHERE C_ID=$id")->fetch_assoc();
?>

<form action="update_customer.php" method="POST">
  <input type="hidden" name="C_ID" value="<?= $data['C_ID'] ?>">
  <input type="text" name="C_Fname" value="<?= $data['C_Fname'] ?>" required>
  <input type="text" name="C_Lname" value="<?= $data['C_Lname'] ?>" required>
  <input type="text" name="C_Sex" value="<?= $data['C_Sex'] ?>">
  <input type="number" name="C_Age" value="<?= $data['C_Age'] ?>">
  <input type="text" name="C_Phno" value="<?= $data['C_Phno'] ?>">
  <input type="email" name="C_Mail" value="<?= $data['C_Mail'] ?>">
  <button type="submit">Update Customer</button>
</form>

