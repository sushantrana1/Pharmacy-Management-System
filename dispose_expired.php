<?php
session_start();
$conn = new mysqli("localhost", "root", "", "pharmacy");

if (isset($_GET['med_id']) && isset($_GET['exp_date'])) {
    $med_id = intval($_GET['med_id']);
    $exp_date = $_GET['exp_date'];
 
    $conn->query("
        UPDATE purchase 
        SET P_Qty = 0 
        WHERE Med_ID = $med_id 
        AND Exp_Date = '$exp_date'
    ");

    $conn->query("
        UPDATE medicine m
        SET Med_Qty = (
            SELECT COALESCE(SUM(P_Qty), 0) 
            FROM purchase 
            WHERE Med_ID = m.Med_ID
        )
        WHERE Med_ID = $med_id
    ");
}

header("Location: expired_medicines.php");
exit();
?>