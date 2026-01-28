<?php

header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "pharmacy");
include 'check_expiry.php';

if (isset($_GET['med_id'])) {
    $med_id = intval($_GET['med_id']);
    $result = isMedicineExpired($conn, $med_id);
    echo json_encode($result);
} else {
    echo json_encode(['is_expired' => false]);
}
?>