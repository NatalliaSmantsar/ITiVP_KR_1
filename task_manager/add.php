<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '') {
        $error = "Название обязательно.";
    } else {
        $stmt = $conn->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $description);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Добавить задачу</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Добавить задачу</h1>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Название</label>
      <input class="form-control" name="title" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Описание</label>
      <textarea class="form-control" name="description"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Добавить</button>
    <a class="btn btn-secondary" href="index.php">Назад</a>
  </form>
</body>
</html>
