<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("UPDATE wishlist SET status='выполнено' WHERE id=$id AND status='не выполнено'");
}
header("Location: index.php");
exit;
?>
