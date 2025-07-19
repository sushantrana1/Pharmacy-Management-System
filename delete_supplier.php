<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$conn->query("DELETE FROM suppliers WHERE Sup_ID = $id");
header("Location: suppliers.php");
?>
