<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "pharmacy");

// Get form data
$Med_Name = $_POST['Med_Name'];
$Med_Qty = $_POST['Med_Qty'];
$Med_Price = $_POST['Med_Price'];
$Category = $_POST['Category'];
$Location_Rack = $_POST['Location_Rack'];

// Insert into medicine table
$sql = "INSERT INTO medicine (Med_Name, Med_Qty, Med_Price, Category, Location_Rack)
        VALUES ('$Med_Name', $Med_Qty, $Med_Price, '$Category', '$Location_Rack')";
$conn->query($sql);

// Redirect back
header("Location: medicine.php");
?>
