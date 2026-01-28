<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy");

$alert_id = intval($_POST['alert_id']);

$conn->query("
  UPDATE stock_alerts 
  SET status = 'resolved', 
      resolved_date = NOW()
  WHERE alert_id = $alert_id
");

header("Location: low_stock.php");
?>