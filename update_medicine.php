<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

$Med_ID = $_POST['Med_ID'];
$Med_Name = $_POST['Med_Name'];
$Med_Qty = $_POST['Med_Qty'];
$Med_Price = $_POST['Med_Price'];
$Category = $_POST['Category'];
$Location_Rack = $_POST['Location_Rack'];

$sql = "UPDATE medicine SET 
  Med_Name='$Med_Name',
  Med_Qty=$Med_Qty,
  Med_Price=$Med_Price,
  Category='$Category',
  Location_Rack='$Location_Rack'
  WHERE Med_ID=$Med_ID";

$conn->query($sql);
header("Location: medicine.php");
?>
