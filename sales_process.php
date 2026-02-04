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

    // Get payment method details
    $payment_method = isset($_POST['payment_method_final']) ? $_POST['payment_method_final'] : 'Cash';
    $payment_status = ($payment_method === 'Credit') ? 'Pending' : 'Paid';
    
    // Get payment references
    $esewa_transaction_id = isset($_POST['esewa_transaction_id']) ? $_POST['esewa_transaction_id'] : null;
    $bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : null;
    $bank_reference = isset($_POST['bank_reference']) ? $_POST['bank_reference'] : null;
    $credit_notes = isset($_POST['credit_notes']) ? $_POST['credit_notes'] : null;
    
    // Build payment reference based on method
    $payment_reference = '';
    if ($payment_method === 'eSewa' && $esewa_transaction_id) {
        $payment_reference = "eSewa: " . $esewa_transaction_id;
    } elseif ($payment_method === 'Bank' && $bank_reference) {
        $payment_reference = "Bank: " . $bank_reference;
        if ($bank_name) {
            $payment_reference .= " (" . $bank_name . ")";
        }
    } elseif ($payment_method === 'Credit' && $credit_notes) {
        $payment_reference = $credit_notes;
    }

    // Decode medicines JSON
    $medicines = json_decode($_POST['medicines_json'], true);
    
    // VALIDATION 1: Check stock availability
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
    
    // VALIDATION 2: Check expiry
    foreach ($medicines as $med) {
        $med_id = intval($med['id']);
        $expiryCheck = isMedicineExpired($conn, $med_id);
        
        if ($expiryCheck['is_expired']) {
            header("Location: sales.php?error=expired&medicine=" . urlencode($expiryCheck['medicine_name']));
            exit();
        }
    }

    // All validations passed - Insert sale with payment info
    $payment_reference_sql = $payment_reference ? "'" . $conn->real_escape_string($payment_reference) . "'" : "NULL";
    
    $insert_sale = "INSERT INTO sales (C_ID, S_Date, S_Time, Total_Amount, payment_method, payment_reference, payment_status)
                    VALUES ($customer_id, '$date', '$time', $total_amount, '$payment_method', $payment_reference_sql, '$payment_status')";
    
    if ($conn->query($insert_sale)) {
        $sale_id = $conn->insert_id;

        // Insert sale items and update stock
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

        // Insert payment transaction record
        $ref_number = $payment_reference ? "'" . $conn->real_escape_string($payment_reference) . "'" : "NULL";
        $bank_name_sql = $bank_name ? "'" . $conn->real_escape_string($bank_name) . "'" : "NULL";
        $esewa_id_sql = $esewa_transaction_id ? "'" . $conn->real_escape_string($esewa_transaction_id) . "'" : "NULL";
        $notes_sql = $credit_notes ? "'" . $conn->real_escape_string($credit_notes) . "'" : "NULL";
        
        $insert_transaction = "INSERT INTO payment_transactions 
            (Sale_ID, payment_method, amount, reference_number, bank_name, esewa_transaction_id, status, notes)
            VALUES ($sale_id, '$payment_method', $total_amount, $ref_number, $bank_name_sql, $esewa_id_sql, 
                    " . ($payment_status === 'Paid' ? "'Success'" : "'Pending'") . ", $notes_sql)";
        $conn->query($insert_transaction);

        // Update daily payment summary
        $update_summary = "INSERT INTO payment_summary 
            (summary_date, 
             cash_amount, 
             esewa_amount, 
             bank_amount, 
             credit_amount, 
             total_amount)
            VALUES 
            ('$date', 
             " . ($payment_method === 'Cash' ? $total_amount : 0) . ",
             " . ($payment_method === 'eSewa' ? $total_amount : 0) . ",
             " . ($payment_method === 'Bank' ? $total_amount : 0) . ",
             " . ($payment_method === 'Credit' ? $total_amount : 0) . ",
             $total_amount)
            ON DUPLICATE KEY UPDATE
             cash_amount = cash_amount + " . ($payment_method === 'Cash' ? $total_amount : 0) . ",
             esewa_amount = esewa_amount + " . ($payment_method === 'eSewa' ? $total_amount : 0) . ",
             bank_amount = bank_amount + " . ($payment_method === 'Bank' ? $total_amount : 0) . ",
             credit_amount = credit_amount + " . ($payment_method === 'Credit' ? $total_amount : 0) . ",
             total_amount = total_amount + $total_amount";
        $conn->query($update_summary);

        // Check alerts
        @include 'check_alerts.php';

        // Redirect to payment page
        header("Location: payment.php?sale_id=$sale_id");
        exit();
    } else {
        echo "Insert sales failed: " . $conn->error;
    }
}
?>