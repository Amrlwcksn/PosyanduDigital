<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

    $id = $_GET['id'];
    $sql = "SELECT s.*, a.jalan, a.rt, a.rw, a.desa, a.kecamatan, a.kabupaten 
            FROM sasaran s 
            LEFT JOIN alamat_sasaran a ON s.alamat_sasaran_id = a.id 
            WHERE s.id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header("Location: index.php");
        exit;
    }
    $row = $result->fetch_assoc();
?>

<h2>Edit Sasaran</h2>

<form action="../../actions/sasaran/update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="alamat_id" value="<?php echo $row['alamat_sasaran_id']; ?>">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
    </div>
    <div class="form-group">
        <label>NIK</label>
        <input type="text" name="nik" value="<?php echo htmlspecialchars($row['nik']); ?>" required maxlength="20">
    </div>
    <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']; ?>" required>
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
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="1" <?php if($row['jenis_kelamin']==1) echo 'selected'; ?>>Laki-laki</option>
            <option value="2" <?php if($row['jenis_kelamin']==2) echo 'selected'; ?>>Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label>Kategori Sasaran</label>
        <select name="jenis_sasaran" required>
            <option value="1" <?php if($row['jenis_sasaran']==1) echo 'selected'; ?>>Balita</option>
            <option value="2" <?php if($row['jenis_sasaran']==2) echo 'selected'; ?>>Ibu Hamil</option>
            <option value="3" <?php if($row['jenis_sasaran']==3) echo 'selected'; ?>>Ibu Menyusui</option>
        </select>
    </div>
    <div class="form-group">
        <label>Nama Wali</label>
        <input type="text" name="nama_wali" value="<?php echo htmlspecialchars($row['nama_wali']); ?>">
    </div>
    <div class="form-group">
        <label>No HP Wali</label>
        <input type="text" name="no_hp_wali" value="<?php echo htmlspecialchars($row['no_hp_wali']); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
