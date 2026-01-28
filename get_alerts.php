<?php

$conn = new mysqli("localhost", "root", "", "pharmacy");

$alerts = $conn->query("
  SELECT 
    sa.alert_id,
    m.Med_ID,
    m.Med_Name,
    m.Med_Qty,
    sa.threshold_qty,
    sa.alert_date
  FROM stock_alerts sa
  JOIN medicine m ON sa.Med_ID = m.Med_ID
  WHERE sa.status = 'active'
  ORDER BY sa.alert_date DESC
");

$data = [];
while ($row = $alerts->fetch_assoc()) {
  $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>