<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("DELETE FROM wishlist WHERE id=$id");
}
header("Location: index.php");
exit;
?>
