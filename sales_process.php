<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy");

// Get form data
$Med_ID = $_POST['Med_ID'];
$Sale_Qty = $_POST['Sale_Qty'];
$Tot_Price = $_POST['Tot_Price'];
$C_ID = !empty($_POST['C_ID']) ? $_POST['C_ID'] : 'NULL';
$E_ID = $_SESSION['user_id'] ?? 1; // fallback for testing

// Step 1: Insert into `sales` table
$conn->query("INSERT INTO sales (E_ID, C_ID, Total_Amount) VALUES ($E_ID, $C_ID, $Tot_Price)");
$Sale_ID = $conn->insert_id; // get last inserted Sale_ID

// Step 2: Insert into `sales_items`
$conn->query("INSERT INTO sales_items (Sale_ID, Med_ID, Sale_Qty, Tot_Price)
              VALUES ($Sale_ID, $Med_ID, $Sale_Qty, $Tot_Price)");

// Step 3: Update medicine stock
$conn->query("UPDATE medicine SET Med_Qty = Med_Qty - $Sale_Qty WHERE Med_ID = $Med_ID");

// Go back to sales page
header("Location: sales_report.php");
?>
