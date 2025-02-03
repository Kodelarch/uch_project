<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Initialize total amount
$totalAmount = 0;

// Check if the cart exists in the session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $emptyCartMessage = "Корзина пуста.";
} else {
    $emptyCartMessage = "";
}

// Handle removing from cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]); // Remove product from cart
        echo "<script>alert('Товар удален из корзины!');</script>"; // Notify user
    }
    header('Location: cart.php'); // Redirect back to cart
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Навигационное меню -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Мягкие лапки</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="catalog.php">Каталог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Корзина (<span id="cartCount">0</span>)</a>
                    </li>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Зарегистрироваться</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">Заказы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Выйти</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="cart mt-5">
        <h2>Корзина</h2>
        <?php if ($emptyCartMessage): ?>
            <p><?= $emptyCartMessage ?></p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($_SESSION['cart'] as $productId => $quantity): ?>
                    <?php
                    // Fetch product details from the database
                    $stmt = $conn->prepare("SELECT name, price FROM products WHERE id = ?");
                    $stmt->bind_param("i", $productId);
                    $stmt->execute();
                    $product = $stmt->get_result()->fetch_assoc();
                    $totalAmount += $product['price'] * $quantity;
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['name'] ?></h5>
                                <p class="card-text">Цена: <?= $product['price'] ?> руб.</p>
                                <p class="card-text">Количество: <?= $quantity ?></p>
                                <a href="?action=remove&id=<?= $productId ?>" class="btn btn-danger">Удалить</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <h3>Итого: <?= $totalAmount ?> руб.</h3>
            <button class="btn btn-success" onclick="checkout()">Оформить заказ</button>
        <?php endif; ?>
    </div>

    <!-- Футер -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkout() {
            window.location.href = 'orders.php';
        }
    </script>
</body>
</html>
