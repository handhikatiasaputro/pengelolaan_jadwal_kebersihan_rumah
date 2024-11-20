<?php
require "config.php";

// Fungsi untuk mendapatkan semua anggota
function get_all_members($db) 
{
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
function get_all_activities($db) 
{
    $sql = "SELECT kegiatan.id AS activity_id, member.nama AS member_name, kegiatan.aktivitas, kegiatan.tanggal_kegiatan 
            FROM kegiatan 
            LEFT JOIN member ON kegiatan.member_id = member.id";
    return $db->query($sql);
}

// Fungsi untuk menambah anggota
function add_member($db, $nama) {
    $sql = "INSERT INTO member (nama) VALUES ('$nama')";
    return $db->query($sql);
}

// Fungsi untuk menambah kegiatan
function add_activity($db, $member_id, $aktivitas, $tanggal_kegiatan)
{
    $sql = "INSERT INTO kegiatan (member_id, aktivitas, tanggal_kegiatan) VALUES ('$member_id', '$aktivitas', '$tanggal_kegiatan')";
    return $db->query($sql);
}

function edit_member($db) 
{
    
    $id = $_GET['id'];

    $sql = "SELECT * FROM member WHERE id = $id";
    $result = $db->query($sql);
    $member = $result->fetch_assoc();
    return $member;

}

function getMemberById($db, $id) 
{
    $sql = "SELECT * FROM member WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();
    return $member;
}


function edit_kegiatan($db) 
{
    $id = $_GET['id'];
    // Fetch activity details
    $sql = "SELECT * FROM kegiatan WHERE id = $id";
    $result = $db->query($sql);
    $activity = $result->fetch_assoc();

    return $activity;
}


// Fungsi untuk mengedit anggota
function update_member($db, $id, $nama) 
{
    $sql = "UPDATE member SET nama='$nama' WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk mengedit kegiatan
function update_activity($db, $id, $member_id, $aktivitas, $tanggal_kegiatan) 
{
    $sql = "UPDATE kegiatan SET member_id='$member_id', aktivitas='$aktivitas', tanggal_kegiatan='$tanggal_kegiatan' WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk menghapus anggota
function delete_member($db, $id) {
    $sql = "DELETE FROM member WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk menghapus kegiatan
function delete_activity($db, $id) {
    $sql = "DELETE FROM kegiatan WHERE id='$id'";
    return $db->query($sql);
}

// Fungsi untuk menghapus anggota dan semua kegiatan terkait
function deleteMemberAndActivities($db, $id) 
{
    // Hapus kegiatan terkait
    $sql_activities = "DELETE FROM kegiatan WHERE member_id='$id'";
    $db->query($sql_activities);
    
    // Hapus anggota
    $sql_member = "DELETE FROM member WHERE id='$id'";
    return $db->query($sql_member);
}


// Fungsi untuk menangani pengiriman formulir
function handleFormSubmission($db) 
{
    // Tangani pengiriman formulir untuk menambah anggota
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_member'])) {
        $nama = $_POST['nama'];
        if (add_member($db, $nama)) {
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
        if (add_activity($db, $member_id, $aktivitas, $tanggal_kegiatan)) {
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
        if (update_member($db, $id, $nama)) {
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
        if (update_activity($db, $id, $member_id, $aktivitas, $tanggal_kegiatan)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $db->error;
        }
    }
}
