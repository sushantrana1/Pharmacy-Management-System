<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$conn->query("DELETE FROM customer WHERE C_ID = $id");
header("Location: customers.php");
?>
