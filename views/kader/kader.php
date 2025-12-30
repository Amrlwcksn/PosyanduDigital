<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Data Lengkap Kader</h2>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="font-size: 0.9em;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Jalan / Dusun</th>
                    <th>RT/RW</th>
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Kode Pos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT k.*, a.jalan, a.rt, a.rw, a.desa, a.kecamatan, a.kabupaten, a.provinsi, a.kode_pos 
                        FROM kader k 
                        LEFT JOIN alamat_kader a ON k.alamat_kader_id = a.id 
                        ORDER BY k.id DESC";
                $result = $conn->query($sql);
                $no = 1;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $jabatan = ($row['jabatan'] == 1) ? 'Ketua' : (($row['jabatan'] == 2) ? 'Sekretaris' : 'Anggota');
                        $status = ($row['aktif']) ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Non-Aktif</span>';
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['nama']) . "</strong></td>";
                        echo "<td>" . $jabatan . "</td>";
                        echo "<td>" . htmlspecialchars($row['no_hp']) . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "<td>" . htmlspecialchars($row['jalan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['rt']) . "/" . htmlspecialchars($row['rw']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['desa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kecamatan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kabupaten']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['provinsi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kode_pos']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12' style='text-align:center;'>Belum ada data kader.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
