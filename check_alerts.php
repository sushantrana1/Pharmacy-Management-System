<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

$settings_check = $conn->query("SELECT * FROM alert_settings LIMIT 1");
if ($settings_check && $settings_check->num_rows > 0) {
    $settings = $settings_check->fetch_assoc();
    $stock_threshold = $settings['low_stock_threshold'];
    $expiry_days = $settings['expiry_warning_days'];
} else {
    $stock_threshold = 10;
    $expiry_days = 30;
}

$resolvedStock = $conn->query("
  SELECT a.alert_id
  FROM alerts a
  JOIN medicine m ON a.Med_ID = m.Med_ID
  WHERE a.alert_type = 'low_stock'
  AND a.status = 'active'
  AND m.Med_Qty > $stock_threshold
");

if ($resolvedStock) {
    while ($resolved = $resolvedStock->fetch_assoc()) {
        $conn->query("UPDATE alerts SET status = 'dismissed' WHERE alert_id = {$resolved['alert_id']}");
    }
}

$resolvedExpiry = $conn->query("
  SELECT a.alert_id
  FROM alerts a
  WHERE a.alert_type = 'expiry'
  AND a.status = 'active'
  AND a.Med_ID NOT IN (
    SELECT DISTINCT p.Med_ID
    FROM purchase p
    WHERE p.Exp_Date <= DATE_ADD(CURDATE(), INTERVAL $expiry_days DAY)
    AND p.Exp_Date >= CURDATE()
    AND p.P_Qty > 0
  )
");

if ($resolvedExpiry) {
    while ($resolved = $resolvedExpiry->fetch_assoc()) {
        $conn->query("UPDATE alerts SET status = 'dismissed' WHERE alert_id = {$resolved['alert_id']}");
    }
}

$lowStock = $conn->query("
  SELECT Med_ID, Med_Name, Med_Qty 
  FROM medicine 
  WHERE Med_Qty <= $stock_threshold
");

if ($lowStock) {
    while ($med = $lowStock->fetch_assoc()) {
      $exists = $conn->query("
        SELECT alert_id FROM alerts 
        WHERE Med_ID = {$med['Med_ID']} 
        AND alert_type = 'low_stock' 
        AND status = 'active'
      ");
      
      if ($exists && $exists->num_rows == 0) {
        $msg = "Low stock: {$med['Med_Name']} (Only {$med['Med_Qty']} left)";
        $msg = $conn->real_escape_string($msg);
        $conn->query("
          INSERT INTO alerts (alert_type, Med_ID, message)
          VALUES ('low_stock', {$med['Med_ID']}, '$msg')
        ");
      } else if ($exists && $exists->num_rows > 0) {
        $msg = "Low stock: {$med['Med_Name']} (Only {$med['Med_Qty']} left)";
        $msg = $conn->real_escape_string($msg);
        $conn->query("
          UPDATE alerts 
          SET message = '$msg', alert_date = NOW()
          WHERE Med_ID = {$med['Med_ID']} 
          AND alert_type = 'low_stock' 
          AND status = 'active'
        ");
      }
    }
}

$expiryCheck = $conn->query("
  SELECT DISTINCT
    p.Med_ID, 
    m.Med_Name, 
    MIN(p.Exp_Date) as Exp_Date,
    SUM(p.P_Qty) as Total_Expiring_Qty
  FROM purchase p
  JOIN medicine m ON p.Med_ID = m.Med_ID
  WHERE p.Exp_Date <= DATE_ADD(CURDATE(), INTERVAL $expiry_days DAY)
  AND p.Exp_Date >= CURDATE()
  AND p.P_Qty > 0
  GROUP BY p.Med_ID, m.Med_Name
");

if ($expiryCheck) {
    while ($exp = $expiryCheck->fetch_assoc()) {
     
      $today = new DateTime();
      $expiryDate = new DateTime($exp['Exp_Date']);
      $daysLeft = $today->diff($expiryDate)->days;
      
      $exists = $conn->query("
        SELECT alert_id FROM alerts 
        WHERE Med_ID = {$exp['Med_ID']} 
        AND alert_type = 'expiry' 
        AND status = 'active'
        AND message LIKE '%{$exp['Exp_Date']}%'
      ");
      
      if ($exists && $exists->num_rows == 0) {
       
        if ($daysLeft <= 7) {
          $urgency = "URGENT";
        } else if ($daysLeft <= 15) {
          $urgency = "Soon";
        } else {
          $urgency = "Expiring";
        }
        
        $msg = "$urgency: {$exp['Med_Name']} expires on {$exp['Exp_Date']} ({$daysLeft} days left)";
        $msg = $conn->real_escape_string($msg);
        $conn->query("
          INSERT INTO alerts (alert_type, Med_ID, message)
          VALUES ('expiry', {$exp['Med_ID']}, '$msg')
        ");
      }
    }
}

$conn->query("
  DELETE FROM alerts 
  WHERE status = 'dismissed' 
  AND alert_date < DATE_SUB(NOW(), INTERVAL 30 DAY)
");

?>