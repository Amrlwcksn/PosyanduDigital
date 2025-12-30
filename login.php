<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Posyandu Digital</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-left">
            <div class="login-left-content">
                <img src="assets/puskesmas_logo.png" alt="Logo" class="login-logo-top">
                <h1>Posyandu Digital</h1>
                <p>Digitalisasi layanan kesehatan ibu dan anak.</p>
                <div class="illustration-wrapper">
                    <img src="assets/login_illustration.png" alt="Health Illustration" class="login-illustration">
                </div>
            </div>
        </div>
        <div class="login-right">
            <div class="login-wrapper">
                <div class="login-card-header">
                    <h2>Masuk Sistem</h2>
                    <p>Silakan masuk ke akun Anda</p>
                </div>
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                <form action="actions/login_process.php" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-with-icon">
                            <input type="text" name="username" placeholder="Masukkan username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-with-icon">
                            <input type="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-login">Masuk ke Dashboard</button>
                    <div class="login-footer">
                        <p>&copy; 2025 Posyandu Digital Indonesia</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
