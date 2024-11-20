<?php
require 'config.php';
require "functions.php";

add_member($db, $nama);
handleFormSubmission($db);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Anggota</h1>
        <form action="" method="POST">
            <label for="nama">Nama Anggota:</label>
            <input type="text" name="nama" required>

            <button type="submit">Simpan</button>
            <a href="index.php" class="btn">Kembali</a>
        </form>
    </div>
</body>
</html>
