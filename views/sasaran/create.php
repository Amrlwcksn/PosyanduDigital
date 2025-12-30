<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
?>

<h2>Tambah Sasaran</h2>

<form action="../../actions/sasaran/store.php" method="POST">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
    </div>
    <div class="form-group">
        <label>NIK</label>
        <input type="text" name="nik" required maxlength="20">
    </div>
    <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" required>
    </div>
    <div class="form-group">
        <label>Jalan / Dusun</label>
        <input type="text" name="jalan" class="form-control" placeholder="Jalan / Dusun">
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>RT</label>
                <input type="text" name="rt" class="form-control" placeholder="RT">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>RW</label>
                <input type="text" name="rw" class="form-control" placeholder="RW">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Desa</label>
        <input type="text" name="desa" class="form-control" placeholder="Desa" required>
    </div>
    <div class="form-group">
        <label>Kecamatan</label>
        <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan" required>
    </div>
    <div class="form-group">
        <label>Kabupaten</label>
        <input type="text" name="kabupaten" class="form-control" placeholder="Kabupaten" required>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="1">Laki-laki</option>
            <option value="2">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label>Kategori Sasaran</label>
        <select name="jenis_sasaran" required>
            <option value="1">Balita</option>
            <option value="2">Ibu Hamil</option>
            <option value="3">Ibu Menyusui</option>
        </select>
    </div>
    <div class="form-group">
        <label>Nama Wali</label>
        <input type="text" name="nama_wali">
    </div>
    <div class="form-group">
        <label>No HP Wali</label>
        <input type="text" name="no_hp_wali">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
