<?php
require 'config.php';

edit_kegiatan();
handleFormSubmission($db);

//edit
update_Activity($db, $id, $member_id, $aktivitas, $tanggal_kegiatan);
$members = get_all_members($db);
 ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Kegiatan</h1>
        <form action="" method="POST">
            <label for="member_id">Nama:</label>
            <select name="member_id" required>
                <option value="">Pilih Anggota</option>
                <?php while ($row = $members->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $activity['member_id']) echo 'selected'; ?>><?php echo $row['nama']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="aktivitas">Aktivitas:</label>
            <input type="text" name="aktivitas" value="<?php echo $activity['aktivitas']; ?>" required>

            <label for="tanggal_kegiatan">Tanggal Kegiatan:</label>
            <input type="date" name="tanggal_kegiatan" value="<?php echo $activity['tanggal_kegiatan']; ?>" required>

            <button type="submit">Update</button>
            <a href="index.php" class="btn">Kembali</a>
        </form>
    </div>
</body>
</html>
