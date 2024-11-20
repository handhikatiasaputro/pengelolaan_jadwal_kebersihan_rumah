<?php
require 'config.php';
require "functions.php";

handleFormSubmission($db);
get_add_activity($db, $member_id, $aktivitas, $tanggal_kegiatan);
$members = get_all_members($db);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Kegiatan</h1>
        <form action="" method="POST">
            <label for="member_id">Nama:</label>
            <select name="member_id" required>
                <option value="">Pilih Anggota</option>
                <?php while ($row = $members->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="aktivitas">Aktivitas:</label>
            <input type="text" name="aktivitas" required>

            <label for="tanggal_kegiatan">Tanggal Kegiatan:</label>
            <input type="date" name="tanggal_kegiatan" required>

            <button type="submit">Simpan</button>
            <a href="index.php" class="btn">Kembali</a>
        </form>
    </div>
</body>
</html>
