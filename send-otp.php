<?php
// send-otp.php

require_once 'config/database.php';
require_once 'config/whatsapp-api.php';
require_once 'includes/auth.php';

// Contoh penggunaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Generate OTP
    $otp = generateOTP();
    
    // Simpan OTP ke database (contoh)
    $db->query("UPDATE users SET otp = '$otp', otp_expiry = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = '$email'");
    
    // Kirim OTP via WhatsApp
    $result = sendWhatsAppOTP($phone, $otp);
    
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'OTP dikirim!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim OTP']);
    }
}
?>