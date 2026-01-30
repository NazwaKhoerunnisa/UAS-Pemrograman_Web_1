<?php
// orders/store.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pembeli = escape($_POST['nama_pembeli'] ?? '');
    $nomor_telepon = escape($_POST['nomor_telepon'] ?? '');
    $alamat_pengiriman = escape($_POST['alamat_pengiriman'] ?? '');
    $email_pembeli = escape($_POST['email_pembeli'] ?? '');
    $platform = escape($_POST['platform'] ?? '');
    $status = escape($_POST['status'] ?? 'pending');
    $tanggal = escape($_POST['tanggal'] ?? date('Y-m-d'));
    $catatan = escape($_POST['catatan'] ?? '');
    $total = floatval($_POST['total'] ?? 0);
    
    $product_ids = $_POST['product_id'] ?? [];
    $jumlah_array = $_POST['jumlah'] ?? [];
    
    // Validasi
    if (empty($nama_pembeli) || empty($nomor_telepon) || empty($alamat_pengiriman) || empty($platform) || count($product_ids) == 0) {
        $_SESSION['error'] = 'Semua field required harus diisi!';
        header("Location: create.php");
        exit();
    }
    
    // Generate nomor pesanan
    $year = date('Y');
    $month = date('m');
    $last_query = "SELECT MAX(CAST(SUBSTRING(nomor_pesanan, -4) AS UNSIGNED)) as last_num 
                   FROM orders WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month'";
    $last_result = mysqli_query($conn, $last_query);
    $last_row = mysqli_fetch_assoc($last_result);
    $next_num = ($last_row['last_num'] ?? 0) + 1;
    $nomor_pesanan = 'PES' . $year . $month . str_pad($next_num, 4, '0', STR_PAD_LEFT);
    
    // Insert pesanan
    $insert_order = "INSERT INTO orders (nomor_pesanan, nama_pembeli, email_pembeli, nomor_telepon, alamat_pengiriman, platform, status, total, tanggal, catatan) 
                     VALUES ('$nomor_pesanan', '$nama_pembeli', '$email_pembeli', '$nomor_telepon', '$alamat_pengiriman', '$platform', '$status', $total, '$tanggal', '$catatan')";
    
    if (mysqli_query($conn, $insert_order)) {
        $order_id = mysqli_insert_id($conn);
        
        // Insert items pesanan
        $error_items = false;
        foreach ($product_ids as $idx => $product_id) {
            $product_id = intval($product_id);
            $jumlah = intval($jumlah_array[$idx] ?? 1);
            
            // Ambil harga produk
            $price_query = "SELECT harga_jual FROM products WHERE id = $product_id";
            $price_result = mysqli_query($conn, $price_query);
            $price_row = mysqli_fetch_assoc($price_result);
            $harga_satuan = $price_row['harga_jual'] ?? 0;
            $subtotal = $harga_satuan * $jumlah;
            
            // Insert order item
            $insert_item = "INSERT INTO order_items (order_id, product_id, jumlah, harga_satuan, subtotal) 
                           VALUES ($order_id, $product_id, $jumlah, $harga_satuan, $subtotal)";
            
            if (!mysqli_query($conn, $insert_item)) {
                $error_items = true;
                break;
            }
        }
        
        if ($error_items) {
            $_SESSION['error'] = 'Gagal menyimpan item pesanan!';
        } else {
            $_SESSION['success'] = 'Pesanan berhasil ditambahkan dengan nomor: ' . $nomor_pesanan;
        }
    } else {
        $_SESSION['error'] = 'Gagal menambahkan pesanan: ' . mysqli_error($conn);
    }
} else {
    $_SESSION['error'] = 'Method tidak diizinkan!';
}

header("Location: index.php");
exit();
?>
