<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

$logistik = $conn->query("SELECT * FROM logistik ORDER BY nama_barang ASC");
$kader = $conn->query("SELECT * FROM kader WHERE aktif=1 ORDER BY nama ASC");
?>

<h2>Tambah Transaksi Stok</h2>

<form action="../../actions/logistik_transaksi/store.php" method="POST">
    <div class="form-group">
        <label>Tanggal</label>
        <input type="date" name="tanggal" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
    <div class="form-group">
        <label>Barang</label>
        <select name="logistik_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php while($r = $logistik->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>">
                    <?php echo $r['nama_barang'] . ' (Stok: ' . $r['stok'] . ' ' . $r['satuan'] . ')'; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Kader (Penanggung Jawab)</label>
        <select name="kader_id" required>
            <option value="">-- Pilih Kader --</option>
            <?php while($r = $kader->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>"><?php echo $r['nama']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Jenis Transaksi</label>
        <select name="jenis_transaksi" required>
            <option value="1">Masuk (Stok Bertambah)</option>
            <option value="2">Keluar (Stok Berkurang)</option>
        </select>
    </div>
    <div class="form-group">
        <label>Jumlah</label>
        <input type="number" name="jumlah" min="1" required>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
