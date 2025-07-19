<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$conn->query("DELETE FROM medicine WHERE Med_ID=$id");
header("Location: medicine.php");
?>
