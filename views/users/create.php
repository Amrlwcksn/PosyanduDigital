<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
check_admin();
?>

<h2>Tambah Pengguna</h2>

<form action="../../actions/users/store.php" method="POST">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="role" required>
            <option value="1">Admin</option>
            <option value="2">Operator</option>
            <option value="3">Kader</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-danger">Batal</a>
</form>

<?php include '../../includes/footer.php'; ?>
