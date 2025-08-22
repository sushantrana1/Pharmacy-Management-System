<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Med_ID = $_POST['Med_ID'];
    $Sale_Qty = $_POST['Sale_Qty'];
    $C_ID = !empty($_POST['C_ID']) ? $_POST['C_ID'] : 'NULL';
    $E_ID = $_SESSION['user_id'] ?? 1;

    $query = $conn->query("SELECT Med_Qty, Med_Price FROM medicine WHERE Med_ID = $Med_ID");
    if (!$query || $query->num_rows == 0) {
        die("Medicine not found.");
    }

    $med = $query->fetch_assoc();

    if ($med['Med_Qty'] < $Sale_Qty) {
        die("Not enough stock.");
    }

    $Tot_Price = $Sale_Qty * $med['Med_Price'];
    $S_Date = date("Y-m-d");
    $S_Time = date("H:i:s");

    $salesInsert = $conn->query("INSERT INTO sales (C_ID, S_Date, S_Time, Total_Amount)
                                 VALUES ($C_ID, '$S_Date', '$S_Time', $Tot_Price)");
    if (!$salesInsert) {
        die("Sales insert failed: " . $conn->error);
    }

    $Sale_ID = $conn->insert_id;

    $itemInsert = $conn->query("INSERT INTO sales_items (Sale_ID, Med_ID, Sale_Qty, Tot_Price)
                                VALUES ($Sale_ID, $Med_ID, $Sale_Qty, $Tot_Price)");
    if (!$itemInsert) {
        die("Sales item insert failed: " . $conn->error);
    }

    $conn->query("UPDATE medicine SET Med_Qty = Med_Qty - $Sale_Qty WHERE Med_ID = $Med_ID");

    echo "<script>alert('Sale success'); window.location='sales_report.php';</script>";
}
?>