<?php
// orders/create.php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../config/database.php';

$page_title = "Tambah Pesanan - AD COLLECTION";

// Ambil data produk untuk dropdown
$products_query = "SELECT id, sku, nama_produk, harga_jual FROM products WHERE stok > 0 ORDER BY nama_produk";
$products = mysqli_query($conn, $products_query);

include '../includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        
        <main class="col-12 col-md-10 main-content">
            <div class="page-header">
                <h2><i class="bi bi-plus-circle"></i> Tambah Pesanan Baru</h2>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <form action="store.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3"><i class="bi bi-person"></i> Data Pembeli</h5>
                                
                                <div class="mb-3">
                                    <label for="nama_pembeli" class="form-label">Nama Pembeli *</label>
                                    <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon *</label>
                                    <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman *</label>
                                    <textarea class="form-control" id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="mb-3"><i class="bi bi-box-seam"></i> Detail Pesanan</h5>
                                
                                <div class="mb-3">
                                    <label for="platform" class="form-label">Platform *</label>
                                    <select class="form-select" id="platform" name="platform" required>
                                        <option value="">-- Pilih Platform --</option>
                                        <option value="tiktok">TikTok Shop</option>
                                        <option value="shopee">Shopee</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Pesanan *</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending">Pending</option>
                                        <option value="proses">Proses</option>
                                        <option value="dikirim">Dikirim</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="batal">Batal</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pesanan *</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h5 class="mb-3"><i class="bi bi-list"></i> Item Pesanan</h5>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered mb-3" id="itemsTable">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="item-row">
                                        <td>
                                            <select class="form-select product-select" name="product_id[]" required>
                                                <option value="">-- Pilih Produk --</option>
                                                <?php mysqli_data_seek($products, 0); ?>
                                                <?php while ($prod = mysqli_fetch_assoc($products)): ?>
                                                    <option value="<?= $prod['id']; ?>" data-price="<?= $prod['harga_jual']; ?>">
                                                        <?= $prod['sku']; ?> - <?= $prod['nama_produk']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control price" readonly></td>
                                        <td><input type="number" class="form-control jumlah" name="jumlah[]" min="1" value="1" required></td>
                                        <td><input type="text" class="form-control subtotal" readonly></td>
                                        <td><button type="button" class="btn btn-sm btn-danger remove-item">Hapus</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <button type="button" class="btn btn-secondary btn-sm mb-3" id="addItem">
                            <i class="bi bi-plus"></i> Tambah Item
                        </button>
                        
                        <div class="row">
                            <div class="col-md-6 ms-auto">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <strong>Subtotal:</strong>
                                            <span id="totalSubtotal">Rp 0</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <strong>Total:</strong>
                                            <input type="hidden" id="total" name="total" value="0">
                                            <strong id="totalDisplay">Rp 0</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Simpan Pesanan
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

<script>
// Fungsi format rupiah
function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Update harga saat produk dipilih
document.querySelectorAll('.product-select').forEach(select => {
    select.addEventListener('change', function() {
        const price = this.options[this.selectedIndex].dataset.price || 0;
        const priceInput = this.closest('tr').querySelector('.price');
        priceInput.value = formatRupiah(price);
        updateSubtotal(this.closest('tr'));
        calculateTotal();
    });
});

// Update subtotal saat jumlah berubah
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('jumlah')) {
        updateSubtotal(e.target.closest('tr'));
        calculateTotal();
    }
});

function updateSubtotal(row) {
    const priceText = row.querySelector('.price').value.replace(/\D/g, '');
    const jumlah = row.querySelector('.jumlah').value || 1;
    const subtotal = parseInt(priceText) * parseInt(jumlah);
    row.querySelector('.subtotal').value = formatRupiah(subtotal);
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(input => {
        const value = input.value.replace(/\D/g, '');
        total += parseInt(value) || 0;
    });
    document.getElementById('total').value = total;
    document.getElementById('totalSubtotal').textContent = formatRupiah(total);
    document.getElementById('totalDisplay').textContent = formatRupiah(total);
}

// Tambah item
document.getElementById('addItem').addEventListener('click', function() {
    const tbody = document.querySelector('#itemsTable tbody');
    const firstRow = tbody.querySelector('.item-row');
    const newRow = firstRow.cloneNode(true);
    
    // Reset values
    newRow.querySelector('.product-select').value = '';
    newRow.querySelector('.price').value = '';
    newRow.querySelector('.jumlah').value = '1';
    newRow.querySelector('.subtotal').value = '';
    
    // Re-attach event listeners
    newRow.querySelector('.product-select').addEventListener('change', function() {
        const price = this.options[this.selectedIndex].dataset.price || 0;
        const priceInput = this.closest('tr').querySelector('.price');
        priceInput.value = formatRupiah(price);
        updateSubtotal(this.closest('tr'));
        calculateTotal();
    });
    
    newRow.querySelector('.remove-item').addEventListener('click', function() {
        newRow.remove();
        calculateTotal();
    });
    
    tbody.appendChild(newRow);
});

// Hapus item
document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('tr').remove();
        calculateTotal();
    });
});

// Hitung total saat halaman load
calculateTotal();
</script>

<?php include '../includes/footer.php'; ?>
