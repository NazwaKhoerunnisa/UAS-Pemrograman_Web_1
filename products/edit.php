<?php
// products/edit.php
session_start();

// Check jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$page_title = "Edit Produk - AD COLLECTION";

// Ambil ID dari URL
$id = intval($_GET['id'] ?? 0);

if (empty($id)) {
    header("Location: index.php");
    exit();
}

// Ambil data produk
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error'] = "Produk tidak ditemukan!";
    header("Location: index.php");
    exit();
}

$product = mysqli_fetch_assoc($result);

include '../includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="color: var(--primary-brown);">
                    <i class="bi bi-pencil"></i> Edit Produk
                </h2>
                <a href="index.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-box-seam"></i> Form Edit Produk</h5>
                </div>
                <div class="card-body p-4">
                    <form action="update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="foto_lama" value="<?= $product['foto'] ?>">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Produk <span class="text-danger">*</span></label>
                                <input type="text" name="kode" class="form-control" 
                                       value="<?= $product['kode'] ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" name="nama_produk" class="form-control" 
                                       value="<?= $product['nama_produk'] ?>" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-select" required>
                                    <option value="Blouse" <?= $product['kategori'] == 'Blouse' ? 'selected' : '' ?>>Blouse</option>
                                    <option value="Dress" <?= $product['kategori'] == 'Dress' ? 'selected' : '' ?>>Dress</option>
                                    <option value="Outer" <?= $product['kategori'] == 'Outer' ? 'selected' : '' ?>>Outer</option>
                                    <option value="Pants" <?= $product['kategori'] == 'Pants' ? 'selected' : '' ?>>Pants</option>
                                    <option value="Skirt" <?= $product['kategori'] == 'Skirt' ? 'selected' : '' ?>>Skirt</option>
                                    <option value="Hijab" <?= $product['kategori'] == 'Hijab' ? 'selected' : '' ?>>Hijab</option>
                                    <option value="Aksesoris" <?= $product['kategori'] == 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Harga <span class="text-danger">*</span></label>
                                <input type="number" name="harga" class="form-control" 
                                       value="<?= $product['harga'] ?>" required min="0" step="1000">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok" class="form-control" 
                                       value="<?= $product['stok'] ?>" required min="0">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"><?= $product['deskripsi'] ?></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Foto Produk</label>
                                
                                <?php if($product['foto']): ?>
                                    <div class="mb-3">
                                        <p class="mb-2" style="color: var(--primary-brown); font-weight: 600;">Foto Saat Ini:</p>
                                        <img src="../assets/img/uploads/<?= $product['foto'] ?>" 
                                             class="rounded" 
                                             style="max-width: 250px; border: 3px solid var(--secondary-gold);">
                                    </div>
                                <?php endif; ?>
                                
                                <input type="file" name="foto" class="form-control" 
                                       accept="image/jpeg,image/jpg,image/png,image/gif">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto. Format: JPG, PNG, GIF (Max 2MB)</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Produk
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