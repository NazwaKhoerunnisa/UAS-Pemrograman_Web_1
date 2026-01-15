<?php
/**
 * SIMPLE FIX - Database Schema Checker
 * Jalankan file ini untuk lihat struktur database yang sebenarnya
 * Akses: http://localhost/UAS-PW1_AD-COLLECTION/simple_fix.php
 */

require_once 'config/database.php';

// Check jika database ada
$check_db = "SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'adcollection'";
$result = mysqli_query($conn, $check_db);

if (mysqli_num_rows($result) == 0) {
    die("<h2 style='color:red;'>❌ Database 'adcollection' tidak ditemukan!</h2><p>Silakan import database_setup.sql terlebih dahulu di phpMyAdmin</p>");
}

echo "<h2 style='color:green;'>✅ Database ditemukan!</h2>";

// CEK STRUKTUR TABEL PRODUCTS
echo "<h3>📊 Struktur Tabel PRODUCTS:</h3>";
echo "<pre style='background: #f0f0f0; padding: 10px; overflow-x: auto;'>";
$products_structure = "DESCRIBE products";
$result = mysqli_query($conn, $products_structure);
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . " (" . $row['Type'] . ")<br>";
}
echo "</pre>";

// CEK STRUKTUR TABEL ORDERS
echo "<h3>📊 Struktur Tabel ORDERS:</h3>";
echo "<pre style='background: #f0f0f0; padding: 10px; overflow-x: auto;'>";
$orders_structure = "DESCRIBE orders";
$result = mysqli_query($conn, $orders_structure);
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . " (" . $row['Type'] . ")<br>";
}
echo "</pre>";

// CEK DATA SAMPLE
echo "<h3>📊 Sample Data PRODUCTS:</h3>";
$sample = "SELECT * FROM products LIMIT 1";
$result = mysqli_query($conn, $sample);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<pre style='background: #f0f0f0; padding: 10px; overflow-x: auto;'>";
    print_r($row);
    echo "</pre>";
} else {
    echo "❌ Tidak ada data produk";
}

echo "<style>
body { font-family: Arial; margin: 20px; background: #f5f5f5; }
h2, h3 { color: #333; }
pre { font-size: 12px; }
</style>";
?>

