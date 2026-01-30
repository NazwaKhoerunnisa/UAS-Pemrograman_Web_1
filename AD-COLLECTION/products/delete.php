<?php
// products/delete.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$id = intval($_GET['id'] ?? 0);

if (empty($id)) {
    $_SESSION['error'] = 'ID produk tidak valid!';
    header("Location: index.php");
    exit();
}

// Ambil data produk untuk hapus foto
$query = "SELECT nama_produk, foto FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
    $nama_produk = $product['nama_produk'];
    
    // Hapus foto jika ada dan bukan default
    if ($product['foto'] && $product['foto'] != 'default.jpg' && 
        file_exists("../assets/img/uploads/" . $product['foto'])) {
        unlink("../assets/img/uploads/" . $product['foto']);
    }
    
    // Hapus dari database
    $delete_query = "DELETE FROM products WHERE id = $id";
    
    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['success'] = "Produk '$nama_produk' berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Gagal menghapus produk: " . mysqli_error($conn);
    }
} else {
    $_SESSION['error'] = "Produk tidak ditemukan!";
}

header("Location: index.php");
exit();
?>