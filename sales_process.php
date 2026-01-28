<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");
include 'check_expiry.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : "NULL";
    $total_amount = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $medicines = json_decode($_POST['medicines_json'], true);
    
    foreach ($medicines as $med) {
        $med_id = intval($med['id']);
        $requested_qty = intval($med['qty']);
    
        $stock_check = $conn->query("SELECT Med_Name, Med_Qty FROM medicine WHERE Med_ID = $med_id");
        
        if ($stock_check && $stock_check->num_rows > 0) {
            $stock = $stock_check->fetch_assoc();
            
            if ($stock['Med_Qty'] < $requested_qty) {

                $med_name = urlencode($stock['Med_Name']);
                header("Location: sales.php?error=stock&medicine=$med_name&available={$stock['Med_Qty']}&requested=$requested_qty");
                exit();
            }
        }
    }
 
    foreach ($medicines as $med) {
        $med_id = intval($med['id']);
        $expiryCheck = isMedicineExpired($conn, $med_id);
        
        if ($expiryCheck['is_expired']) {
         
            header("Location: sales.php?error=expired&medicine=" . urlencode($expiryCheck['medicine_name']));
            exit();
        }
    }

    $insert_sale = "INSERT INTO sales (C_ID, S_Date, S_Time, Total_Amount)
                    VALUES ($customer_id, '$date', '$time', $total_amount)";
    
    if ($conn->query($insert_sale)) {
        $sale_id = $conn->insert_id;

        foreach ($medicines as $med) {
            $med_id = intval($med['id']);
            $qty = intval($med['qty']);
            $price = floatval($med['price']);
            $total = floatval($med['total']);

            $insert_item = "INSERT INTO sales_items (Sale_ID, Med_ID, Sale_Qty, Tot_Price)
                            VALUES ($sale_id, $med_id, $qty, $total)";
            $conn->query($insert_item);

            $update_stock = "UPDATE medicine SET Med_Qty = Med_Qty - $qty WHERE Med_ID = $med_id";
            $conn->query($update_stock);
        }

        @include 'check_alerts.php';

        header("Location: payment.php?sale_id=$sale_id");
        exit();
    } else {
        echo "Insert sales failed: " . $conn->error;
    }
}
?>