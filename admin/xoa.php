<?php
session_start();
require("../inc/config.php");

if (!isset($_GET['url'])) {
    echo "Tham số không hợp lệ!";
    exit;
}

$url = $conn->real_escape_string($_GET['url']); // Tránh lỗi SQL Injection
$sql = "DELETE FROM phim WHERE link='$url'";

if ($conn->query($sql) === TRUE) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "Xóa không thành công, lỗi: " . $conn->error;
}

$conn->close();
?>
