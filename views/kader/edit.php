<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

    $id = $_GET['id'];
    $sql = "SELECT k.*, a.jalan, a.rt, a.rw, a.desa, a.kecamatan, a.kabupaten, a.provinsi, a.kode_pos 
            FROM kader k 
            LEFT JOIN alamat_kader a ON k.alamat_kader_id = a.id 
            WHERE k.id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header("Location: index.php");
        exit;
    }
    $row = $result->fetch_assoc();
?>

<h2>Edit Kader</h2>

<form action="../../actions/kader/update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="alamat_id" value="<?php echo $row['alamat_kader_id']; ?>">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
    </div>
    <div class="form-group">
        <label>Jalan / Dusun</label>
        <input type="text" name="jalan" class="form-control" value="<?php echo htmlspecialchars($row['jalan']); ?>">
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>RT</label>
                <input type="text" name="rt" class="form-control" value="<?php echo htmlspecialchars($row['rt']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>RW</label>
                <input type="text" name="rw" class="form-control" value="<?php echo htmlspecialchars($row['rw']); ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Desa</label>
        <input type="text" name="desa" class="form-control" value="<?php echo htmlspecialchars($row['desa']); ?>" required>
    </div>
    <div class="form-group">
        <label>Kecamatan</label>
        <input type="text" name="kecamatan" class="form-control" value="<?php echo htmlspecialchars($row['kecamatan']); ?>" required>
    </div>
    <div class="form-group">
        <label>Kabupaten</label>
        <input type="text" name="kabupaten" class="form-control" value="<?php echo htmlspecialchars($row['kabupaten']); ?>" required>
    </div>
    <div class="form-group">
        <label>Provinsi</label>
        <input type="text" name="provinsi" class="form-control" value="<?php echo htmlspecialchars($row['provinsi']); ?>" required>
    </div>
    <div class="form-group">
        <label>Kode Pos</label>
        <input type="text" name="kode_pos" class="form-control" value="<?php echo htmlspecialchars($row['kode_pos']); ?>" required>
    </div>
    <div class="form-group">
        <label>No HP</label>
        <input type="text" name="no_hp" value="<?php echo htmlspecialchars($row['no_hp']); ?>">
    </div>
    <div class="form-group">
        <label>Jabatan</label>
        <select name="jabatan" required>
            <option value="3" <?php if($row['jabatan']==3) echo 'selected'; ?>>Anggota</option>
            <option value="2" <?php if($row['jabatan']==2) echo 'selected'; ?>>Sekretaris</option>
            <option value="1" <?php if($row['jabatan']==1) echo 'selected'; ?>>Ketua</option>
        </select>
    </div>
    <div class="form-group">
        <label>Status</label>
        <select name="aktif">
            <option value="1" <?php if($row['aktif']==1) echo 'selected'; ?>>Aktif</option>
            <option value="0" <?php if($row['aktif']==0) echo 'selected'; ?>>Tidak Aktif</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
