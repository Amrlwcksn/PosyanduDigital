<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
?>

<h2>Tambah Kegiatan</h2>

<form action="../../actions/kegiatan/store.php" method="POST">
    <div class="form-group">
        <label>Tanggal Kegiatan</label>
        <input type="date" name="tanggal_kegiatan" required>
    </div>
    <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="lokasi" required>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
