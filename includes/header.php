<?php
session_start();
$base_url = "http://localhost/posyandudigital"; 

// Active Menu Helper
function isActive($path) {
    global $base_url;
    $current = $_SERVER['REQUEST_URI'];
    if (strpos($current, $path) !== false) return 'active';
    return '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posyandu Digital</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for Pro Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/style.css">
</head>
<body>

<?php if(isset($_SESSION['user_id'])): ?>
    <!-- Dashboard Layout -->
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div style="display:flex; align-items:center; gap:10px; justify-content:center;">
                    <img src="<?php echo $base_url; ?>/assets/puskesmas_logo.png" alt="Logo" style="width: 40px; height: auto;">
                    <h2 style="margin:0; font-size:1.2rem;">Posyandu</h2>
                </div>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <div class="section-label">General</div>
                    <li>
                        <a href="<?php echo $base_url; ?>/index.php" class="<?php echo isActive('index.php'); ?>">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    
                    <div class="section-label">Master Data</div>
                    <li>
                        <a href="<?php echo $base_url; ?>/views/users/index.php" class="<?php echo isActive('users'); ?>">
                            <i class="fas fa-users-cog"></i> Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url; ?>/views/kader/index.php" class="<?php echo isActive('kader'); ?>">
                            <i class="fas fa-user-nurse"></i> Kader
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url; ?>/views/sasaran/index.php" class="<?php echo isActive('sasaran'); ?>">
                            <i class="fas fa-baby"></i> Sasaran
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url; ?>/views/logistik/index.php" class="<?php echo isActive('logistik/'); ?>">
                            <i class="fas fa-boxes"></i> Logistik
                        </a>
                    </li>

                    <div class="section-label">Layanan</div>
                    <li>
                        <a href="<?php echo $base_url; ?>/views/kegiatan/index.php" class="<?php echo isActive('kegiatan'); ?>">
                            <i class="fas fa-calendar-alt"></i> Kegiatan
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url; ?>/views/pelayanan/index.php" class="<?php echo isActive('pelayanan'); ?>">
                            <i class="fas fa-stethoscope"></i> Pelayanan
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $base_url; ?>/views/logistik_transaksi/index.php" class="<?php echo isActive('logistik_transaksi'); ?>">
                            <i class="fas fa-exchange-alt"></i> Transaksi
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <a href="<?php echo $base_url; ?>/logout.php" style="color: #e74c3c; text-decoration: none; display: block; padding: 10px; background: rgba(231, 76, 60, 0.1); border-radius: 5px;">
                    🚪 Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <h3>Sistem Informasi Posyandu</h3>
                <div class="user-info">
                    Halo, <b><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></b>
                </div>
            </header>
            <div class="content-wrapper">
<?php else: ?>
    <!-- Login Layout (Empty wrapper for consistency if needed, but login.php usually handles its own body) -->
    <!-- We leave this empty because login.php has its own structure. 
         But if included in pages that need auth but fail, this might print nothing. -->
    <div class="login-container-placeholder">
<?php endif; ?>
