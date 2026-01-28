<?php

$conn = new mysqli("localhost", "root", "", "pharmacy");

$settings = $conn->query("SELECT threshold_qty FROM stock_settings LIMIT 1")
                 ->fetch_assoc();
$threshold = $settings['threshold_qty'];

$lowStock = $conn->query("
  SELECT Med_ID, Med_Name, Med_Qty 
  FROM medicine 
  WHERE Med_Qty <= $threshold
");

while ($med = $lowStock->fetch_assoc()) {

  $existing = $conn->query("
    SELECT alert_id FROM stock_alerts 
    WHERE Med_ID = {$med['Med_ID']} AND status = 'active'
  ");
  
  if ($existing->num_rows == 0) {

    $conn->query("
      INSERT INTO stock_alerts (Med_ID, current_qty, threshold_qty)
      VALUES ({$med['Med_ID']}, {$med['Med_Qty']}, $threshold)
    ");
  }
}
?>