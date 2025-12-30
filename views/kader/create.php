<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
?>

<h2>Tambah Kader</h2>

<form action="../../actions/kader/store.php" method="POST">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
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
        <label>Provinsi</label>
        <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" required>
    </div>
    <div class="form-group">
        <label>Kode Pos</label>
        <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" required>    
    </div>
    <div class="form-group">
        <label>No HP</label>
        <input type="text" name="no_hp">
    </div>
    <div class="form-group">
        <label>Jabatan</label>
        <select name="jabatan" required>
            <option value="3">Anggota</option>
            <option value="2">Sekretaris</option>
            <option value="1">Ketua</option>
        </select>
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="aktif">
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
