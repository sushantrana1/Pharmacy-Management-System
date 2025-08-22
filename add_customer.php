<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

extract($_POST);

$conn->query("INSERT INTO customer (C_Fname, C_Lname, C_Sex, C_Age, C_Phno, C_Mail)
VALUES ('$C_Fname', '$C_Lname', '$C_Sex', $C_Age, '$C_Phno', '$C_Mail')");

header("Location: customers.php");
?>