<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$med = $conn->query("SELECT * FROM medicine WHERE Med_ID=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Edit Medicine</title></head>
<body>

<h2>Edit Medicine</h2>

<form action="update_medicine.php" method="POST">
  <input type="hidden" name="Med_ID" value="<?= $med['Med_ID'] ?>">
  <input type="text" name="Med_Name" value="<?= $med['Med_Name'] ?>" required>
  <input type="number" name="Med_Qty" value="<?= $med['Med_Qty'] ?>" required>
  <input type="number" step="0.01" name="Med_Price" value="<?= $med['Med_Price'] ?>" required>
  <input type="text" name="Category" value="<?= $med['Category'] ?>">
  <input type="text" name="Location_Rack" value="<?= $med['Location_Rack'] ?>">
  <button type="submit">Update</button>
</form>

</body>
</html>
