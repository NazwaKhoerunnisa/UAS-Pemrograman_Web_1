<?php
// orders/update.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = intval($_POST['id'] ?? 0);
    $nama_customer = escape($_POST['nama_customer'] ?? '');
    $telepon = escape($_POST['telepon'] ?? '');
    $alamat = escape($_POST['alamat'] ?? '');
    $platform = escape($_POST['platform'] ?? '');
    $status = escape($_POST['status'] ?? 'pending');
    $tanggal = escape($_POST['tanggal'] ?? date('Y-m-d'));
    
    if (empty($order_id) || empty($nama_customer) || empty($telepon) || empty($alamat)) {
        $_SESSION['error'] = 'Data tidak lengkap!';
        header("Location: edit.php?id=$order_id");
        exit();
    }
    
    $update_query = "UPDATE orders SET nama_customer = '$nama_customer', telepon = '$telepon', 
                     alamat = '$alamat', platform = '$platform', status = '$status', 
                     tanggal = '$tanggal', updated_at = NOW() WHERE id = $order_id";
    
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = 'Pesanan berhasil diupdate!';
    } else {
        $_SESSION['error'] = 'Gagal mengupdate pesanan: ' . mysqli_error($conn);
    }
} else {
    $_SESSION['error'] = 'Method tidak diizinkan!';
}

header("Location: index.php");
exit();
?>
