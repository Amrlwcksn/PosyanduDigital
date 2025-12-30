<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

$id = $_GET['id'];
$sql = "SELECT * FROM logistik WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit;
}
$row = $result->fetch_assoc();
?>

<h2>Edit Barang Logistik</h2>

<form action="../../actions/logistik/update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?php echo htmlspecialchars($row['nama_barang']); ?>" required>
    </div>
    <div class="form-group">
        <label>Jenis</label>
        <select name="jenis" required>
            <option value="1" <?php if($row['jenis']==1) echo 'selected'; ?>>Obat</option>
            <option value="2" <?php if($row['jenis']==2) echo 'selected'; ?>>Vitamin</option>
            <option value="3" <?php if($row['jenis']==3) echo 'selected'; ?>>Alat</option>
        </select>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" value="<?php echo $row['stok']; ?>" required>
    </div>
    <div class="form-group">
        <label>Satuan</label>
        <input type="text" name="satuan" value="<?php echo htmlspecialchars($row['satuan']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
