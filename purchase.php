<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$role = $_SESSION['role'];
$users_link = ($role === 'admin') ? 'users/admin.php' : 'users/pharmacist.php';

$conn = new mysqli("localhost", "root", "", "pharmacy");

$meds = $conn->query("SELECT * FROM medicine");
$suppliers = $conn->query("SELECT * FROM suppliers");
$purchases = $conn->query("
  SELECT p.*, m.Med_Name, s.Sup_Name 
  FROM purchase p
  JOIN medicine m ON p.Med_ID = m.Med_ID
  JOIN suppliers s ON p.Sup_ID = s.Sup_ID
  ORDER BY p.Pur_Date DESC
");
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Purchase Management</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2>Add New Purchase</h2>
  <form action="add_purchase.php" method="POST">
    <label>Medicine:</label>
    <select name="Med_ID" required>
      <option value="">-- Select --</option>
      <?php while ($m = $meds->fetch_assoc()): ?>
        <option value="<?= $m['Med_ID'] ?>"><?= $m['Med_Name'] ?></option>
      <?php endwhile; ?>
    </select>

    <label>Supplier:</label>
    <select name="Sup_ID" required>
      <option value="">-- Select --</option>
      <?php while ($s = $suppliers->fetch_assoc()): ?>
        <option value="<?= $s['Sup_ID'] ?>"><?= $s['Sup_Name'] ?></option>
      <?php endwhile; ?>
    </select><br>

    <label>Quantity:</label>
    <input type="number" name="P_Qty" required>

    <label>Cost Price per Unit:</label>
    <input type="number" step="0.01" name="P_Cost" required><br>

    <label>MFG Date:</label>
    <input type="date" name="Mfg_Date">

    <label>EXP Date:</label>
    <input type="date" name="Exp_Date">

    <button type="submit">Add Purchase</button>
  </form>

  <h2>Purchase History</h2>
  <div class="table-responsive">
    <table>
      <tr>
        <th>ID</th>
        <th>Medicine</th>
        <th>Supplier</th>
        <th>Qty</th>
        <th>Cost</th>
        <th>MFG</th>
        <th>EXP</th>
        <th>Purchased On</th>
      </tr>
      <?php while ($p = $purchases->fetch_assoc()): ?>
        <tr>
          <td><?= $p['P_ID'] ?></td>
          <td><?= $p['Med_Name'] ?></td>
          <td><?= $p['Sup_Name'] ?></td>
          <td><?= $p['P_Qty'] ?></td>
          <td>Rs. <?= $p['P_Cost'] ?></td>
          <td><?= $p['Mfg_Date'] ?></td>
          <td><?= $p['Exp_Date'] ?></td>
          <td><?= $p['Pur_Date'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

</body>

</html>