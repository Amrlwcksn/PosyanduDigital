<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

$id = $_GET['id'];
$sql = "SELECT * FROM pelayanan WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit;
}
$row = $result->fetch_assoc();

// Get dropdown data
$kegiatan = $conn->query("SELECT * FROM kegiatan_posyandu ORDER BY tanggal_kegiatan DESC");
$sasaran = $conn->query("SELECT * FROM sasaran ORDER BY nama ASC");
$kader = $conn->query("SELECT * FROM kader WHERE aktif=1 ORDER BY nama ASC");
?>

<h2>Edit Pelayanan</h2>

<form action="../../actions/pelayanan/update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label>Kegiatan (Tanggal/Lokasi)</label>
        <select name="kegiatan_id" required>
            <?php while($r = $kegiatan->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>" <?php if($r['id'] == $row['kegiatan_id']) echo 'selected'; ?>>
                    <?php echo $r['tanggal_kegiatan'] . ' - ' . $r['lokasi']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Sasaran (Pasien)</label>
        <select name="sasaran_id" required>
            <?php while($r = $sasaran->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>" <?php if($r['id'] == $row['sasaran_id']) echo 'selected'; ?>>
                    <?php echo $r['nama'] . ' (NIK: ' . $r['nik'] . ')'; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Kader Pelayan</label>
        <select name="kader_id" required>
            <?php while($r = $kader->fetch_assoc()): ?>
                <option value="<?php echo $r['id']; ?>" <?php if($r['id'] == $row['kader_id']) echo 'selected'; ?>>
                    <?php echo $r['nama']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div style="display:flex; gap:10px;">
        <div class="form-group" style="flex:1">
            <label>Berat Badan (KG)</label>
            <input type="number" step="0.01" name="berat_badan" value="<?php echo $row['berat_badan']; ?>" required>
        </div>
        <div class="form-group" style="flex:1">
            <label>Tinggi Badan (CM)</label>
            <input type="number" step="0.01" name="tinggi_badan" value="<?php echo $row['tinggi_badan']; ?>" required>
        </div>
        <div class="form-group" style="flex:1">
            <label>Lingkar Lengan (CM)</label>
            <input type="number" step="0.01" name="lingkar_lengan" value="<?php echo $row['lingkar_lengan']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label>Status Gizi</label>
        <select name="status_gizi" required>
            <option value="1" <?php if($row['status_gizi']==1) echo 'selected'; ?>>Baik</option>
            <option value="2" <?php if($row['status_gizi']==2) echo 'selected'; ?>>Kurang</option>
            <option value="3" <?php if($row['status_gizi']==3) echo 'selected'; ?>>Buruk</option>
        </select>
    </div>
    <div class="form-group">
        <label>Imunisasi</label>
        <input type="text" name="imunisasi" value="<?php echo htmlspecialchars($row['imunisasi']); ?>">
    </div>
    <div class="form-group">
        <label>Vitamin</label>
        <input type="text" name="vitamin" value="<?php echo htmlspecialchars($row['vitamin']); ?>">
    </div>
    <div class="form-group">
        <label>Catatan</label>
        <textarea name="catatan"><?php echo htmlspecialchars($row['catatan']); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
