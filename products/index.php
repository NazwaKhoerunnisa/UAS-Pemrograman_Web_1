<?php
// products/index.php
session_start();

// Check jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$page_title = "Data Produk - AD COLLECTION";

// Ambil data produk
$query = "SELECT * FROM products ORDER BY id DESC";
$products = mysqli_query($conn, $query);

include '../includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="col-md-10 main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="bi bi-box-seam"></i> Data Produk</h2>
                        <p class="mb-0">Kelola semua produk fashion Anda</p>
                    </div>
                    <a href="create.php" class="btn btn-warning btn-lg">
                        <i class="bi bi-plus-circle"></i> Tambah Produk
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
                                    <th width="10%">Kode</th>
                                    <th width="20%">Nama Produk</th>
                                    <th width="12%">Kategori</th>
                                    <th width="12%">Harga</th>
                                    <th width="8%">Stok</th>
                                    <th width="10%">Foto</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($products) > 0): ?>
                                    <?php $no = 1; ?>
                                    <?php while($product = mysqli_fetch_assoc($products)): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <span class="badge" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%);">
                                                    <?= $product['kode'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <strong style="color: var(--primary-brown);"><?= $product['nama_produk'] ?></strong>
                                                <br>
                                                <small class="text-muted"><?= substr($product['deskripsi'] ?? '', 0, 50) ?></small>
                                            </td>
                                            <td>
                                                <span class="badge bg-info"><?= $product['kategori'] ?></span>
                                            </td>
                                            <td>
                                                <strong style="color: #28a745;"><?= rupiah($product['harga']) ?></strong>
                                            </td>
                                            <td>
                                                <?php if($product['stok'] < 10): ?>
                                                    <span class="badge bg-danger"><?= $product['stok'] ?> pcs</span>
                                                <?php elseif($product['stok'] < 20): ?>
                                                    <span class="badge bg-warning text-dark"><?= $product['stok'] ?> pcs</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success"><?= $product['stok'] ?> pcs</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($product['foto']): ?>
                                                    <img src="../assets/img/uploads/<?= $product['foto'] ?>" 
                                                         class="rounded" 
                                                         style="width: 60px; height: 60px; object-fit: cover; border: 2px solid var(--light-cream);">
                                                <?php else: ?>
                                                    <div class="rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px; background: var(--light-cream); border: 2px solid var(--light-cream);">
                                                        <i class="bi bi-image" style="color: var(--secondary-gold);"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="edit.php?id=<?= $product['id'] ?>" 
                                                       class="btn btn-warning"
                                                       title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="delete.php?id=<?= $product['id'] ?>" 
                                                       class="btn btn-danger"
                                                       onclick="return confirm('Yakin ingin menghapus <?= $product['nama_produk'] ?>?')"
                                                       title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="bi bi-inbox" style="font-size: 50px; color: var(--secondary-gold); opacity: 0.3;"></i>
                                            <p class="text-muted mt-3 mb-0">Belum ada produk. <a href="create.php" style="color: var(--primary-brown);">Tambah produk pertama</a></p>
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