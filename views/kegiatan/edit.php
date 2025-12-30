<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

$id = $_GET['id'];
$sql = "SELECT * FROM kegiatan_posyandu WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit;
}
$row = $result->fetch_assoc();
?>

<h2>Edit Kegiatan</h2>

<form action="../../actions/kegiatan/update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label>Tanggal Kegiatan</label>
        <input type="date" name="tanggal_kegiatan" value="<?php echo $row['tanggal_kegiatan']; ?>" required>
    </div>
    <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="lokasi" value="<?php echo htmlspecialchars($row['lokasi']); ?>" required>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan"><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
