<?php
require_once 'includes/config.php';
if (!ALLOW_REGISTRATION) {
    die("Pendaftaran akun sedang dinonaktifkan oleh administrator.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Posyandu Digital</title>
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
                    <h2>Daftar Akun Baru</h2>
                    <p>Silakan lengkapi data untuk mendaftar</p>
                </div>
                
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>

                <form action="actions/register_process.php" method="POST">
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
                    <button type="submit" class="btn btn-primary btn-login">Daftar Sekarang</button>
                    <div class="register-link" style="text-align: center; margin-top: 15px;">
                        Sudah punya akun? <a href="login.php">Masuk di sini</a>
                    </div>
                    <div class="login-footer">
                        <p>&copy; 2025 Posyandu Digital Indonesia</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
