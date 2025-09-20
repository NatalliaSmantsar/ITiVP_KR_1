<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $link = trim($_POST['link'] ?? '');

    if ($title === '') {
        $error = "Название обязательно.";
    } else {
        // Приводим цену к числу (если пусто — 0.00)
        $priceVal = ($price === '' ? 0.00 : (float)$price);

        $stmt = $conn->prepare("INSERT INTO wishlist (title, description, price, link) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $title, $description, $priceVal, $link);
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
<title>Добавить в Wishlist</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1>Добавить желание</h1>
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
    <div class="mb-3">
      <label class="form-label">Цена (например 199.99)</label>
      <input class="form-control" name="price" type="number" step="0.01" min="0">
    </div>
    <div class="mb-3">
      <label class="form-label">Ссылка (URL)</label>
      <input class="form-control" name="link" type="url" placeholder="https://...">
    </div>
    <button class="btn btn-primary" type="submit">Добавить</button>
    <a class="btn btn-secondary" href="index.php">Отмена</a>
  </form>
</body>
</html>
