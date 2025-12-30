<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap: wrap; gap: 1rem;">
    <h2>Data Sasaran</h2>
    <div style="display:flex; align-items:center; gap: 10px;">
        <form method="GET" action="" style="display:flex; align-items:center; gap: 5px;">
            <input type="text" name="search" placeholder="Cari NIK..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="padding: 0.6rem 1rem; border: 1px solid #dfe6e9; border-radius: 8px; font-size: 0.9rem; width: 200px;">
            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
            <?php if(isset($_GET['search'])): ?>
                <a href="index.php" class="btn btn-danger" title="Reset"><i class="fas fa-times"></i></a>
            <?php endif; ?>
        </form>
        <div style="height: 24px; border-left: 1px solid #dfe6e9; margin: 0 5px;"></div>
        <a href="create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
    </div>
</div>

<?php flash_message('msg_sasaran'); ?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="font-size: 0.9em;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Tgl Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Kategori</th>
                    <th>Nama Wali</th>
                    <th>No HP Wali</th>
                    <th>Jalan / Dusun</th>
                    <th>RT/RW</th>
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                
                $sql = "SELECT s.*, a.jalan, a.rt, a.rw, a.desa, a.kecamatan, a.kabupaten 
                        FROM sasaran s 
                        LEFT JOIN alamat_sasaran a ON s.alamat_sasaran_id = a.id";
                
                if (!empty($search)) {
                    $sql .= " WHERE s.nik LIKE '%$search%'";
                }

                $sql .= " ORDER BY s.id ASC";
                
                $result = $conn->query($sql);
                $no = 1;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $jk = ($row['jenis_kelamin'] == 1) ? 'L' : 'P';
                        $jenis = ($row['jenis_sasaran'] == 1) ? 'Balita' : (($row['jenis_sasaran'] == 2) ? 'Ibu Hamil' : 'Ibu Menyusui');
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
                        echo "<td>" . date('d M Y', strtotime($row['tanggal_lahir'])) . "</td>";
                        echo "<td>" . $jk . "</td>";
                        echo "<td>" . $jenis . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_wali']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['no_hp_wali']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jalan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['rt']) . "/" . htmlspecialchars($row['rw']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['desa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kecamatan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kabupaten']) . "</td>";
                        echo "<td>
                                <div style='display:flex; gap:5px;'>
                                    <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
                                    <a href='../../actions/sasaran/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus data ini?\")'><i class='fas fa-trash'></i></a>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='14' style='text-align:center;'>Belum ada data sasaran.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
