<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
check_admin();
require_once '../../connections/conn.php';

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit;
}
$row = $result->fetch_assoc();
?>

<h2>Edit Pengguna</h2>

<form action="../../actions/users/update.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
    </div>
    <div class="form-group">
        <label>Password (Kosongkan jika tidak ingin mengubah)</label>
        <input type="password" name="password">
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="role" required>
            <option value="1" <?php if($row['role']==1) echo 'selected'; ?>>Admin</option>
            <option value="2" <?php if($row['role']==2) echo 'selected'; ?>>Operator</option>
            <option value="3" <?php if($row['role']==3) echo 'selected'; ?>>Kader</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
