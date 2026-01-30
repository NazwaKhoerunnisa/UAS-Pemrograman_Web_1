<?php
// dashboard.php
session_start();

// Check jika belum login, redirect ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config/database.php';

$page_title = "Dashboard - AD COLLECTION";

// Query statistik penjualan hari ini
$query_penjualan_hari_ini = "SELECT COALESCE(SUM(total), 0) as total 
                              FROM orders 
                              WHERE DATE(tanggal) = CURDATE()";
$result = mysqli_query($conn, $query_penjualan_hari_ini);
$penjualan_hari_ini = mysqli_fetch_assoc($result)['total'];

// Query pesanan pending
$query_pending = "SELECT COUNT(*) as total FROM orders WHERE status = 'pending'";
$result = mysqli_query($conn, $query_pending);
$pesanan_pending = mysqli_fetch_assoc($result)['total'];

// Query total produk
$query_produk = "SELECT COUNT(*) as total FROM products";
$result = mysqli_query($conn, $query_produk);
$total_produk = mysqli_fetch_assoc($result)['total'];

// Query stok menipis
$query_stok_menipis = "SELECT COUNT(*) as total FROM products WHERE stok < 10";
$result = mysqli_query($conn, $query_stok_menipis);
$stok_menipis = mysqli_fetch_assoc($result)['total'];

// Penjualan per platform
$query_tiktok = "SELECT COALESCE(SUM(total), 0) as total FROM orders WHERE platform = 'tiktok'";
$result = mysqli_query($conn, $query_tiktok);
$penjualan_tiktok = mysqli_fetch_assoc($result)['total'];

$query_shopee = "SELECT COALESCE(SUM(total), 0) as total FROM orders WHERE platform = 'shopee'";
$result = mysqli_query($conn, $query_shopee);
$penjualan_shopee = mysqli_fetch_assoc($result)['total'];

$total_penjualan = $penjualan_tiktok + $penjualan_shopee;
$persentase_tiktok = $total_penjualan > 0 ? ($penjualan_tiktok / $total_penjualan) * 100 : 0;
$persentase_shopee = $total_penjualan > 0 ? ($penjualan_shopee / $total_penjualan) * 100 : 0;

// Produk terlaris - dengan error handling
$query_terlaris = "SELECT p.id, p.nama_produk, p.foto_produk, COALESCE(SUM(oi.jumlah), 0) as total_terjual 
                   FROM products p 
                   LEFT JOIN order_items oi ON p.id = oi.product_id 
                   GROUP BY p.id 
                   ORDER BY total_terjual DESC 
                   LIMIT 5";
$produk_terlaris = mysqli_query($conn, $query_terlaris);

if (!$produk_terlaris) {
    // Jika query produk terlaris gagal, gunakan query sederhana
    $query_terlaris = "SELECT id, nama_produk, foto_produk FROM products ORDER BY id DESC LIMIT 5";
    $produk_terlaris = mysqli_query($conn, $query_terlaris);
}

// Pesanan terbaru
$query_pesanan_terbaru = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 5";
$pesanan_terbaru = mysqli_query($conn, $query_pesanan_terbaru);

