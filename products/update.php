<?php
// products/update.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $kode = escape($_POST['kode'] ?? '');
    $nama_produk = escape($_POST['nama_produk'] ?? '');
    $kategori = escape($_POST['kategori'] ?? '');
    $deskripsi = escape($_POST['deskripsi'] ?? '');
    $harga = floatval($_POST['harga'] ?? 0);
    $stok = intval($_POST['stok'] ?? 0);
    $foto_lama = escape($_POST['foto_lama'] ?? '');
    
    if (empty($id) || empty($nama_produk) || empty($kode) || empty($kategori) || $harga <= 0) {
        $_SESSION['error'] = 'Data tidak lengkap!';
        header("Location: edit.php?id=$id");
        exit();
    }
    
    // Cek kode tidak duplikat dengan produk lain
    $check_kode = "SELECT id FROM products WHERE kode = '$kode' AND id != $id";
    $check_result = mysqli_query($conn, $check_kode);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = 'Kode produk sudah digunakan!';
        header("Location: edit.php?id=$id");
        exit();
    }
    
    // Ambil data produk lama untuk foto
    $old_product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT foto FROM products WHERE id = $id"));
    $foto = $old_product['foto'];
    
    // Handle upload foto baru
    if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] != 4) {
        $result = upload_foto($_FILES['foto']);
        if ($result['status']) {
            // Hapus foto lama jika ada
            if ($foto_lama && file_exists("../assets/img/uploads/$foto_lama")) {
                unlink("../assets/img/uploads/$foto_lama");
            }
            $foto = $result['filename'];
        } else {
            $_SESSION['error'] = $result['message'];
            header("Location: edit.php?id=$id");
            exit();
        }
    }
    
    $update_query = "UPDATE products SET nama_produk = '$nama_produk', kode = '$kode', kategori = '$kategori', 
                     deskripsi = '$deskripsi', harga = $harga, stok = $stok, foto = " . 
                     ($foto ? "'$foto'" : "NULL") . ", updated_at = NOW() WHERE id = $id";
    
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = 'Produk berhasil diupdate!';
        header("Location: index.php");
    } else {
        $_SESSION['error'] = 'Gagal mengupdate produk: ' . mysqli_error($conn);
        header("Location: edit.php?id=$id");
    }
} else {
    $_SESSION['error'] = 'Method tidak diizinkan!';
    header("Location: index.php");
}
exit();
?>
            header("Location: edit.php?id=$id");
            exit();
        }
    }
    
    // Update database
    $query = "UPDATE products SET 
              kode = '$kode',
              nama_produk = '$nama_produk',
              kategori = '$kategori',
              harga = '$harga',
              stok = '$stok',
              deskripsi = '$deskripsi',
              foto = " . ($foto ? "'$foto'" : "NULL") . "
              WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Produk '$nama_produk' berhasil diupdate!";
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Gagal mengupdate produk: " . mysqli_error($conn);
        header("Location: edit.php?id=$id");
    }
} else {
    header("Location: index.php");
}
exit();
?>