<?php
// products/store.php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = escape($_POST['kode']);
    $nama_produk = escape($_POST['nama_produk']);
    $kategori = escape($_POST['kategori']);
    $harga = escape($_POST['harga']);
    $stok = escape($_POST['stok']);
    $deskripsi = escape($_POST['deskripsi']);
    
    // Cek apakah kode sudah ada
    $check_query = "SELECT * FROM products WHERE kode = '$kode'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = "Kode produk '$kode' sudah digunakan!";
        header("Location: create.php");
        exit();
    }
    
    // Upload foto
    $foto = NULL;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] != 4) {
        $upload_result = upload_foto($_FILES['foto']);
        
        if ($upload_result['status']) {
            $foto = $upload_result['filename'];
        } else {
            $_SESSION['error'] = $upload_result['message'];
            header("Location: create.php");
            exit();
        }
    }
    
    // Insert ke database
    $query = "INSERT INTO products (kode, nama_produk, kategori, harga, stok, deskripsi, foto) 
              VALUES ('$kode', '$nama_produk', '$kategori', '$harga', '$stok', '$deskripsi', " . 
              ($foto ? "'$foto'" : "NULL") . ")";
    
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