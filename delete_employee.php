<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$id = $_GET['id'];
$conn->query("DELETE FROM employee WHERE E_ID = $id");
header("Location: employees.php");
?>
