<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

extract($_POST);

$conn->query("UPDATE customer SET 
  C_Fname='$C_Fname',
  C_Lname='$C_Lname',
  C_Sex='$C_Sex',
  C_Age=$C_Age,
  C_Phno='$C_Phno',
  C_Mail='$C_Mail'
  WHERE C_ID=$C_ID");

header("Location: customers.php");
?>
