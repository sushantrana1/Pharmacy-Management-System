<?php
session_start();
if (!isset($_SESSION['role'])) {
  header("Location: index.php");
  exit();
}
$role = $_SESSION['role'];
$users_link = ($role === 'admin') ? 'users/admin.php' : 'users/pharmacist.php';

$conn = new mysqli("localhost", "root", "", "pharmacy");

// JOIN sales + sales_items + medicine + customer 
$query = "
  SELECT 
  s.Sale_ID,
  m.Med_Name,
  si.Sale_Qty,
  m.Med_Price,
  si.Tot_Price,
  CONCAT(c.C_Fname, ' ', c.C_Lname) AS customer_name,
  s.S_Date,
  s.S_Time
FROM sales s
JOIN sales_items si ON s.Sale_ID = si.Sale_ID
JOIN medicine m ON si.Med_ID = m.Med_ID
LEFT JOIN customer c ON s.C_ID = c.C_ID
ORDER BY s.S_Date DESC, s.S_Time DESC;
";

$result = $conn->query($query);
if (!$result) {
  die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Report</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div
    style="position: fixed; bottom: 20px; right: 20px; display: flex; flex-direction: column; gap: 10px; z-index: 999;">
    <button onclick="window.print()"
      style="padding: 10px 16px; background: green; color: white; border: none; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); cursor: pointer;">Print</button>
    <button onclick="downloadPDF()"
      style="padding: 10px 16px; background: #d35400; color: white; border: none; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); cursor: pointer;">PDF</button>
  </div>

  <div style="position: absolute; top: 10px; right: 10px; display: flex; gap: 10px;">
    <a href="dashboard.php"
      style="padding: 8px 12px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Back</a>
    <a href="logout.php"
      style="padding: 8px 12px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Logout</a>
  </div>
  <br>

  <h2> Sales Report</h2>

  <?php if ($result->num_rows === 0): ?>
    <p style="color: red;">No sales available.</p>
  <?php else: ?>

    <div class="table-responsive">
      <table>
        <tr>
          <th>Sale ID</th>
          <th>Medicine</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
          <th>Customer</th>
          <th>Date</th>
          <th>Time</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['Sale_ID'] ?></td>
            <td><?= $row['Med_Name'] ?></td>
            <td><?= $row['Sale_Qty'] ?></td>
            <td>Rs. <?= $row['Med_Price'] ?></td>
            <td>Rs. <?= $row['Tot_Price'] ?></td>
            <td><?= $row['customer_name'] ?? 'Guest' ?></td>
            <td><?= $row['S_Date'] ?></td>
            <td><?= $row['S_Time'] ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>
  <?php endif; ?>

  <!-- html2pdf library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <!-- Script to download as PDF -->
  <script>
    function downloadPDF() {
      const report = document.getElementById("salesReport");
      html2pdf().from(report).save("Sales_Report.pdf");
    }
  </script>

</body>

</html>