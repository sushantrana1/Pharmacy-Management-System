<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
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
  <title>Purchase Management</title>
  <style>
    body { font-family: Arial; padding: 30px; background: #f2f2f2; }
    h2 { color: #2a62d3; }
    form, table { background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
    input, select { padding: 8px; width: 200px; margin: 5px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    button { padding: 10px 15px; background: green; color: white; }
  </style>
</head>
<body>

<h2>Add New Purchase</h2>
<form action="add_purchase.php" method="POST">
  <label>Medicine:</label>
  <select name="Med_ID" required>
    <option value="">-- Select --</option>
    <?php while($m = $meds->fetch_assoc()): ?>
      <option value="<?= $m['Med_ID'] ?>"><?= $m['Med_Name'] ?></option>
    <?php endwhile; ?>
  </select>

  <label>Supplier:</label>
  <select name="Sup_ID" required>
    <option value="">-- Select --</option>
    <?php while($s = $suppliers->fetch_assoc()): ?>
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
  <?php while($p = $purchases->fetch_assoc()): ?>
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

</body>
</html>
