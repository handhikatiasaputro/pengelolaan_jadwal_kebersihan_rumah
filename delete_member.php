<?php
require 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM member WHERE id = $id";
if ($db->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting record: " . $db->error;
}
?>
