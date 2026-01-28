<?php

function isMedicineExpired($conn, $med_id) {
   
    $query = $conn->query("
        SELECT 
            p.Exp_Date,
            p.P_Qty,
            m.Med_Name
        FROM purchase p
        JOIN medicine m ON p.Med_ID = m.Med_ID
        WHERE p.Med_ID = $med_id
        AND p.Exp_Date < CURDATE()
        AND p.P_Qty > 0
        ORDER BY p.Exp_Date ASC
        LIMIT 1
    ");
    
    if ($query && $query->num_rows > 0) {
        $expired = $query->fetch_assoc();
        return [
            'is_expired' => true,
            'exp_date' => $expired['Exp_Date'],
            'medicine_name' => $expired['Med_Name']
        ];
    }
    
    return ['is_expired' => false];
}

function getAvailableMedicines($conn) {
    
    $query = $conn->query("
        SELECT DISTINCT
            m.Med_ID,
            m.Med_Name,
            m.Med_Price,
            m.Med_Qty,
            m.Category
        FROM medicine m
        WHERE m.Med_ID NOT IN (
            SELECT DISTINCT Med_ID 
            FROM purchase 
            WHERE Exp_Date < CURDATE() 
            AND P_Qty > 0
        )
        AND m.Med_Qty > 0
        ORDER BY m.Med_Name
    ");
    
    return $query;
}
?>