<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");

$Med_ID = $_POST['Med_ID'];
$Sup_ID = $_POST['Sup_ID'];
$P_Qty = $_POST['P_Qty'];
$P_Cost = $_POST['P_Cost'];
$Mfg = $_POST['Mfg_Date'];
$Exp = $_POST['Exp_Date'];

$conn->query("INSERT INTO purchase (Med_ID, Sup_ID, P_Qty, P_Cost, Mfg_Date, Exp_Date)
              VALUES ($Med_ID, $Sup_ID, $P_Qty, $P_Cost, '$Mfg', '$Exp')");

$conn->query("UPDATE medicine SET Med_Qty = Med_Qty + $P_Qty WHERE Med_ID = $Med_ID");

header("Location: purchase.php");
?>