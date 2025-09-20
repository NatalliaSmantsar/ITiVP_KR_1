<?php
require 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("UPDATE tasks SET status='выполнена' WHERE id=$id AND status='не выполнена'");
}
header("Location: index.php");
exit;
?>
