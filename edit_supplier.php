<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM suppliers WHERE Sup_ID = $id")->fetch_assoc();
?>

<form action="update_supplier.php" method="POST">
  <input type="hidden" name="Sup_ID" value="<?= $data['Sup_ID'] ?>">
  <input type="text" name="Sup_Name" value="<?= $data['Sup_Name'] ?>" required>
  <input type="text" name="Sup_Phno" value="<?= $data['Sup_Phno'] ?>">
  <input type="email" name="Sup_Mail" value="<?= $data['Sup_Mail'] ?>">
  <input type="text" name="Sup_Add" value="<?= $data['Sup_Add'] ?>">
  <button type="submit">Update Supplier</button>
</form>
