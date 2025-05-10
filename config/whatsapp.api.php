<?php
// config/whatsapp-api.php

require_once 'database.php'; // Memanggil koneksi database

function sendWhatsAppOTP($number, $otp) {
    // Ganti dengan API Key dari penyedia layanan (Twilio/Wablas)
    $api_key = "XXV4YOFi";
    
    // Format nomor (pastikan +62 untuk Indonesia)
    $clean_number = preg_replace('/[^0-9]/', '', $number);
    if (substr($clean_number, 0, 1) === '0') {
        $clean_number = '+62' . substr($clean_number, 1);
    }

    // Jika menggunakan Twilio
    $url = "https://api.twilio.com/2010-04-01/Accounts/{$api_key}/Messages.json";
    
    $data = [
        'Body' => "Kode OTP Anda: {$otp}",
        'From' => 'whatsapp:+6282181669356', // Nomor Twilio
        'To' => 'whatsapp:' . $clean_number
    ];

    // Eksekusi request (gunakan cURL)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "{$api_key}:{$auth_token}"); // Untuk Twilio
    
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>