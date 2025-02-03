<?php
session_start();
include 'includes/db.php';
include 'includes/auth.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .footer-text {
            font-size: 0.8em; /* Smaller footer text */
        }
        .new-products-section {
            text-align: center; /* Center the section */
        }
        .new-products-section .card {
            max-width: 200px; /* Make products slightly larger */
        }
    </style>
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
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Зарегистрироваться</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Корзина</a>
                        </li>
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

    <!-- Новый слайдер -->
    <div id="new-slider" class="carousel slide mx-auto" style="width: 50%; margin-top: 100px;" data-bs-ride="carousel" data-bs-interval="3000"> <!-- Slower interval -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/slider1.jpg" class="d-block w-100" alt="Слайд 1" style="height: 200px;">
            </div>
            <div class="carousel-item">
                <img src="assets/images/slider2.jpg" class="d-block w-100" alt="Слайд 2" style="height: 200px;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#new-slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#new-slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- Новый товары -->
    <div class="new-products-section" style="margin-top: 20px;">
        <h3>Новые товары</h3>
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <img src="assets/images/product1.jpg" class="card-img-top" alt="Товар 1" style="height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title">Товар 1</h5>
                        <p class="card-text">Описание товара 1.</p>
                        <a href="#" class="btn btn-primary">Добавить в корзину</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="assets/images/product2.jpg" class="card-img-top" alt="Товар 2" style="height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title">Товар 2</h5>
                        <p class="card-text">Описание товара 2.</p>
                        <a href="#" class="btn btn-primary">Добавить в корзину</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="assets/images/product3.jpg" class="card-img-top" alt="Товар 3" style="height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title">Товар 3</h5>
                        <p class="card-text">Описание товара 3.</p>
                        <a href="#" class="btn btn-primary">Добавить в корзину</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="assets/images/product4.jpg" class="card-img-top" alt="Товар 4" style="height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title">Товар 4</h5>
                        <p class="card-text">Описание товара 4.</p>
                        <a href="#" class="btn btn-primary">Добавить в корзину</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="assets/images/product5.jpg" class="card-img-top" alt="Товар 5" style="height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title">Товар 5</h5>
                        <p class="card-text">Описание товара 5.</p>
                        <a href="#" class="btn btn-primary">Добавить в корзину</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <img src="assets/images/product6.jpg" class="card-img-top" alt="Товар 6" style="height: 150px;">
                    <div class="card-body">
                        <h5 class="card-title">Товар 6</h5>
                        <p class="card-text">Описание товара 6.</p>
                        <a href="#" class="btn btn-primary">Добавить в корзину</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Окошки с новостями -->
    <div class="news-section" style="margin-top: 20px; padding: 20px;">
        <div class="row">
            <div class="col-md-4">
                <div class="news-item" style="background: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h5>Заголовок новости 1</h5>
                    <p>Описание новости 1. Здесь будет текст новости, который расскажет о важном событии.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="news-item" style="background: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h5>Заголовок новости 2</h5>
                    <p>Описание новости 2. Здесь будет текст новости, который расскажет о важном событии.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="news-item" style="background: #f8f9fa; padding: 15px; border-radius: 5px;">
                    <h5>Заголовок новости 3</h5>
                    <p>Описание новости 3. Здесь будет текст новости, который расскажет о важном событии.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Бренды - с которыми мы сотрудничаем -->
    <div class="brands-section" style="text-align: center; margin-top: 20px;">
        <h3>Бренды - с которыми мы сотрудничаем</h3>
        <div class="row">
            <div class="col-md-3"><img src="assets/images/brand1.jpg" alt="Бренд 1" class="img-fluid"></div>
            <div class="col-md-3"><img src="assets/images/brand2.jpg" alt="Бренд 2" class="img-fluid"></div>
            <div class="col-md-3"><img src="assets/images/brand3.jpg" alt="Бренд 3" class="img-fluid"></div>
            <div class="col-md-3"><img src="assets/images/brand4.jpg" alt="Бренд 4" class="img-fluid"></div>
            <div class="col-md-3"><img src="assets/images/brand5.jpg" alt="Бренд 5" class="img-fluid"></div>
            <div class="col-md-3"><img src="assets/images/brand6.jpg" alt="Бренд 6" class="img-fluid"></div>
        </div>
    </div>

    <!-- Футер -->
    <footer class="footer-text" style="padding: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>© 2023 Мягкие лапки. Все права защищены.</p>
                </div>
                <div class="col-md-4">
                    <p>Контакт: info@myagkielapki.ru | Телефон: +7 (123) 456-78-90</p>
                </div>
                <div class="col-md-4">
                    <p>Следите за нами в социальных сетях:</p>
                    <a href="#">Facebook</a> | <a href="#">Instagram</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
