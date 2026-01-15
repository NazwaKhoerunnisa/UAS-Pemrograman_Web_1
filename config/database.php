<?php
// config/database.php

// Konfigurasi koneksi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'adcollection');

// Membuat koneksi
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset UTF-8
mysqli_set_charset($conn, "utf8");

// Fungsi untuk mencegah SQL Injection
function escape($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Fungsi format rupiah
function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

// Fungsi tanggal Indonesia
function tanggal_indo($tanggal) {
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    $pecah = explode('-', $tanggal);
    return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
}

// Fungsi upload foto
function upload_foto($file) {
    $nama_file = $file['name'];
    $ukuran_file = $file['size'];
    $error = $file['error'];
    $tmp_name = $file['tmp_name'];

    if ($error === 4) {
        return ['status' => false, 'message' => 'Tidak ada file yang diupload'];
    }

    $ekstensi_valid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if (!in_array($ekstensi_file, $ekstensi_valid)) {
        return ['status' => false, 'message' => 'Format file harus jpg, jpeg, png, atau gif'];
    }

    if ($ukuran_file > 2000000) {
        return ['status' => false, 'message' => 'Ukuran file maksimal 2MB'];
    }

    $nama_file_baru = uniqid() . '.' . $ekstensi_file;
    $folder = __DIR__ . '/../assets/img/uploads/';

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    if (move_uploaded_file($tmp_name, $folder . $nama_file_baru)) {
        return ['status' => true, 'filename' => $nama_file_baru];
    } else {
        return ['status' => false, 'message' => 'Gagal mengupload file'];
    }
}
?>