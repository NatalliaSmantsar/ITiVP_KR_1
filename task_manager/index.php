<?php
require 'config.php';

$query = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Task Manager</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h1 class="mb-3">Task Manager</h1>
  <a class="btn btn-primary mb-3" href="add.php">Добавить</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Статус</th>
        <th>Дата создания</th>
        <th>Функционал</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result && $result->num_rows): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= e($row['title']) ?></td>
            <td><?= e($row['description']) ?></td>
            <td><?= e($row['status']) ?></td>
            <td><?= e($row['created_at']) ?></td>
            <td>
              <a class="btn btn-sm btn-secondary" href="edit.php?id=<?= $row['id'] ?>">Редактировать</a>
              <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Удалить задачу?')">Удалить</a>
              <?php if ($row['status'] === 'не выполнена'): ?>
                <a class="btn btn-sm btn-success" href="update_status.php?id=<?= $row['id'] ?>">Отметить выполненной</a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5">Записей нет</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
