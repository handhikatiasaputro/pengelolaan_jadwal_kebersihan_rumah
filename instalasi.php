<?php

$hostname = "localhost";
$username = "root";
$password = "";

$db = new mysqli($hostname, $username, $password);
if ($db->connect_error) {
    die("gagal connect:" . $db->connect_error);
}

// membuat database 
$sql_buat_database = "CREATE DATABASE pengelola_jadwal";
$eksekusi_database = $db->query($sql_buat_database);
if ($eksekusi_database) {
    echo "buat db pengelola_jadwal berhasil"; '<br>';
}


// masuk database

$sql_masuk_db = "USE pengelola_jadwal";
$eksekusi_masuk_db = $db->query($sql_masuk_db);
if ($eksekusi_masuk_db) {
    echo "berhasil masuk ke db"; '<br>';
}

// membuat tabel 1
$sql_tabel_satu = "CREATE TABLE member(
id INT PRIMARY KEY AUTO_INCREMENT,
nama VARCHAR(255) NOT NULL
)";

$eksekusi_tabel_satu = $db->query($sql_tabel_satu);
if ($eksekusi_tabel_satu) {
    echo "berhasil membuat tabel_1";
}

//membuat tabel 2
$sql_tabel_dua = "CREATE TABLE kegiatan(
 id INT PRIMARY KEY AUTO_INCREMENT,
    member_id INT(11),
    aktivitas VARCHAR(255) NOT NULL,
    tanggal_kegiatan DATE NOT NULL,
    FOREIGN KEY (member_id) REFERENCES member(id)
)";
$eksekusi_tabel_dua = $db->query($sql_tabel_dua);
if ($eksekusi_tabel_dua) {
    echo "berhasil membuat tabel_2";
}


$db->close();
