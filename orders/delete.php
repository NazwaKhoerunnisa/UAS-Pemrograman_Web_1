<?php
// orders/delete.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$order_id = intval($_GET['id'] ?? 0);

if (empty($order_id)) {
    $_SESSION['error'] = 'ID pesanan tidak valid!';
    header("Location: index.php");
    exit();
}

// Ambil data pesanan untuk verifikasi
$order_query = "SELECT * FROM orders WHERE id = $order_id";
$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    $_SESSION['error'] = 'Pesanan tidak ditemukan!';
    header("Location: index.php");
    exit();
}

// Delete order items first (cascade)
$delete_items = "DELETE FROM order_items WHERE order_id = $order_id";
mysqli_query($conn, $delete_items);

// Delete order
$delete_order = "DELETE FROM orders WHERE id = $order_id";

if (mysqli_query($conn, $delete_order)) {
    $_SESSION['success'] = 'Pesanan berhasil dihapus!';
} else {
    $_SESSION['error'] = 'Gagal menghapus pesanan: ' . mysqli_error($conn);
}

header("Location: index.php");
exit();
?>
