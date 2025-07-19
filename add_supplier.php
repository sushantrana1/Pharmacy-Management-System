<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

$name = $_POST['Sup_Name'];
$phone = $_POST['Sup_Phno'];
$mail = $_POST['Sup_Mail'];
$address = $_POST['Sup_Add'];

$conn->query("INSERT INTO suppliers (Sup_Name, Sup_Phno, Sup_Mail, Sup_Add)
              VALUES ('$name', '$phone', '$mail', '$address')");

header("Location: suppliers.php");
?>
