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
    $nama_pembeli = escape($_POST['nama_pembeli'] ?? '');
    $email_pembeli = escape($_POST['email_pembeli'] ?? '');
    $nomor_telepon = escape($_POST['nomor_telepon'] ?? '');
    $alamat_pengiriman = escape($_POST['alamat_pengiriman'] ?? '');
    $platform = escape($_POST['platform'] ?? '');
    $status = escape($_POST['status'] ?? 'pending');
    $catatan = escape($_POST['catatan'] ?? '');
    $tanggal = escape($_POST['tanggal'] ?? date('Y-m-d'));
    
    if (empty($order_id) || empty($nama_pembeli) || empty($nomor_telepon) || empty($alamat_pengiriman)) {
        $_SESSION['error'] = 'Data tidak lengkap!';
        header("Location: edit.php?id=$order_id");
        exit();
    }
    
    $update_query = "UPDATE orders SET nama_pembeli = '$nama_pembeli', email_pembeli = '$email_pembeli', 
                     nomor_telepon = '$nomor_telepon', alamat_pengiriman = '$alamat_pengiriman', 
                     platform = '$platform', status = '$status', catatan = '$catatan',
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
