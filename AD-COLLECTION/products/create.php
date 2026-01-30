<?php
// products/create.php
session_start();

// Check jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$page_title = "Tambah Produk - AD COLLECTION";

include '../includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="col-12 col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="color: var(--primary-brown);">
                    <i class="bi bi-plus-circle"></i> Tambah Produk Baru
                </h2>
                <a href="index.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-box-seam"></i> Form Tambah Produk</h5>
                </div>
                <div class="card-body p-4">
                    <form action="store.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SKU <span class="text-danger">*</span></label>
                                <input type="text" name="sku" class="form-control" 
                                       placeholder="Contoh: KB001" required>
                                <small class="text-muted">Format: Kode unik produk</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" name="nama_produk" class="form-control" 
                                       placeholder="Contoh: Zara Blouse" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-select" required>
                                    <option value="Blouse">Blouse</option>
                                    <option value="Dress">Dress</option>
                                    <option value="Outer">Outer</option>
                                    <option value="Pants">Pants</option>
                                    <option value="Skirt">Skirt</option>
                                    <option value="Hijab">Hijab</option>
                                    <option value="Aksesoris">Aksesoris</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Harga Beli <span class="text-danger">*</span></label>
                                <input type="number" name="harga_beli" class="form-control" 
                                       placeholder="75000" required min="0" step="1000">
                                <small class="text-muted">Dalam Rupiah</small>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Harga Jual <span class="text-danger">*</span></label>
                                <input type="number" name="harga_jual" class="form-control" 
                                       placeholder="150000" required min="0" step="1000">
                                <small class="text-muted">Dalam Rupiah</small>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok" class="form-control" 
                                       placeholder="25" required min="0">
                                <small class="text-muted">Jumlah unit</small>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3" 
                                          placeholder="Deskripsi produk...">Kemeja wanita lengan panjang</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Foto Produk</label>
                                <input type="file" name="foto" class="form-control" 
                                       accept="image/jpeg,image/jpg,image/png,image/gif">
                                <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Produk
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