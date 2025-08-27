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
  <link rel="stylesheet" href="css/purchase.css">
  <!-- Select2 CSS & jQuery (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="style.css"> <!-- your CSS -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <!-- Medicine dropdown -->
    <label>Medicine:</label>
    <select name="Med_ID" id="medicineSelect" class="searchable" required>
      <option value="">-- Select Medicine --</option>
      <?php
      $meds = $conn->query("SELECT * FROM medicine");
      while ($m = $meds->fetch_assoc()):
        ?>
        <option value="<?= $m['Med_ID'] ?>">
          <?= htmlspecialchars($m['Med_Name']) ?> (Stock: <?= $m['Med_Qty'] ?>, Rs. <?= $m['Med_Price'] ?>)
        </option>
      <?php endwhile; ?>
    </select><br><br>

    <!-- Supplier dropdown -->
    <label>Supplier:</label>
    <select name="Sup_ID" id="supplierSelect" class="searchable" required>
      <option value="">-- Select Supplier --</option>
      <?php
      $suppliers = $conn->query("SELECT * FROM suppliers");
      while ($s = $suppliers->fetch_assoc()):
        ?>
        <option value="<?= $s['Sup_ID'] ?>">
          <?= htmlspecialchars($s['Sup_Name']) ?>
        </option>
      <?php endwhile; ?>
    </select><br><br>

    <label>Quantity:</label>
    <input type="number" name="P_Qty" required>
    <label>Cost Price per Unit:</label>
    <input type="number" step="0.01" name="P_Cost" required>

    <label>MFG Date:</label>
    <input type="date" name="Mfg_Date">

    <label>EXP Date:</label>
    <input type="date" name="Exp_Date"><br><br>

    <button type="submit">Add Purchase</button>
  </form>

  <br>
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

  <script>
    $(document).ready(function () {
      $('.searchable').select2({
        placeholder: "Search...",
        allowClear: true,
        width: '100%'
      });
    });
  </script>

</body>

</html>