<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : "NULL";
    $total_amount = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;
    $date = date("Y-m-d");
    $time = date("H:i:s");

    // Insert sale
    $insert_sale = "INSERT INTO sales (C_ID, S_Date, S_Time, Total_Amount)
                    VALUES ($customer_id, '$date', '$time', $total_amount)";
    if ($conn->query($insert_sale)) {
        $sale_id = $conn->insert_id;

        // Decode medicines JSON
        $medicines = json_decode($_POST['medicines_json'], true);

        foreach ($medicines as $med) {
            $med_id = intval($med['id']);
            $qty = intval($med['qty']);
            $price = floatval($med['price']);
            $total = floatval($med['total']);

            $insert_item = "INSERT INTO sales_items (Sale_ID, Med_ID, Sale_Qty, Tot_Price)
                            VALUES ($sale_id, $med_id, $qty, $total)";
            $conn->query($insert_item);

            // Update stock
            $update_stock = "UPDATE medicine SET Med_Qty = Med_Qty - $qty WHERE Med_ID = $med_id";
            $conn->query($update_stock);
        }

        // Redirect to payment page
        header("Location: payment.php?sale_id=$sale_id");
        exit();
    } else {
        echo "Insert sales failed: " . $conn->error;
    }
}
?>
