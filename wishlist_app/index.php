<?php
require 'config.php';

$query = "SELECT * FROM wishlist ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Wishlist</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-3">Wishlist</h1>
  <a class="btn btn-primary mb-3" href="add.php">Добавить</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Цена</th>
        <th>Ссылка</th>
        <th>Статус</th>
        <th>Дата</th>
        <th>Функции</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= e($row['title']) ?></td>
            <td><?= e($row['description']) ?></td>
            <td><?= e($row['price']) ?></td>
            <td>
              <?php if (!empty($row['link'])): ?>
                <a href="<?= e($row['link']) ?>" target="_blank">Перейти</a>
              <?php endif; ?>
            </td>
            <td><?= e($row['status']) ?></td>
            <td><?= e($row['created_at']) ?></td>
            <td>
              <a class="btn btn-sm btn-secondary" href="edit.php?id=<?= $row['id'] ?>">Редактировать</a>
              <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Удалить желание?')">Удалить</a>
              <?php if ($row['status'] === 'не выполнено'): ?>
                <a class="btn btn-sm btn-success" href="update_status.php?id=<?= $row['id'] ?>">Отметить выполненным</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7">Записей нет</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
