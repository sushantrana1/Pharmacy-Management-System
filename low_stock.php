<?php
session_start();
include 'check_stock.php'; // Auto-check on page load

$conn = new mysqli("localhost", "root", "", "pharmacy");

$alerts = $conn->query("
  SELECT 
    sa.alert_id,
    m.Med_ID,
    m.Med_Name,
    m.Med_Qty,
    m.Med_Price,
    m.Category,
    m.Location_Rack,
    sa.threshold_qty,
    sa.alert_date
  FROM stock_alerts sa
  JOIN medicine m ON sa.Med_ID = m.Med_ID
  WHERE sa.status = 'active'
  ORDER BY m.Med_Qty ASC, sa.alert_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Low Stock Alerts</title>
  <link rel="stylesheet" href="css/low_stock.css">
</head>
<body>
    <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2>Low Stock Medicines</h2>
  
  <table>
    <tr>
      <th>Medicine Name</th>
      <th>Current Stock</th>
      <th>Min Required</th>
      <th>Category</th>
      <th>Location</th>
      <th>Alert Since</th>
      <th>Actions</th>
    </tr>
    <?php while($alert = $alerts->fetch_assoc()): ?>
    <tr style="background: <?= $alert['Med_Qty'] == 0 ? '#ffebee' : '#fff3e0' ?>">
      <td><?= $alert['Med_Name'] ?></td>
      <td>
        <span style="color: <?= $alert['Med_Qty'] == 0 ? 'red' : 'orange' ?>; 
                     font-weight: bold;">
          <?= $alert['Med_Qty'] ?>
        </span>
      </td>
      <td><?= $alert['threshold_qty'] ?></td>
      <td><?= $alert['Category'] ?></td>
      <td><?= $alert['Location_Rack'] ?></td>
      <td><?= date('M d, Y', strtotime($alert['alert_date'])) ?></td>
      <td>
        <a href="purchase.php?med_id=<?= $alert['Med_ID'] ?>" 
           class="btn-reorder">Re-order</a>
           <form method="POST" action="resolve_alert.php" style="display:inline; ">
          <input type="hidden" name="alert_id" value="<?= $alert['alert_id'] ?>">
          <button type="submit" class="btn-resolve" style = "border-radius: 10px">Mark Resolved</button>
        </form>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>