<?php
require 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$item = $res->fetch_assoc();
$stmt->close();

if (!$item) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = ($_POST['status'] ?? 'не выполнена');

    if ($title === '') {
        $error = "Название обязательно.";
    } else {
        $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $status, $id);
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
<title>Редактировать задачу</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Редактировать задачу</h1>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
  <?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Название</label>
      <input class="form-control" name="title" value="<?= e($item['title']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Описание</label>
      <textarea class="form-control" name="description"><?= e($item['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Статус</label>
      <select class="form-select" name="status">
        <option value="не выполнена" <?= $item['status'] === 'не выполнена' ? 'selected' : '' ?>>не выполнена</option>
        <option value="выполнена" <?= $item['status'] === 'выполнена' ? 'selected' : '' ?>>выполнена</option>
      </select>
    </div>
    <button class="btn btn-primary" type="submit">Сохранить</button>
    <a class="btn btn-secondary" href="index.php">Отмена</a>
  </form>
</body>
</html>
