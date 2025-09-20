<?php
require 'config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT status FROM wishlist WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $stmt->close();

    if ($row) {
        $newStatus = $row['status'] === 'выполнено' ? 'не выполнено' : 'выполнено';
        $stmt = $conn->prepare("UPDATE wishlist SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $newStatus, $id);
        $stmt->execute();
        $stmt->close();
    }
}
header("Location: index.php");
exit;
