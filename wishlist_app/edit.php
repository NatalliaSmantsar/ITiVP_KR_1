<?php
require 'config.php';

if (!isset($_GET['id'])) {
    die("Не указан ID");
}
$id = (int)$_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = (float)$_POST['price'];
    $link = $conn->real_escape_string($_POST['link']);
    $conn->query("UPDATE wishlist 
                  SET title='$title', description='$description', price=$price, link='$link' 
                  WHERE id=$id");
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM wishlist WHERE id=$id");
$item = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Редактировать желание</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-3">Редактировать желание</h1>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Название</label>
      <input type="text" name="title" class="form-control" value="<?= e($item['title']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Описание</label>
      <textarea name="description" class="form-control"><?= e($item['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Цена</label>
      <input type="number" step="0.01" name="price" class="form-control" value="<?= e($item['price']) ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Ссылка</label>
      <input type="url" name="link" class="form-control" value="<?= e($item['link']) ?>">
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="index.php" class="btn btn-secondary">Назад</a>
  </form>
</body>
</html>
