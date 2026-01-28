<?php
// update_settings.php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy");

$threshold = intval($_POST['threshold_qty']);

$conn->query("
  UPDATE stock_settings 
  SET threshold_qty = $threshold 
  WHERE id = 1
");

header("Location: settings.php");
?>