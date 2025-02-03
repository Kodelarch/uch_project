<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $price);
    
    if ($stmt->execute()) {
        $success = "Товар успешно добавлен.";
    } else {
        $error = "Ошибка добавления товара: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="main-content">
        <h1>Добавить товар</h1>
        <?php if (isset($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Название" required>
            <textarea name="description" placeholder="Описание" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Цена" required>
            <button type="submit">Добавить</button>
        </form>
    </div>
</body>
</html>
