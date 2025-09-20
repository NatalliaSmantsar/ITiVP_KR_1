<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "taskmanager";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>
