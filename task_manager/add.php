<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $conn->query("INSERT INTO tasks (title, description) VALUES ('$title', '$description')");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Добавление задачи</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-3">Добавление задачи</h1>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Название</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Описание</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="index.php" class="btn btn-secondary">Назад</a>
  </form>
</body>
</html>
