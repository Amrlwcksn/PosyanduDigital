<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
?>

<h2>Tambah Barang Logistik</h2>

<form action="../../actions/logistik/store.php" method="POST">
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" required>
    </div>
    <div class="form-group">
        <label>Jenis</label>
        <select name="jenis" required>
            <option value="1">Obat</option>
            <option value="2">Vitamin</option>
            <option value="3">Alat</option>
        </select>
    </div>
    <div class="form-group">
        <label>Stok Awal</label>
        <input type="number" name="stok" value="0" required>
    </div>
    <div class="form-group">
        <label>Satuan (misal: botol, dus, pcs)</label>
        <input type="text" name="satuan" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
