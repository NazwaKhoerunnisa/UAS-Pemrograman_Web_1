<?php
// reports/export_pdf.php - Export laporan ke PDF
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak!");
}

require_once '../config/database.php';

// Filter data
$filter_platform = $_GET['platform'] ?? '';
$filter_bulan = $_GET['bulan'] ?? date('m');
$filter_tahun = $_GET['tahun'] ?? date('Y');

// Query laporan penjualan - hanya status selesai
$bulan_int = (int)$filter_bulan;
$tahun_int = (int)$filter_tahun;
$query = "SELECT * FROM orders WHERE MONTH(tanggal) = $bulan_int AND YEAR(tanggal) = $tahun_int AND status = 'selesai'";

if (!empty($filter_platform)) {
    $platform_safe = mysqli_real_escape_string($conn, $filter_platform);
    $query .= " AND platform = '$platform_safe'";
}

$query .= " ORDER BY tanggal DESC";
$reports = mysqli_query($conn, $query);

// Hitung total - hanya status selesai
$total_query = "SELECT COUNT(*) as total_pesanan, SUM(total) as total_penjualan FROM orders 
                WHERE MONTH(tanggal) = $bulan_int AND YEAR(tanggal) = $tahun_int AND status = 'selesai'";
if (!empty($filter_platform)) {
    $total_query .= " AND platform = '$platform_safe'";
}

$total_result = mysqli_query($conn, $total_query);
$summary = mysqli_fetch_assoc($total_result);

// Generate HTML untuk PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            color: #8B7355;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border-left: 4px solid #8B7355;
        }
        .info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table thead {
            background-color: #8B7355;
            color: white;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }
        .summary p {
            margin: 10px 0;
            font-size: 14px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AD COLLECTION</h1>
        <p>Fashion Management System</p>
        <p style="font-size: 14px;">Laporan Penjualan</p>
    </div>
    
    <div class="info">
        <p><strong>Periode:</strong> ' . ($filter_bulan ? date('F Y', mktime(0, 0, 0, $filter_bulan, 1, $filter_tahun)) : 'Semua Bulan') . '</p>
        <p><strong>Platform:</strong> ' . (!empty($filter_platform) ? strtoupper($filter_platform) : 'Semua Platform') . '</p>
        <p><strong>Dibuat pada:</strong> ' . date('d-m-Y H:i:s') . '</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Pesanan</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>Platform</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
while ($row = mysqli_fetch_assoc($reports)) {
    $html .= '<tr>
        <td>' . $no++ . '</td>
        <td>' . $row['nomor_pesanan'] . '</td>
        <td>' . tanggal_indo($row['tanggal']) . '</td>
        <td>' . $row['nama_pembeli'] . '</td>
        <td>' . ucfirst($row['platform']) . '</td>
        <td>' . strtoupper($row['status']) . '</td>
        <td>Rp ' . number_format($row['total'], 0, ',', '.') . '</td>
    </tr>';
}

$html .= '
        </tbody>
    </table>
    
    <div class="summary">
        <p><strong>Total Pesanan:</strong> ' . $summary['total_pesanan'] . '</p>
        <p><strong>Total Penjualan:</strong> Rp ' . number_format($summary['total_penjualan'], 0, ',', '.') . '</p>
    </div>
    
    <div class="footer">
        <p>&copy; Copyright by Nazwa Khoerunnisa (23552011093) - TIF RP 23 CNS C | AD COLLECTION Fashion Management System</p>
        <p>Universitas Teknologi Bandung - Departemen Bisnis Digital</p>
    </div>
</body>
</html>';
// Gunakan library DOMPDF atau alternatif lainnya
$filename = 'Laporan_Penjualan_' . date('Y-m-d_His') . '.pdf';

// Buat versi lengkap HTML dengan styling untuk print
$html_print = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan Penjualan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        @page {
            size: A4;
            margin: 1.27cm;
        }
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 10pt;
                line-height: 1.3;
                color: #333;
            }
            .no-print { display: none !important; }
            .header {
                page-break-after: avoid;
            }
            table {
                page-break-inside: avoid;
            }
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #333;
            padding: 20px;
        }
        .print-button {
            text-align: right;
            margin-bottom: 20px;
            no-print: true;
        }
        .print-button button {
            padding: 10px 20px;
            background-color: #8B7355;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #8B7355;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #8B7355;
            font-size: 18pt;
            margin: 0;
        }
        .header p {
            color: #666;
            font-size: 10pt;
            margin: 3px 0;
        }
        .info {
            margin-bottom: 15px;
            padding: 8px;
            background-color: #f5f5f5;
            border-left: 4px solid #8B7355;
            font-size: 10pt;
        }
        .info p {
            margin: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 9pt;
        }
        table thead {
            background-color: #8B7355;
            color: white;
        }
        table th {
            border: 1px solid #666;
            padding: 5px;
            text-align: left;
            font-weight: bold;
        }
        table td {
            border: 1px solid #ddd;
            padding: 4px;
        }
        table tbody tr:nth-child(odd) {
            background-color: #fff;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            margin-top: 15px;
            padding: 12px;
            background-color: #f0f0f0;
            border-left: 4px solid #8B7355;
            font-size: 10pt;
        }
        .summary p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9pt;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="print-button no-print">
        <button onclick="window.print()">Cetak / Simpan sebagai PDF</button>
    </div>
    
    ' . $html . '
</body>
</html>';

// Opsi 1: Coba gunakan library DOMPDF jika tersedia
$pdf_generated = false;

if (file_exists('../vendor/autoload.php')) {
    try {
        require_once '../vendor/autoload.php';
        
        if (class_exists('Dompdf\Dompdf')) {
            $dompdf = new Dompdf\Dompdf();
            $dompdf->loadHtml($html_print);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream($filename);
            exit;
        }
    } catch (Exception $e) {
        error_log("PDF Error: " . $e->getMessage());
    }
}

// Opsi 2: Output sebagai HTML yang printable (user save as PDF dari browser)
// Ini adalah solusi fallback yang selalu bekerja
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

echo $html_print;
