<?php
require 'config.php';
require "functions.php";

edit_member();
update_member($db, $id, $nama);
handleFormSubmission($db);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="css/style.css">
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
