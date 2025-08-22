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
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales / Billing</title>
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

  <h2> New Sale </h2>
  <form action="sales_process.php" method="POST">
    <label>Select Medicine:</label>
    <select name="Med_ID" id="Med_ID" required>
      <option value="">-- Select --</option>
      <?php while ($med = $meds->fetch_assoc()): ?>
        <option value="<?= $med['Med_ID'] ?>" data-price="<?= $med['Med_Price'] ?>">
          <?= $med['Med_Name'] ?> (Rs. <?= $med['Med_Price'] ?>)
        </option>
      <?php endwhile; ?>
    </select><br>

    <label>Quantity:</label>
    <input type="number" name="Sale_Qty" id="Sale_Qty" required><br>

    <label>Total Price:</label>
    <input type="text" name="Tot_Price" id="Tot_Price" readonly><br>

    <label>Customer ID:</label>
    <input type="number" name="C_ID"><br>

    <button type="submit">Submit Sale</button>
  </form>

  <script>
    const medSelect = document.getElementById('Med_ID');
    const qtyInput = document.getElementById('Sale_Qty');
    const totInput = document.getElementById('Tot_Price');

    let price = 0;
    medSelect.addEventListener('change', () => {
      price = parseFloat(medSelect.options[medSelect.selectedIndex].dataset.price || 0);
      updateTotal();
    });

    qtyInput.addEventListener('input', updateTotal);

    function updateTotal() {
      let qty = parseInt(qtyInput.value) || 0;
      totInput.value = (price * qty).toFixed(2);
    }
  </script>

</body>

</html>