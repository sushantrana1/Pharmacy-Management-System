<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

extract($_POST);

$conn->query("INSERT INTO employee 
  (E_Fname, E_Lname, E_Sex, Bdate, E_Age, E_Type, E_Sal, E_Phno, E_date, E_Mail, E_Add)
  VALUES 
  ('$E_Fname', '$E_Lname', '$E_Sex', '$Bdate', $E_Age, '$E_Type', $E_Sal, '$E_Phno', '$E_date', '$E_Mail', '$E_Add')");

header("Location: employees.php");
?>