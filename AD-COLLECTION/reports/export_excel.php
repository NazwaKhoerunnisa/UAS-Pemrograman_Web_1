<?php
// reports/export_excel.php - Export data ke Excel
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak!");
}

require_once '../config/database.php';

// Filter data
$filter_type = $_GET['type'] ?? 'orders'; // orders atau products
$filter_platform = $_GET['platform'] ?? '';
$filter_bulan = $_GET['bulan'] ?? date('m');
$filter_tahun = $_GET['tahun'] ?? date('Y');

if ($filter_type == 'orders') {
    $bulan_int = (int)$filter_bulan;
    $tahun_int = (int)$filter_tahun;
    $query = "SELECT nomor_pesanan, tanggal, nama_pembeli, nomor_telepon, alamat_pengiriman, platform, status, total 
              FROM orders WHERE MONTH(tanggal) = $bulan_int AND YEAR(tanggal) = $tahun_int AND status = 'selesai'";
    
    if (!empty($filter_platform)) {
        $platform_safe = mysqli_real_escape_string($conn, $filter_platform);
        $query .= " AND platform = '$platform_safe'";
    }
    
    $query .= " ORDER BY tanggal DESC";
    $data = mysqli_query($conn, $query);
    $filename = 'Laporan_Penjualan_' . date('Y-m-d');
    
} else {
    $query = "SELECT id, sku, nama_produk, kategori, harga_jual, stok FROM products ORDER BY id DESC";
    $data = mysqli_query($conn, $query);
    $filename = 'Data_Produk_' . date('Y-m-d');
}

// Set header untuk download Excel
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
header('Cache-Control: max-age=0');

// BOM untuk UTF-8
echo "\xEF\xBB\xBF";

// Header columns
if ($filter_type == 'orders') {
    $headers = ['Kode Pesanan', 'Tanggal', 'Pembeli', 'Telepon', 'Alamat', 'Platform', 'Status', 'Total'];
} else {
    $headers = ['ID', 'Kode', 'Nama Produk', 'Kategori', 'Harga', 'Stok'];
}

echo implode("\t", $headers) . "\n";

// Data rows
while ($row = mysqli_fetch_assoc($data)) {
    if ($filter_type == 'orders') {
        $values = [
            $row['nomor_pesanan'],
            $row['tanggal'],
            $row['nama_pembeli'],
            $row['nomor_telepon'],
            $row['alamat_pengiriman'],
            ucfirst($row['platform']),
            strtoupper($row['status']),
            $row['total']
        ];
    } else {
        $values = [
            $row['id'],
            $row['sku'],
            $row['nama_produk'],
            $row['kategori'],
            $row['harga_jual'],
            $row['stok']
        ];
    }
    
    // Escape dan quote fields yang mengandung tab, newline, atau quote
    $escaped_values = array_map(function($val) {
        if (preg_match('/[\t\n\r"]/i', $val)) {
            return '"' . str_replace('"', '""', $val) . '"';
        }
        return $val;
    }, $values);
    
    echo implode("\t", $escaped_values) . "\n";
}

exit();
