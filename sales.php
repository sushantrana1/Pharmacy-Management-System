<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");
include 'check_expiry.php'; 

if (isset($_GET['error']) && $_GET['error'] == 'stock') {
    $med_name = isset($_GET['medicine']) ? urldecode($_GET['medicine']) : 'A medicine';
    $available = isset($_GET['available']) ? $_GET['available'] : '0';
    $requested = isset($_GET['requested']) ? $_GET['requested'] : '0';
    
    echo "<script>
        window.addEventListener('DOMContentLoaded', function() {
            let alertBox = document.getElementById('stockErrorAlert');
            let alertMsg = document.getElementById('stockErrorMessage');
            alertMsg.innerHTML = `
                <strong>$med_name</strong> has only <strong>$available</strong> units available.<br>
                You tried to sell: <strong>$requested</strong> units<br>
                <span style='color: #fff3cd;'>Sale blocked due to insufficient stock!</span>
            `;
            alertBox.style.display = 'block';
            setTimeout(() => { alertBox.style.display = 'none'; }, 8000);
        });
    </script>";
}

if (isset($_GET['error']) && $_GET['error'] == 'expired') {
    $expired_med = isset($_GET['medicine']) ? urldecode($_GET['medicine']) : 'A medicine';
    echo "<script>
        window.addEventListener('DOMContentLoaded', function() {
            let alertBox = document.getElementById('expiredAlert');
            let alertMsg = document.getElementById('expiredMessage');
            alertMsg.innerHTML = '<strong>$expired_med</strong> is EXPIRED. Sale blocked!';
            alertBox.style.display = 'block';
            setTimeout(() => { alertBox.style.display = 'none'; }, 7000);
        });
    </script>";
}
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

  <div class="expired-alert" id="expiredAlert">
    <i class="fas fa-exclamation-triangle"></i>
    <strong>Note: Expired and Out of stock Medicine are Hidden! <br> </strong>
    <p id="expiredMessage" style="margin: 5px 0 0 0;"></p>
  </div>

  <form action="sales_process.php" method="POST" id="salesForm">

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

    <label>Select Medicine:</label>
    <select name="medicine_id" id="medicineSelect" class="searchable" required>
      <option value="">--Choose--</option>

      <?php

      $availableMeds = getAvailableMedicines($conn);
      while ($m = $availableMeds->fetch_assoc()) {
        echo "<option value='{$m['Med_ID']}' 
                      data-price='{$m['Med_Price']}'
                      data-stock='{$m['Med_Qty']}'
                      data-name='{$m['Med_Name']}'>
                {$m['Med_Name']} - Stock: {$m['Med_Qty']} - Rs.{$m['Med_Price']}
              </option>";
      }
      ?>
    </select>

    <div class="stock-info" id="stockInfo">
      <i class="fas fa-box"></i>
      <strong>Available Stock: <span id="availableStock">0</span> units</strong>
    </div>
    <br><br>

    <label>Quantity</label>
    <input type="number" id="medicineQty" min="1" value="1">

    <button type="button" onclick="addMedicine()">Add Medicine</button>
    <br><br><br>

    <table id="itemsTable">
      <thead>
        <tr>
          <th>Medicine</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>

    <div class="total-box">Grand Total: Rs. <span id="grandTotal">0</span></div>
    <input type="hidden" name="total_amount" id="total_amount">

    <input type="hidden" name="medicines_json" id="medicines_json">

    <button type="submit">Complete Sale</button>
  </form>

  <script>
    let medicines = [];
    let grandTotal = 0;

    document.getElementById("medicineSelect").addEventListener("change", function() {
      let select = this;
      let stockInfo = document.getElementById("stockInfo");
      let availableStock = document.getElementById("availableStock");
      
      if (select.value) {
        let stock = select.options[select.selectedIndex].getAttribute("data-stock");
        availableStock.textContent = stock;
        stockInfo.classList.add("show");
  
        document.getElementById("medicineQty").setAttribute("max", stock);
      } else {
        stockInfo.classList.remove("show");
      }
    });

    function addMedicine() {
      let select = document.getElementById("medicineSelect");
      let qty = parseInt(document.getElementById("medicineQty").value);
      let expiredAlert = document.getElementById("expiredAlert");
      let expiredMsg = document.getElementById("expiredMessage");
      let stockErrorAlert = document.getElementById("stockErrorAlert");
      let stockErrorMsg = document.getElementById("stockErrorMessage");

      if (!select.value || qty <= 0) {
        alert("Please select a medicine and enter valid qty");
        return;
      }

      let medId = select.value;
      let medName = select.options[select.selectedIndex].getAttribute("data-name");
      let price = parseFloat(select.options[select.selectedIndex].getAttribute("data-price"));
      let availableStock = parseInt(select.options[select.selectedIndex].getAttribute("data-stock"));

      let alreadyAdded = 0;
      medicines.forEach(med => {
        if (med.id == medId) {
          alreadyAdded += med.qty;
        }
      });

      let totalRequested = alreadyAdded + qty;


      if (totalRequested > availableStock) {

        stockErrorMsg.innerHTML = `
          <strong>${medName}</strong> has only <strong>${availableStock}</strong> units in stock.<br>
          Already in cart: <strong>${alreadyAdded}</strong> units<br>
          Trying to add: <strong>${qty}</strong> units<br>
          Total needed: <strong>${totalRequested}</strong> units<br>
          <span style="color: #fff3cd;">Cannot add! Insufficient stock.</span>
        `;
        stockErrorAlert.style.display = 'block';
        
        setTimeout(() => {
          stockErrorAlert.style.display = 'none';
        }, 6000);
        
        return; 
      }

      fetch('check_medicine_expiry.php?med_id=' + medId)
        .then(response => response.json())
        .then(data => {
          if (data.is_expired) {

            expiredMsg.innerHTML = `<strong>${data.medicine_name}</strong> is EXPIRED (Exp: ${data.exp_date}). Cannot be sold!`;
            expiredAlert.style.display = 'block';
            
            setTimeout(() => {
              expiredAlert.style.display = 'none';
            }, 5000);
            
            return;
          }

          let total = qty * price;
          medicines.push({ id: medId, name: medName, qty: qty, price: price, total: total });
          updateTable();
          
          document.getElementById("medicineQty").value = 1;
          
          let remainingStock = availableStock - totalRequested;
          document.getElementById("availableStock").textContent = remainingStock;
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Error checking medicine expiry');
        });
    }

    function removeMedicine(index) {
      medicines.splice(index, 1);
      updateTable();

      let select = document.getElementById("medicineSelect");
      if (select.value) {
        select.dispatchEvent(new Event('change'));
      }
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
            <td>
              <button type="button" onclick="removeMedicine(${index})" 
                      style="background: #e74c3c; color: white; border: none; 
                             padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                Remove
              </button>
            </td>
          </tr>
        `;
      });

      document.getElementById("grandTotal").innerText = grandTotal.toFixed(2);
      document.getElementById("total_amount").value = grandTotal.toFixed(2);
      document.getElementById("medicines_json").value = JSON.stringify(medicines);
    }

    document.getElementById("salesForm").addEventListener("submit", function(e) {
      if (medicines.length === 0) {
        e.preventDefault();
        alert("Please add at least one medicine to the cart!");
      }
    });
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