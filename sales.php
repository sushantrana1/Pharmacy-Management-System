<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
$conn = new mysqli("localhost", "root", "", "pharmacy");

// Get medicines
$meds = $conn->query("SELECT * FROM medicine");
?>


<!DOCTYPE html>
<html>
<head>
  <title>Sales / Billing </title>
  <style>
    body { font-family: Arial; padding: 30px; background: #f4f4f4; }
    h2 { color: #2a62d3; }
    form, table { background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
    select, input { padding: 8px; margin: 5px; width: 200px; }
    button { padding: 10px 20px; background: green; color: white; border: none; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
  </style>
</head>
<body>

<h2>New Sale </h2>
<form action="sales_process.php" method="POST">
  <label>Select Medicine:</label>
  <select name="Med_ID" id="Med_ID" required>
    <option value="">-- Select --</option>
    <?php while($med = $meds->fetch_assoc()): ?>
      <option value="<?= $med['Med_ID'] ?>" data-price="<?= $med['Med_Price'] ?>">
        <?= $med['Med_Name'] ?> (Rs. <?= $med['Med_Price'] ?>)
      </option>
    <?php endwhile; ?>
  </select><br>

  <label>Quantity:</label>
  <input type="number" name="Sale_Qty" id="Sale_Qty" required><br>

  <label>Total Price:</label>
  <input type="text" name="Tot_Price" id="Tot_Price" readonly><br>

  <label>Customer ID (optional):</label>
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
