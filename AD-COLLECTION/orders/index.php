<?php
// orders/index.php
session_start();

// Check jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$page_title = "Data Pesanan - AD COLLECTION";

// Ambil data pesanan
$query = "SELECT * FROM orders ORDER BY created_at DESC";
$orders = mysqli_query($conn, $query);

include '../includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="col-12 col-md-10 main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="bi bi-cart3"></i> Data Pesanan</h2>
                        <p class="mb-0">Kelola semua pesanan dari TikTok Shop & Shopee</p>
                    </div>
                    <a href="create.php" class="btn btn-warning btn-lg">
                        <i class="bi bi-plus-circle"></i> Tambah Pesanan
                    </a>
                </div>
            </div>

            <!-- Alert -->
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-x-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Card Table -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="12%">No. Pesanan</th>
                                    <th width="10%">Tanggal</th>
                                    <th width="18%">Pembeli</th>
                                    <th width="10%">Platform</th>
                                    <th width="12%">Total</th>
                                    <th width="12%">Status</th>
                                    <th width="13%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($orders) > 0): ?>
                                    <?php $no = 1; ?>
                                    <?php while($order = mysqli_fetch_assoc($orders)): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <strong style="color: var(--primary-brown);"><?= $order['nomor_pesanan'] ?></strong>
                                            </td>
                                            <td><?= tanggal_indo($order['tanggal']) ?></td>
                                            <td>
                                                <strong><?= $order['nama_pembeli'] ?></strong>
                                                <br>
                                                <small class="text-muted"><?= $order['nomor_telepon'] ?></small>
                                            </td>
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
                                            <td>
                                                <strong style="color: #28a745;"><?= rupiah($order['total']) ?></strong>
                                            </td>
                                            <td>
                                                <?php
                                                $badge_class = [
                                                    'pending' => 'bg-warning text-dark',
                                                    'proses' => 'bg-info',
                                                    'dikirim' => 'bg-primary',
                                                    'selesai' => 'bg-success',
                                                    'batal' => 'bg-danger'
                                                ];
                                                ?>
                                                <span class="badge <?= $badge_class[$order['status']] ?? 'bg-secondary' ?>">
                                                    <?= ucfirst($order['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="edit.php?id=<?= $order['id'] ?>" 
                                                       class="btn btn-sm btn-primary"
                                                       title="Edit">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <a href="delete.php?id=<?= $order['id'] ?>" 
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('Yakin ingin menghapus pesanan <?= $order['nomor_pesanan'] ?>?')"
                                                       title="Hapus">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="bi bi-inbox" style="font-size: 50px; color: var(--secondary-gold); opacity: 0.3;"></i>
                                            <p class="text-muted mt-3 mb-0">Belum ada pesanan. <a href="create.php" style="color: var(--primary-brown);">Tambah pesanan pertama</a></p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>