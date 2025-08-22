<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

extract($_POST);

$conn->query("UPDATE employee SET
  E_Fname='$E_Fname',
  E_Lname='$E_Lname',
  E_Sex='$E_Sex',
  Bdate='$Bdate',
  E_Age=$E_Age,
  E_Type='$E_Type',
  E_Sal=$E_Sal,
  E_Phno='$E_Phno',
  E_date='$E_date',
  E_Mail='$E_Mail',
  E_Add='$E_Add'
  WHERE E_ID=$E_ID");

header("Location: employees.php");
?>