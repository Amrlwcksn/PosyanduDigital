<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

// Get dropdown data
$kegiatan = $conn->query("SELECT * FROM kegiatan_posyandu ORDER BY tanggal_kegiatan DESC");
$sasaran = $conn->query("SELECT * FROM sasaran ORDER BY nama ASC");
$kader = $conn->query("SELECT * FROM kader WHERE aktif=1 ORDER BY nama ASC");
?>

<h2>Tambah Pelayanan</h2>

<form action="../../actions/pelayanan/store.php" method="POST">
    <div class="form-group">
        <label>Kegiatan (Tanggal/Lokasi)</label>
        <select name="kegiatan_id" required>
            <option value="">-- Pilih Kegiatan --</option>
            <?php while($r = $kegiatan->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>">
                    <?php echo $r['tanggal_kegiatan'] . ' - ' . $r['lokasi']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Sasaran (Pasien)</label>
        <select name="sasaran_id" required>
            <option value="">-- Pilih Sasaran --</option>
            <?php while($r = $sasaran->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>">
                    <?php echo $r['nama'] . ' (NIK: ' . $r['nik'] . ')'; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Kader Pelayan</label>
        <select name="kader_id" required>
            <option value="">-- Pilih Kader --</option>
            <?php while($r = $kader->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>">
                    <?php echo $r['nama']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div style="display:flex; gap:10px;">
        <div class="form-group" style="flex:1">
            <label>Berat Badan (KG)</label>
            <input type="number" step="0.01" name="berat_badan" required>
        </div>
        <div class="form-group" style="flex:1">
            <label>Tinggi Badan (CM)</label>
            <input type="number" step="0.01" name="tinggi_badan" required>
        </div>
        <div class="form-group" style="flex:1">
            <label>Lingkar Lengan (CM)</label>
            <input type="number" step="0.01" name="lingkar_lengan">
        </div>
    </div>
    <div class="form-group">
        <label>Status Gizi</label>
        <select name="status_gizi" required>
            <option value="1">Baik</option>
            <option value="2">Kurang</option>
            <option value="3">Buruk</option>
        </select>
    </div>
    <div class="form-group">
        <label>Imunisasi (Jika ada)</label>
        <input type="text" name="imunisasi">
    </div>
    <div class="form-group">
        <label>Vitamin (Jika ada)</label>
        <input type="text" name="vitamin">
    </div>
    <div class="form-group">
        <label>Catatan</label>
        <textarea name="catatan"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
