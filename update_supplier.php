<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

$id = $_POST['Sup_ID'];
$name = $_POST['Sup_Name'];
$phone = $_POST['Sup_Phno'];
$mail = $_POST['Sup_Mail'];
$address = $_POST['Sup_Add'];

$conn->query("UPDATE suppliers SET 
  Sup_Name='$name',
  Sup_Phno='$phone',
  Sup_Mail='$mail',
  Sup_Add='$address'
  WHERE Sup_ID = $id");

header("Location: suppliers.php");
?>
