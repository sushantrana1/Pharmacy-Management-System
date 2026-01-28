<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy");

if (isset($_GET['id'])) {
  $alert_id = intval($_GET['id']);
  $conn->query("UPDATE alerts SET status = 'dismissed' WHERE alert_id = $alert_id");
}

header("Location: dashboard.php");
exit();
?>