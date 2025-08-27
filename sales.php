<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");
?>

<!DOCTYPE html>
<html>

<head>
  <title>Sales / Billing</title>
  <link rel="stylesheet" href="css/sales.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2>Sales / Billing</h2>

  <form action="sales_process.php" method="POST" id="salesForm">

    <!-- Customer -->
    <label>Select Customer:</label>
    <select name="customer_id" id="customerSelect" class="searchable" required>
      <option value="">--Choose--</option>
      <?php
      $customers = $conn->query("SELECT * FROM customer");
      while ($c = $customers->fetch_assoc()) {
        echo "<option value='{$c['C_ID']}'>{$c['C_Fname']} {$c['C_Lname']}</option>";
      }
      ?>
    </select>
    <br><br>

    <!-- Medicine -->
    <label>Select Medicine:</label>
    <select name="medicine_id" id="medicineSelect" class="searchable" required>
      <option value="">--Choose--</option>

      <?php
      $meds = $conn->query("SELECT * FROM medicine");
      while ($m = $meds->fetch_assoc()) {
        echo "<option value='{$m['Med_ID']}' data-price='{$m['Med_Price']}'>{$m['Med_Name']}</option>";
      }
      ?>

    </select>
    <br><br>

    <label>Quantity</label>
    <input type="number" id="medicineQty" min="1" value="1">

    <button type="button" onclick="addMedicine()">Add Medicine</button>
    <br><br><br>

    <!-- Items Table -->
    <table id="itemsTable">
      <thead>
        <tr>
          <th>Medicine</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <!-- Grand Total -->
    <div class="total-box">Grand Total: Rs. <span id="grandTotal">0</span></div>
    <input type="hidden" name="total_amount" id="total_amount">

    <!-- Hidden field for medicines -->
    <input type="hidden" name="medicines_json" id="medicines_json">

    <button type="submit">Complete Sale</button>
  </form>

  <script>
    let medicines = [];
    let grandTotal = 0;

    function addMedicine() {
      let select = document.getElementById("medicineSelect");
      let qty = parseInt(document.getElementById("medicineQty").value);

      if (!select.value || qty <= 0) {
        alert("Please select a medicine and enter valid qty");
        return;
      }

      let medId = select.value;
      let medName = select.options[select.selectedIndex].text;
      let price = parseFloat(select.options[select.selectedIndex].getAttribute("data-price"));
      let total = qty * price;

      medicines.push({ id: medId, name: medName, qty: qty, price: price, total: total });
      updateTable();
    }

    function removeMedicine(index) {
      medicines.splice(index, 1);
      updateTable();
    }

    function updateTable() {
      let tbody = document.querySelector("#itemsTable tbody");
      tbody.innerHTML = "";
      grandTotal = 0;

      medicines.forEach((med, index) => {
        grandTotal += med.total;
        tbody.innerHTML += `
      <tr>
        <td>${med.name}</td>
        <td>${med.qty}</td>
        <td>Rs. ${med.price}</td>
        <td>Rs. ${med.total}</td>
      </tr>
    `;
      });

      document.getElementById("grandTotal").innerText = grandTotal.toFixed(2);
      document.getElementById("total_amount").value = grandTotal.toFixed(2);
      document.getElementById("medicines_json").value = JSON.stringify(medicines);
    }
  </script>

  <script>
    $(document).ready(function () {
      $('.searchable').select2({
        placeholder: "Search...",
        allowClear: true
      });
    });
  </script>


</body>

</html>