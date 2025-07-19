<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM employee WHERE E_ID = $id")->fetch_assoc();
?>

<form action="update_employee.php" method="POST">
  <input type="hidden" name="E_ID" value="<?= $data['E_ID'] ?>">
  <input type="text" name="E_Fname" value="<?= $data['E_Fname'] ?>" required>
  <input type="text" name="E_Lname" value="<?= $data['E_Lname'] ?>" required>
  <input type="text" name="E_Sex" value="<?= $data['E_Sex'] ?>">
  <input type="date" name="Bdate" value="<?= $data['Bdate'] ?>">
  <input type="number" name="E_Age" value="<?= $data['E_Age'] ?>">
  <input type="text" name="E_Type" value="<?= $data['E_Type'] ?>">
  <input type="number" step="0.01" name="E_Sal" value="<?= $data['E_Sal'] ?>">
  <input type="text" name="E_Phno" value="<?= $data['E_Phno'] ?>">
  <input type="date" name="E_date" value="<?= $data['E_date'] ?>">
  <input type="email" name="E_Mail" value="<?= $data['E_Mail'] ?>">
  <input type="text" name="E_Add" value="<?= $data['E_Add'] ?>">
  <button type="submit">Update Employee</button>
</form>
