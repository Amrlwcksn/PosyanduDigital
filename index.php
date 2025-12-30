<?php
include 'includes/header.php';
include 'includes/functions.php';
require_once 'connections/conn.php'; 
check_login();

// Mengambil data terkini dari database
$users_count = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$kader_count = $conn->query("SELECT COUNT(*) as total FROM kader WHERE aktif=1")->fetch_assoc()['total'];
$sasaran_count = $conn->query("SELECT COUNT(*) as total FROM sasaran")->fetch_assoc()['total'];
$kegiatan_count = $conn->query("SELECT COUNT(*) as total FROM kegiatan_posyandu")->fetch_assoc()['total'];
$logistik_count = $conn->query("SELECT COUNT(*) as total FROM logistik")->fetch_assoc()['total'];
?>

<div style="margin-bottom: 30px;">
    <h2>Dashboard Overview</h2>
    <p style="color: grey;">Selamat datang kembali, <strong><?php echo $_SESSION['username']; ?></strong> 👋</p>
</div>

<!-- Grid Layout for Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">

    <!-- Card Users -->
    <a href="views/users/index.php" class="card stat-card">
        <div class="stat-info">
            <h4>Total Pengguna</h4>
            <h2><?php echo $users_count; ?></h2>
        </div>
        <div class="stat-icon bg-blue-light">
            <i class="fas fa-users"></i>
        </div>
    </a>

    <!-- Card Kader -->
    <a href="views/kader/index.php" class="card stat-card">
        <div class="stat-info">
            <h4>Kader Aktif</h4>
            <h2><?php echo $kader_count; ?></h2>
        </div>
        <div class="stat-icon bg-green-light">
            <i class="fas fa-user-nurse"></i>
        </div>
    </a>

    <!-- Card Sasaran -->
    <a href="views/sasaran/index.php" class="card stat-card">
        <div class="stat-info">
            <h4>Total Sasaran</h4>
            <h2><?php echo $sasaran_count; ?></h2>
        </div>
        <div class="stat-icon bg-orange-light">
            <i class="fas fa-baby"></i>
        </div>
    </a>

     <!-- Card Kegiatan -->
     <a href="views/kegiatan/index.php" class="card stat-card">
        <div class="stat-info">
            <h4>Kegiatan</h4>
            <h2><?php echo $kegiatan_count; ?></h2>
        </div>
        <div class="stat-icon bg-red-light">
            <i class="fas fa-calendar-check"></i>
        </div>
    </a>

    <!-- Card Logistik -->
    <a href="views/logistik/index.php" class="card stat-card">
        <div class="stat-info">
            <h4>Item Logistik</h4>
            <h2><?php echo $logistik_count; ?></h2>
        </div>
        <div class="stat-icon bg-blue-light">
            <i class="fas fa-boxes"></i>
        </div>
    </a>

</div>

<div style="margin-top: 40px;">
    <div class="card">
        <h3 style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
            <i class="fas fa-bullhorn" style="color: var(--primary); margin-right: 10px;"></i> 
            Informasi Sistem
        </h3>
        <p>Sistem ini dirancang untuk mempermudah pencatatan dan pelaporan data Posyandu secara digital.
        Gunakan menu di sebelah kiri untuk mengelola data master dan transaksi.</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
