<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'wishlist';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    die("Ошибка подключения к БД: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
