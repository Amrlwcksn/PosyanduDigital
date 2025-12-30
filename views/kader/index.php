<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap: wrap; gap: 1rem;">
    <h2>Data Kader</h2>
    <div style="display:flex; align-items:center; gap: 10px;">
        <a href="kader.php" class="btn btn-info"><i class="fas fa-list"></i> Full Data</a>
        <a href="create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
    </div>
</div>

<?php flash_message('msg_kader'); ?>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM kader ORDER BY id DESC";
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
                        echo "<td>
                                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
                                <a href='../../actions/kader/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus kader ini?\")'><i class='fas fa-trash'></i></a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>Belum ada data kader.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
