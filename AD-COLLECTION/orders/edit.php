<?php
// orders/edit.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$order_id = intval($_GET['id'] ?? 0);

if (empty($order_id)) {
    header("Location: index.php");
    exit();
}

// Ambil data pesanan
$order_query = "SELECT * FROM orders WHERE id = $order_id";
$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    $_SESSION['error'] = 'Pesanan tidak ditemukan!';
    header("Location: index.php");
    exit();
}

// Ambil items pesanan
$items_query = "SELECT oi.*, p.sku, p.nama_produk FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = $order_id";
$items = mysqli_query($conn, $items_query);

// Ambil data produk untuk dropdown
$products_query = "SELECT id, sku, nama_produk, harga_jual FROM products WHERE stok > 0 ORDER BY nama_produk";
$products = mysqli_query($conn, $products_query);

$page_title = "Edit Pesanan - AD COLLECTION";

include '../includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="col-12 col-md-10 main-content">
            <div class="page-header">
                <h2><i class="bi bi-pencil"></i> Edit Pesanan <?= $order['nomor_pesanan']; ?></h2>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="id" value="<?= $order['id']; ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3"><i class="bi bi-person"></i> Data Pembeli</h5>
                                
                                <div class="mb-3">
                                    <label for="nama_pembeli" class="form-label">Nama Pembeli *</label>
                                    <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" value="<?= $order['nama_pembeli']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon *</label>
                                    <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= $order['nomor_telepon']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman *</label>
                                    <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required><?= $order['alamat_pengiriman']; ?></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email_pembeli" class="form-label">Email Pembeli</label>
                                    <input type="email" class="form-control" id="email_pembeli" name="email_pembeli" value="<?= $order['email_pembeli'] ?? ''; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3"><i class="bi bi-box-seam"></i> Detail Pesanan</h5>
                                
                                <div class="mb-3">
                                    <label for="platform" class="form-label">Platform *</label>
                                    <select class="form-select" id="platform" name="platform" required>
                                        <option value="tiktok" <?= $order['platform'] == 'tiktok' ? 'selected' : ''; ?>>TikTok Shop</option>
                                        <option value="shopee" <?= $order['platform'] == 'shopee' ? 'selected' : ''; ?>>Shopee</option>
                                        <option value="manual" <?= $order['platform'] == 'manual' ? 'selected' : ''; ?>>Manual</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Pesanan *</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="proses" <?= $order['status'] == 'proses' ? 'selected' : ''; ?>>Diproses</option>
                                        <option value="dikirim" <?= $order['status'] == 'dikirim' ? 'selected' : ''; ?>>Dikirim</option>
                                        <option value="selesai" <?= $order['status'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pesanan *</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $order['tanggal']; ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"><?= $order['catatan']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="mb-3"><i class="bi bi-list"></i> Item Pesanan</h5>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered mb-3">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($item = mysqli_fetch_assoc($items)): ?>
                                        <tr>
                                            <td><?= $item['sku']; ?> - <?= $item['nama_produk']; ?></td>
                                            <td><?= rupiah($item['harga_satuan']); ?></td>
                                            <td><?= $item['jumlah']; ?></td>
                                            <td><?= rupiah($item['subtotal']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 ms-auto">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <strong>Total Pesanan:</strong>
                                            <strong><?= rupiah($order['total']); ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Update Pesanan
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
