<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");

$expired = $conn->query("
  SELECT 
    m.Med_ID,
    m.Med_Name,
    m.Category,
    m.Location_Rack,
    p.Exp_Date,
    p.P_Qty as Expired_Qty,
    p.P_Cost
  FROM medicine m
  JOIN purchase p ON m.Med_ID = p.Med_ID
  WHERE p.Exp_Date < CURDATE()
  AND p.P_Qty > 0
  ORDER BY p.Exp_Date ASC
");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Expired Medicines</title>
  <link rel="stylesheet" href="css/expired_medicine.css">
</head>
<body>

  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2>Expired Medicines</h2>
  
  <div style="background: #ff4757; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
    <strong>WARNING:</strong> These medicines cannot be sold. Please remove from inventory.
  </div>

  <div class="table-responsive">
    <table>
      <tr>
        <th>Medicine Name</th>
        <th>Category</th>
        <th>Location</th>
        <th>Expired Date</th>
        <th>Expired Qty</th>
        <th>Loss Amount</th>
        <th>Action</th>
      </tr>
      <?php 
      $totalLoss = 0;
      while ($exp = $expired->fetch_assoc()): 
        $loss = $exp['Expired_Qty'] * $exp['P_Cost'];
        $totalLoss += $loss;
      ?>
      <tr style="background: white;">
        <td><?= $exp['Med_Name'] ?></td>
        <td><?= $exp['Category'] ?></td>
        <td><?= $exp['Location_Rack'] ?></td>
        <td style="color: #e74c3c; font-weight: bold;"><?= $exp['Exp_Date'] ?></td>
        <td><?= $exp['Expired_Qty'] ?></td>
        <td>Rs. <?= number_format($loss, 2) ?></td>
        <td>
          <button onclick="if(confirm('Mark as disposed?')) 
                  location.href='dispose_expired.php?med_id=<?= $exp['Med_ID'] ?>&exp_date=<?= $exp['Exp_Date'] ?>'"
                  style="background: #e74c3c; color: white; border: none; 
                         padding: 6px 12px; border-radius: 4px; cursor: pointer;">
            Dispose
          </button>
        </td>
      </tr>
      <?php endwhile; ?>
      <tr style="background: #3498db; color: white; font-weight: bold;">
        <td colspan="5">Total Loss</td>
        <td colspan="2">Rs. <?= number_format($totalLoss, 2) ?></td>
      </tr>
    </table>
  </div>

</body>
</html>