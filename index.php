<?php
require "config.php";
require "functions.php"; 

// Menghandle pengiriman formulir
handleFormSubmission($db);

// Ambil semua anggota
$members = get_all_members($db);

// Ambil semua kegiatan
$result_activities = get_all_activities($db);

$edit_member_id = isset($_GET['edit_member']) ? $_GET['edit_member'] : null;
// Mendapatkan data anggota untuk edit
$member_to_edit = null;
if ($edit_member_id) {
    $sql = "SELECT * FROM member WHERE id='$edit_member_id'";
    $member_to_edit = $db->query($sql)->fetch_assoc();
}

$edit_activity_id = isset($_GET['edit_activity']) ? $_GET['edit_activity'] : null;
// Mendapatkan data kegiatan untuk edit
$activity_to_edit = null;
if ($edit_activity_id) {
    $sql = "SELECT * FROM kegiatan WHERE id='$edit_activity_id'";
    $activity_to_edit = $db->query($sql)->fetch_assoc();
}


// Menghapus anggota jika diinginkan
if (isset($_GET['delete_member'])) {
    $id = $_GET['delete_member'];
    delete_member($db, $id);
    header("Location: index.php");
    exit();
}

// Menghapus kegiatan jika diinginkan
if (isset($_GET['delete_activity'])) {
    $id = $_GET['delete_activity'];
    delete_activity($db, $id);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelola Jadwal Kebersihan Rumah</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Pengelola Jadwal Kebersihan Rumah</h1>

        <!-- Form untuk menambah anggota -->
        <h2>Tambah Anggota</h2>
        <form action="" method="POST">
            <label for="nama">Nama Anggota:</label>
            <input type="text" name="nama" required>
            <button type="submit" name="add_member">Simpan</button>
        </form>

        <!-- Tabel Daftar Anggota -->
        <h2>Daftar Anggota</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Anggota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($members)): ?>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['nama']; ?></td>
                            <td>
                                <a href="?edit_member=<?php echo $member['id']; ?>">Edit</a>
                                <a href="?delete_member=<?php echo $member['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Tidak ada anggota ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Form untuk mengedit anggota jika ada -->
        <?php if ($member_to_edit): ?>
            <h2>Edit Anggota</h2>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $member_to_edit['id']; ?>">
                <label for="nama">Nama Anggota:</label>
                <input type="text" name="nama" value="<?php echo $member_to_edit['nama']; ?>" required>
                <button type="submit" name="edit_member">Simpan Perubahan</button>
            </form>
        <?php endif; ?>

        <!-- Form untuk menambah kegiatan -->
        <h2>Tambah Kegiatan</h2>
        <form action="" method="POST">
            <label for="member_id">Pilih Anggota:</label>
            <select name="member_id" required>
                <option value="">-- Pilih Anggota --</option>
                <?php foreach ($members as $member): ?>
                    <option value="<?php echo $member['id']; ?>"><?php echo $member['nama']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="aktivitas">Aktivitas:</label>
            <input type="text" name="aktivitas" required>
            <label for="tanggal_kegiatan">Tanggal Kegiatan:</label>
            <input type="date" name="tanggal_kegiatan" required>
            <button type="submit" name="add_activity">Simpan</button>
        </form>

        <!-- Tabel Daftar Kegiatan -->
        <h2>Daftar Kegiatan</h2>
        <table>
            <thead>
                <tr>
                    <th>No. Kegiatan</th>
                    <th>Nama Anggota</th>
                    <th>Aktivitas</th>
                    <th>Tanggal Kegiatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_activities->num_rows > 0): ?>
                    <?php while ($activity = $result_activities->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $activity['activity_id']; ?></td>
                            <td><?php echo $activity['member_name']; ?></td>
                            <td><?php echo $activity['aktivitas']; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($activity['tanggal_kegiatan'])); ?></td>
                            <td>
                                <a href="?edit_activity=<?php echo $activity['activity_id']; ?>">Edit</a>
                                <a href="?delete_activity=<?php echo $activity['activity_id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Tidak ada kegiatan ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Form untuk mengedit kegiatan jika ada -->
        <?php if ($activity_to_edit): ?>
            <h2>Edit Kegiatan</h2>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $activity_to_edit['id']; ?>">
                <label for="member_id">Pilih Anggota:</label>
                <select name="member_id" required>
                    <?php foreach ($members as $member): ?>
                        <option value="<?php echo $member['id']; ?>" <?php echo ($member['id'] == $activity_to_edit['member_id']) ? 'selected' : ''; ?>>
                            <?php echo $member['nama']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="aktivitas">Aktivitas:</label>
                <input type="text" name="aktivitas" value="<?php echo $activity_to_edit['aktivitas']; ?>" required>
                <label for="tanggal_kegiatan">Tanggal Kegiatan:</label>
                <input type="date" name="tanggal_kegiatan" value="<?php echo $activity_to_edit['tanggal_kegiatan']; ?>" required>
                <button type="submit" name="edit_activity">Simpan Perubahan</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
