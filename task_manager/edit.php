<?php
require 'config.php';

if (!isset($_GET['id'])) {
    die("Не указан ID");
}
$id = (int)$_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $conn->query("UPDATE tasks SET title='$title', description='$description' WHERE id=$id");
    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM tasks WHERE id=$id");
$task = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Редактирование задачи</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-3">Редактирование задачи</h1>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Название</label>
      <input type="text" name="title" class="form-control" value="<?= e($task['title']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Описание</label>
      <textarea name="description" class="form-control"><?= e($task['description']) ?></textarea>
    </div>
    <button class="btn btn-primary">Сохранить</button>
    <a href="index.php" class="btn btn-secondary">Назад</a>
  </form>
</body>
</html>
