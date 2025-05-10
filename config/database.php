<?php
// config/database.php

$db_host = "localhost";
$db_user = "username";     // Ganti dengan username database Anda
$db_pass = "password";     // Ganti dengan password database
$db_name = "modyzz_hosting";

// Buat koneksi
$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if ($db->connect_error) {
    die("Koneksi database gagal: " . $db->connect_error);
}
?>