include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="col-12 col-md-10 main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
                        <p class="mb-0">Selamat datang kembali, <?= $_SESSION['nama_lengkap'] ?>!</p>
                    </div>
                    <div class="text-end">
                        <i class="bi bi-calendar3"></i>
                        <span><?= tanggal_indo(date('Y-m-d')) ?></span>
                    </div>
                </div>
            </div>

            <!-- Alert -->
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Statistik Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="opacity-75" style="font-size: 13px;">Penjualan Hari Ini</small>
                                <h3 class="mb-0 mt-2" style="font-family: 'Playfair Display', serif;">
                                    <?= rupiah($penjualan_hari_ini) ?>
                                </h3>
                            </div>
                            <i class="bi bi-currency-dollar" style="font-size: 50px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="opacity-75" style="font-size: 13px;">Pesanan Pending</small>
                                <h3 class="mb-0 mt-2" style="font-family: 'Playfair Display', serif;">
                                    <?= $pesanan_pending ?>
                                </h3>
                            </div>
                            <i class="bi bi-cart3" style="font-size: 50px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="opacity-75" style="font-size: 13px;">Total Produk</small>
                                <h3 class="mb-0 mt-2" style="font-family: 'Playfair Display', serif;">
                                    <?= $total_produk ?>
                                </h3>
                            </div>
                            <i class="bi bi-box-seam" style="font-size: 50px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="opacity-75" style="font-size: 13px;">Stok Menipis</small>
                                <h3 class="mb-0 mt-2" style="font-family: 'Playfair Display', serif;">
                                    <?= $stok_menipis ?>
                                </h3>
                            </div>
                            <i class="bi bi-exclamation-triangle" style="font-size: 50px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Tables Row -->
            <div class="row g-4">
                <!-- Penjualan per Platform -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0" style="color: var(--dark-brown);"><i class="bi bi-graph-up"></i> Penjualan per Platform</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span><i class="bi bi-tiktok text-danger"></i> <strong>TikTok Shop</strong></span>
                                    <strong style="color: var(--primary-brown);"><?= number_format($persentase_tiktok, 1) ?>%</strong>
                                </div>
                                <div class="progress" style="height: 30px; border-radius: 10px;">
                                    <div class="progress-bar" 
                                         style="width: <?= $persentase_tiktok ?>%; background: linear-gradient(90deg, #fe2c55 0%, #ff6b6b 100%);">
                                        <strong><?= rupiah($penjualan_tiktok) ?></strong>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span><i class="bi bi-shop text-warning"></i> <strong>Shopee</strong></span>
                                    <strong style="color: var(--primary-brown);"><?= number_format($persentase_shopee, 1) ?>%</strong>
                                </div>
                                <div class="progress" style="height: 30px; border-radius: 10px;">
                                    <div class="progress-bar" 
                                         style="width: <?= $persentase_shopee ?>%; background: linear-gradient(90deg, #ee4d2d 0%, #ff6347 100%);">
                                        <strong><?= rupiah($penjualan_shopee) ?></strong>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 p-3" style="background: var(--light-cream); border-radius: 10px;">
                                <div class="d-flex justify-content-between">
                                    <span style="color: var(--primary-brown); font-weight: 600;">Total Penjualan:</span>
                                    <strong style="color: var(--dark-brown); font-size: 18px;">
                                        <?= rupiah($total_penjualan) ?>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk Terlaris -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0" style="color: var(--dark-brown);"><i class="bi bi-trophy"></i> Produk Terlaris</h5>
                        </div>
                        <div class="card-body">
                            <?php if($produk_terlaris && mysqli_num_rows($produk_terlaris) > 0): ?>
                                <div class="list-group list-group-flush">
                                    <?php $rank = 1; ?>
                                    <?php while($item = mysqli_fetch_assoc($produk_terlaris)): ?>
                                        <div class="list-group-item border-0 d-flex align-items-center px-0">
                                            <div class="me-3" style="width: 30px; height: 30px; background: linear-gradient(135deg, #C9A97E 0%, #F4E4C1 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--dark-brown);">
                                                <?= $rank++ ?>
                                            </div>
                                            <div class="me-3" style="width: 60px; height: 60px; border-radius: 10px; overflow: hidden; background: var(--light-cream);">
                                                <?php if(!empty($item['foto_produk']) && file_exists('assets/img/uploads/' . $item['foto_produk'])): ?>
                                                    <img src="assets/img/uploads/<?= htmlspecialchars($item['foto_produk']) ?>" 
                                                         style="width: 100%; height: 100%; object-fit: cover;" alt="<?= htmlspecialchars($item['nama_produk']) ?>">
                                                <?php else: ?>
                                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold" style="color: var(--primary-brown);">
                                                    <?= htmlspecialchars($item['nama_produk']) ?>
                                                </div>
                                                <small class="text-muted"><?php echo isset($item['total_terjual']) ? $item['total_terjual'] . ' terjual' : 'Best Seller'; ?></small>
                                            </div>
                                            <?php if(isset($item['total_terjual']) && $item['total_terjual'] > 0): ?>
                                            <span class="badge" style="background: linear-gradient(135deg, #8B7355 0%, #C9A97E 100%);">
                                                <?= $item['total_terjual'] ?> terjual
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 50px; color: var(--secondary-gold); opacity: 0.3;"></i>
                                    <p class="text-muted mt-3">Belum ada data penjualan</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Pesanan Terbaru -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0" style="color: var(--dark-brown);"><i class="bi bi-clock-history"></i> Pesanan Terbaru</h5>
                                <a href="orders/index.php" class="btn btn-sm btn-warning">
                                    Lihat Semua <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Kode Order</th>
                                            <th>Tanggal</th>
                                            <th>Customer</th>
                                            <th>Platform</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(mysqli_num_rows($pesanan_terbaru) > 0): ?>
                                            <?php while($order = mysqli_fetch_assoc($pesanan_terbaru)): ?>
                                                <tr>
                                                    <td><strong><?= $order['nomor_pesanan'] ?></strong></td>
                                                    <td><?= tanggal_indo($order['tanggal']) ?></td>
                                                    <td><?= $order['nama_pembeli'] ?></td>
                                                    <td>
                                                        <?php if($order['platform'] == 'tiktok'): ?>
                                                            <span class="badge bg-danger">
                                                                <i class="bi bi-tiktok"></i> TikTok
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge bg-warning text-dark">
                                                                <i class="bi bi-shop"></i> Shopee
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><strong style="color: #28a745;"><?= rupiah($order['total']) ?></strong></td>
                                                    <td>
                                                        <?php
                                                        $badge_class = [
                                                            'pending' => 'bg-warning text-dark',
                                                            'proses' => 'bg-info',
                                                            'dikirim' => 'bg-primary',
                                                            'selesai' => 'bg-success',
                                                            'batal' => 'bg-danger'
                                                        ];
                                                        $status_class = isset($badge_class[$order['status']]) ? $badge_class[$order['status']] : 'bg-secondary';
                                                        ?>
                                                        <span class="badge <?= $status_class ?>">
                                                            <?= ucfirst($order['status']) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    Belum ada pesanan
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?>