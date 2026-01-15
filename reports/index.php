<?php
// reports/index.php - Halaman laporan dan export
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$page_title = "Laporan - AD COLLECTION";

// Filter data
$filter_platform = $_GET['platform'] ?? '';
$filter_bulan = $_GET['bulan'] ?? date('m');
$filter_tahun = $_GET['tahun'] ?? date('Y');

// Query laporan penjualan
$query = "SELECT * FROM orders WHERE MONTH(tanggal) = '$filter_bulan' AND YEAR(tanggal) = '$filter_tahun'";

if (!empty($filter_platform)) {
    $query .= " AND platform = '$filter_platform'";
}

$query .= " ORDER BY tanggal DESC";
$reports = mysqli_query($conn, $query);

// Total penjualan
$total_query = "SELECT COUNT(*) as total_pesanan, SUM(total) as total_penjualan FROM orders 
                WHERE MONTH(tanggal) = '$filter_bulan' AND YEAR(tanggal) = '$filter_tahun'";
if (!empty($filter_platform)) {
    $total_query .= " AND platform = '$filter_platform'";
}

$total_result = mysqli_query($conn, $total_query);
$summary = mysqli_fetch_assoc($total_result);

include '../includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="col-md-10 main-content">
            <div class="page-header">
                <h2><i class="bi bi-file-earmark-bar-graph"></i> Laporan Penjualan</h2>
            </div>
            
            <!-- Filter -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>" 
                                            <?= $filter_bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : ''; ?>>
                                        <?= strftime('%B', mktime(0, 0, 0, $i, 1)); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun">
                                <?php for ($y = date('Y') - 5; $y <= date('Y'); $y++): ?>
                                    <option value="<?= $y; ?>" <?= $filter_tahun == $y ? 'selected' : ''; ?>>
                                        <?= $y; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="platform" class="form-label">Platform</label>
                            <select class="form-select" id="platform" name="platform">
                                <option value="">Semua Platform</option>
                                <option value="tiktok" <?= $filter_platform == 'tiktok' ? 'selected' : ''; ?>>TikTok Shop</option>
                                <option value="shopee" <?= $filter_platform == 'shopee' ? 'selected' : ''; ?>>Shopee</option>
                                <option value="manual" <?= $filter_platform == 'manual' ? 'selected' : ''; ?>>Manual</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Filter
                            </button>
                            <a href="export_pdf.php?<?= http_build_query($_GET); ?>" target="_blank" class="btn btn-danger">
                                <i class="bi bi-file-pdf"></i> Export PDF
                            </a>
                            <a href="export_excel.php?<?= http_build_query($_GET); ?>" class="btn btn-success">
                                <i class="bi bi-file-earmark-spreadsheet"></i> Export Excel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Summary -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-basket"></i> Total Pesanan</h5>
                            <h3><?= $summary['total_pesanan'] ?? 0; ?> pesanan</h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-cash-coin"></i> Total Penjualan</h5>
                            <h3><?= rupiah($summary['total_penjualan'] ?? 0); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tabel Laporan -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-table"></i> Detail Penjualan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Pembeli</th>
                                    <th>Platform</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($reports)): ?>
                                    <tr>
                                        <td><strong><?= $row['kode_order']; ?></strong></td>
                                        <td><?= tanggal_indo($row['tanggal']); ?></td>
                                        <td><?= $row['nama_customer']; ?></td>
                                        <td>
                                            <?php if ($row['platform'] == 'tiktok'): ?>
                                                <span class="badge bg-dark">TikTok Shop</span>
                                            <?php elseif ($row['platform'] == 'shopee'): ?>
                                                <span class="badge bg-warning">Shopee</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Manual</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $status_colors = [
                                                'pending' => 'secondary',
                                                'proses' => 'warning',
                                                'dikirim' => 'info',
                                                'selesai' => 'success',
                                                'batal' => 'danger'
                                            ];
                                            $status_label = [
                                                'pending' => 'Pending',
                                                'proses' => 'Proses',
                                                'dikirim' => 'Dikirim',
                                                'selesai' => 'Selesai',
                                                'batal' => 'Batal'
                                            ];
                                            ?>
                                            <span class="badge bg-<?= $status_colors[$row['status']] ?? 'secondary'; ?>">
                                                <?= $status_label[$row['status']] ?? $row['status']; ?>
                                            </span>
                                        </td>
                                        <td><?= rupiah($row['total']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        
                        <?php if (mysqli_num_rows($reports) == 0): ?>
                            <div class="alert alert-warning text-center">
                                <i class="bi bi-info-circle"></i> Tidak ada data pesanan untuk periode ini
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
