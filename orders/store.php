<?php
// orders/store.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_customer = escape($_POST['nama_customer'] ?? '');
    $telepon = escape($_POST['telepon'] ?? '');
    $alamat = escape($_POST['alamat'] ?? '');
    $platform = escape($_POST['platform'] ?? '');
    $status = escape($_POST['status'] ?? 'pending');
    $tanggal = escape($_POST['tanggal'] ?? date('Y-m-d'));
    $total = floatval($_POST['total'] ?? 0);
    
    $product_ids = $_POST['product_id'] ?? [];
    $jumlah_array = $_POST['jumlah'] ?? [];
    
    // Validasi
    if (empty($nama_customer) || empty($telepon) || empty($alamat) || empty($platform) || count($product_ids) == 0) {
        $_SESSION['error'] = 'Semua field required harus diisi!';
        header("Location: create.php");
        exit();
    }
    
    // Generate nomor pesanan
    $year = date('Y');
    $month = date('m');
    $last_query = "SELECT MAX(CAST(SUBSTRING(kode_order, -4) AS UNSIGNED)) as last_num 
                   FROM orders WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month'";
    $last_result = mysqli_query($conn, $last_query);
    $last_row = mysqli_fetch_assoc($last_result);
    $next_num = ($last_row['last_num'] ?? 0) + 1;
    $kode_order = 'PES' . $year . $month . str_pad($next_num, 4, '0', STR_PAD_LEFT);
    
    // Insert pesanan
    $insert_order = "INSERT INTO orders (kode_order, nama_customer, telepon, alamat, platform, status, total, tanggal) 
                     VALUES ('$kode_order', '$nama_customer', '$telepon', '$alamat', '$platform', '$status', $total, '$tanggal')";
    
    if (mysqli_query($conn, $insert_order)) {
        $order_id = mysqli_insert_id($conn);
        
        // Insert items pesanan
        $error_items = false;
        foreach ($product_ids as $idx => $product_id) {
            $product_id = intval($product_id);
            $jumlah = intval($jumlah_array[$idx] ?? 1);
            
            // Ambil harga produk
            $price_query = "SELECT harga FROM products WHERE id = $product_id";
            $price_result = mysqli_query($conn, $price_query);
            $price_row = mysqli_fetch_assoc($price_result);
            $harga_satuan = $price_row['harga'] ?? 0;
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
            $_SESSION['success'] = 'Pesanan berhasil ditambahkan dengan nomor: ' . $kode_order;
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
