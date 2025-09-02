<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");

// Fetch all sales
$salesQuery = "
  SELECT 
    s.Sale_ID,
    s.S_Date,
    s.S_Time,
    s.Total_Amount,
    CONCAT(c.C_Fname, ' ', c.C_Lname) AS customer_name
  FROM sales s
  LEFT JOIN customer c ON s.C_ID = c.C_ID
  ORDER BY s.Sale_ID DESC
";
$salesResult = $conn->query($salesQuery);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sales Report</title>
  <link rel="stylesheet" href="css/payment.css">
  <style>
  @media print {
    .btn-print, .back-btn, .logout-btn {
      display: none; /* Hide buttons during print */
    }
    body {
      background: white;
      color: black;
    }
  }

    .invoice-box { margin-bottom: 50px; }
    .btn-print { background: #27ae60; color: white; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; }
  </style>
</head>

<body>
  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2 style="text-align:center;">🧾 Master Pharmacy - Payment History</h2>

  <?php while ($sale = $salesResult->fetch_assoc()): ?>
    <?php
      // Fetch items for this sale
      $itemQuery = "
        SELECT m.Med_Name, si.Sale_Qty, m.Med_Price, si.Tot_Price
        FROM sales_items si
        JOIN medicine m ON si.Med_ID = m.Med_ID
        WHERE si.Sale_ID = " . $sale['Sale_ID'];
      $itemResult = $conn->query($itemQuery);
    ?>

    <div class="invoice-box">
      <h3>Sale ID #<?= $sale['Sale_ID'] ?></h3>
      <p><b>Customer:</b> <?= $sale['customer_name'] ?? 'Guest' ?></p>
      <p><b>Date:</b> <?= $sale['S_Date'] ?> | <b>Time:</b> <?= $sale['S_Time'] ?></p>

      <table>
        <tr>
          <th>Medicine</th>
          <th>Qty</th>
          <th>Unit Price</th>
          <th>Total</th>
        </tr>
        <?php while ($item = $itemResult->fetch_assoc()): ?>
          <tr>
            <td><?= $item['Med_Name'] ?></td>
            <td><?= $item['Sale_Qty'] ?></td>
            <td>Rs. <?= $item['Med_Price'] ?></td>
            <td>Rs. <?= $item['Tot_Price'] ?></td>
          </tr>
        <?php endwhile; ?>
        <tr class="total">
          <td colspan="3">Grand Total</td>
          <td>Rs. <?= $sale['Total_Amount'] ?></td>
        </tr>
      </table>

      <div class="footer">
        Thank you for your purchase! <br>
        Master Pharmacy
      </div>

      <div style="text-align: right; margin-top: 20px;">
  <button 
    type="button" 
    class="btn-print" 
    onclick="window.print()" 
    style="padding: 8px 16px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer;">
    🖨 Print Report
  </button>
</div>

      <!-- <div style="text-align:right;">
        <button class="btn-print" onclick="printInvoice(<?= $sale['Sale_ID'] ?>)">Print</button>
      </div> -->
    </div>
  <?php endwhile; ?>

  <script>
    function printInvoice(saleId) {
      // Open a new window with just that invoice content
      const invoice = document.querySelector(`.invoice-box:nth-of-type(${saleId})`).outerHTML;
      const printWindow = window.open('', '', 'width=800,height=600');
      printWindow.document.write('<html><head><title>Print Invoice</title></head><body>');
      printWindow.document.write(invoice);
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
    }
  </script>
</body>
</html>
