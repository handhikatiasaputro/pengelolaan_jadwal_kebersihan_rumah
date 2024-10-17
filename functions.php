<?php
require "config.php";
// Fungsi untuk mendapatkan semua anggota
function getAllMembers($db) {
    $sql = "SELECT * FROM member";
    $result = $db->query($sql);
    $members = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    }
    return $members;
}

// Fungsi untuk mendapatkan semua kegiatan
function getAllActivities($db) {
    $sql = "SELECT kegiatan.id AS activity_id, member.nama AS member_name, kegiatan.aktivitas, kegiatan.tanggal_kegiatan 
            FROM kegiatan 
            LEFT JOIN member ON kegiatan.member_id = member.id";
    return $db->query($sql);
}

// Fungsi untuk menambah anggota
function addMember($db, $nama) {
    $sql = "INSERT INTO member (nama) VALUES ('$nama')";
    return $db->query($sql);
}

// Fungsi untuk menambah kegiatan
function addActivity($db, $member_id, $aktivitas, $tanggal_kegiatan) {
    $sql = "INSERT INTO kegiatan (member_id, aktivitas, tanggal_kegiatan) VALUES ('$member_id', '$aktivitas', '$tanggal_kegiatan')";
    return $db->query($sql);
}

// Fungsi untuk mengedit anggota
function editMember($db, $id, $nama) {
    $sql = "UPDATE member SET nama='$nama' WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk mengedit kegiatan
function editActivity($db, $id, $member_id, $aktivitas, $tanggal_kegiatan) {
    $sql = "UPDATE kegiatan SET member_id='$member_id', aktivitas='$aktivitas', tanggal_kegiatan='$tanggal_kegiatan' WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk menghapus anggota
function deleteMember($db, $id) {
    $sql = "DELETE FROM member WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk menghapus kegiatan
function deleteActivity($db, $id) {
    $sql = "DELETE FROM kegiatan WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk menangani pengiriman formulir
function handleFormSubmission($db) {
    // Tangani pengiriman formulir untuk menambah anggota
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_member'])) {
        $nama = $_POST['nama'];
        if (addMember($db, $nama)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $db->error;
        }
    }

    // Tangani pengiriman formulir untuk menambah kegiatan
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_activity'])) {
        $member_id = $_POST['member_id'];
        $aktivitas = $_POST['aktivitas'];
        $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
        if (addActivity($db, $member_id, $aktivitas, $tanggal_kegiatan)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $db->error;
        }
    }

    // Tangani pengiriman formulir untuk mengedit anggota
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_member'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        if (editMember($db, $id, $nama)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $db->error;
        }
    }

    // Tangani pengiriman formulir untuk mengedit kegiatan
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_activity'])) {
        $id = $_POST['id'];
        $member_id = $_POST['member_id'];
        $aktivitas = $_POST['aktivitas'];
        $tanggal_kegiatan = $_POST['tanggal_kegiatan'];
        if (editActivity($db, $id, $member_id, $aktivitas, $tanggal_kegiatan)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $db->error;
        }
    }
}
?>
