document.addEventListener("DOMContentLoaded", function () {
    // Показ главной страницы по умолчанию
    const pages = document.querySelectorAll("[id$='Page']");
    const tabs = document.querySelectorAll(".nav-link");

    // Изначально показываем главную страницу
    document.getElementById("homePage").style.display = 'block';

    tabs.forEach(tab => {
        tab.addEventListener("click", function (e) {
            e.preventDefault();

            // Скрываем все страницы
            pages.forEach(page => page.style.display = 'none');

            // Показываем нужную страницу
            const targetPage = document.getElementById(tab.id.replace("Tab", "Page"));
            targetPage.style.display = 'block';
        });
    });

    // Обработчик формы поиска
    document.getElementById("searchForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const searchValue = document.getElementById("searchInput").value;
        alert("Поиск по запросу: " + searchValue);
    });

    // Обработка формы входа
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;

        // AJAX-запрос для авторизации
        fetch('includes/auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ email, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#loginModal').modal('hide');
                location.reload();
            } else {
                alert(data.message);
            }
        });
    });

    // Обработка формы регистрации
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const username = document.getElementById('registerUsername').value;
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;

        // AJAX-запрос для регистрации
        fetch('includes/auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, email, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#registerModal').modal('hide');
                location.reload();
            } else {
                alert(data.message);
            }
        });
    });

    // Function to update the cart count in the navigation menu
    function updateCartCount() {
        const cartCount = Object.keys(sessionStorage.getItem('cart') || {}).length;
        document.getElementById('cartCount').innerText = cartCount;
    }

    // Modify the existing event listener for the "Добавить в корзину" button
    document.querySelectorAll('.btn-primary').forEach(button => {
        button.addEventListener('click', function() {
            // Add product to cart logic here
            updateCartCount(); // Update the cart count
        });
    });

    // Add functionality to remove products from the cart
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function() {
            // Logic to remove product from cart
            updateCartCount(); // Update the cart count
        });
    });
});
