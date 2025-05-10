<?php
// includes/auth.php

require_once '../config/database.php';

function verifyLogin($email, $otp) {
    global $db;
    
    // Bersihkan input
    $email = $db->real_escape_string($email);
    $otp = $db->real_escape_string($otp);
    
    // Query ke database
    $query = "SELECT * FROM users WHERE email = '$email' AND otp = '$otp' AND otp_expiry > NOW()";
    $result = $db->query($query);
    
    return ($result->num_rows > 0);
}

// Contoh fungsi generate OTP
function generateOTP() {
    return rand(100000, 999999); // 6 digit angka
}
?>