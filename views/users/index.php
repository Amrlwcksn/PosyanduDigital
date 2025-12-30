<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
check_admin(); // Only admin can manage users

require_once '../../connections/conn.php';
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Data Pengguna</h2>
    <a href="create.php" class="btn btn-primary">+ Tambah Pengguna</a>
</div>

<?php flash_message('msg_user'); ?>

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM users ORDER BY id DESC";
                $result = $conn->query($sql);
                $no = 1;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $role_name = ($row['role'] == 1) ? '<span class="badge badge-success">Admin</span>' : (($row['role'] == 2) ? '<span class="badge badge-info">Operator</span>' : '<span class="badge badge-warning">Kader</span>');
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td><strong>" . htmlspecialchars($row['username']) . "</strong></td>";
                        echo "<td>" . $role_name . "</td>";
                        echo "<td>" . date('d M Y', strtotime($row['created_at'])) . "</td>";
                        echo "<td>
                                <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm' title='Edit'><i class='fas fa-edit'></i></a>
                                <a href='../../actions/users/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus user ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center; padding: 20px;'>Belum ada data pengguna.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
