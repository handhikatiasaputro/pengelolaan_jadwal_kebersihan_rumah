<?php
require 'config.php';

$id = $_GET['id'];

// Fetch member details
$sql = "SELECT * FROM member WHERE id = $id";
$result = $db->query($sql);
$member = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];

    $sql = "UPDATE member SET nama = '$nama' WHERE id = $id";
    if ($db->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Anggota</h1>
        <form action="" method="POST">
            <label for="nama">Nama Anggota:</label>
            <input type="text" name="nama" value="<?php echo $member['nama']; ?>" required>

            <button type="submit">Update</button>
            <a href="index.php" class="btn">Kembali</a>
        </form>
    </div>
</body>
</html>