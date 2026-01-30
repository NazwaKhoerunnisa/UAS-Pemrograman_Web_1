<?php
// products/store.php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sku = escape($_POST['sku']);
    $nama_produk = escape($_POST['nama_produk']);
    $kategori = escape($_POST['kategori']);
    $harga_beli = floatval($_POST['harga_beli']);
    $harga_jual = floatval($_POST['harga_jual']);
    $stok = intval($_POST['stok']);
    $deskripsi = escape($_POST['deskripsi']);
    
    // Cek apakah sku sudah ada
    $check_query = "SELECT * FROM products WHERE sku = '$sku'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = "SKU produk '$sku' sudah digunakan!";
        header("Location: create.php");
        exit();
    }
    
    // Upload foto
    $foto_produk = NULL;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] != 4) {
        $upload_result = upload_foto($_FILES['foto']);
        
        if ($upload_result['status']) {
            $foto_produk = $upload_result['filename'];
        } else {
            $_SESSION['error'] = $upload_result['message'];
            header("Location: create.php");
            exit();
        }
    }
    
    // Insert ke database
    $query = "INSERT INTO products (sku, nama_produk, kategori, harga_beli, harga_jual, stok, deskripsi, foto_produk) 
              VALUES ('$sku', '$nama_produk', '$kategori', $harga_beli, $harga_jual, $stok, '$deskripsi', " . 
              ($foto_produk ? "'$foto_produk'" : "NULL") . ")";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Produk '$nama_produk' berhasil ditambahkan!";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Gagal menambahkan produk: " . mysqli_error($conn);
        header("Location: create.php");
    }
} else {
    header("Location: index.php");
}
exit();
?>