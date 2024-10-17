<?php
require 'config.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $aktivitas = $_POST['aktivitas'];
    $tanggal_kegiatan = $_POST['tanggal_kegiatan'];

    $sql = "INSERT INTO kegiatan (member_id, aktivitas, tanggal_kegiatan) VALUES ('$member_id', '$aktivitas', '$tanggal_kegiatan')";
    if ($db->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

// Fetch members for dropdown
$sql_members = "SELECT * FROM member";
$members = $db->query($sql_members);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link rel="stylesheet" href="style.css">
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
