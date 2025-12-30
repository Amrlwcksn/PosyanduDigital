<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';

// Fetch Activities for FilterDropdown
$activities = $conn->query("SELECT * FROM kegiatan_posyandu ORDER BY tanggal_kegiatan DESC");
$filter_id = isset($_GET['kegiatan_id']) ? (int)$_GET['kegiatan_id'] : 0;
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Data Pelayanan</h2>
    <a href="create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pelayanan</a>
</div>

<!-- Filter Section -->
<div class="card" style="margin-bottom: 20px;">
    <form method="GET" action="" style="display: flex; gap: 10px; align-items: flex-end; margin:0;">
        <div style="flex: 1;">
            <label style="margin-bottom: 5px; display: block;">Filter Berdasarkan Kegiatan:</label>
            <select name="kegiatan_id" class="form-control" style="margin-bottom: 0;">
                <option value="">-- Semua Kegiatan --</option>
                <?php while($act = $activities->fetch_assoc()): ?>
                    <option value="<?php echo $act['id']; ?>" <?php if($filter_id == $act['id']) echo 'selected'; ?>>
                        <?php echo date('d M Y', strtotime($act['tanggal_kegiatan'])) . ' - ' . $act['lokasi']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-info" style="color: white;"><i class="fas fa-filter"></i> Filter</button>
        <?php if($filter_id > 0): ?>
            <a href="index.php" class="btn btn-warning"><i class="fas fa-sync"></i> Reset</a>
        <?php endif; ?>
    </form>
</div>

<?php flash_message('msg_pelayanan'); ?>

<div class="card">
    <div class="table-responsive">
        <table style="font-size:0.9em;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Sasaran (Anak/Ibu)</th>
                    <th>BB (kg)</th>
                    <th>TB (cm)</th>
                    <th>Gizi</th>
                    <th>Imunisasi</th>
                    <th>Vit</th>
                    <th>Kader</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Base Query
                $sql = "SELECT p.*, k.tanggal_kegiatan, s.nama as nama_sasaran, kd.nama as nama_kader 
                        FROM pelayanan p 
                        JOIN kegiatan_posyandu k ON p.kegiatan_id = k.id 
                        JOIN sasaran s ON p.sasaran_id = s.id 
                        JOIN kader kd ON p.kader_id = kd.id";
                
                // Add Filter Condition
                if ($filter_id > 0) {
                    $sql .= " WHERE p.kegiatan_id = $filter_id";
                }

                $sql .= " ORDER BY k.tanggal_kegiatan DESC, p.id DESC";

                $result = $conn->query($sql);
                $no = 1;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $gizi = ($row['status_gizi'] == 1) ? '<span class="badge badge-success">Baik</span>' : (($row['status_gizi'] == 2) ? '<span class="badge badge-warning">Kurang</span>' : '<span class="badge badge-danger">Buruk</span>');
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . date('d M Y', strtotime($row['tanggal_kegiatan'])) . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['nama_sasaran']) . "</strong></td>";
                        echo "<td>" . $row['berat_badan'] . "</td>";
                        echo "<td>" . $row['tinggi_badan'] . "</td>";
                        echo "<td>" . $gizi . "</td>";
                        echo "<td>" . htmlspecialchars($row['imunisasi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vitamin']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_kader']) . "</td>";
                        echo "<td>
                                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm' title='Edit'><i class='fas fa-edit'></i></a>
                                <a href='../../actions/pelayanan/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus data ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' style='text-align:center; padding: 20px;'>Tidak ada data untuk kriteria ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
