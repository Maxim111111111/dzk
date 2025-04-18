<div class="header">
    <span class="logo"><a href="index.php"><img src="images/logo.jpg" alt="Логотип"></a></span>
    <div style="margin-left: 20px;">
        <div style="font-size: 24px; font-weight: bold; color: white;">KuliNarniy</div>
        <div class="menu">
            <ul>
                <li><a href="search.php">Локации</a></li>
                <li><a href="booking.php">Бронирование</a></li>
                <li><a href="login.php">Авторизация</a></li>
            </ul>
        </div>
    </div>
    <a href="cart.php" class="cart-link">Корзина (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a>
</div>

<style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .wrapper {
            width: 80%;
            min-width: 600px;
            margin: 0 auto;
            min-height: 97vh;
            display: flex;
            flex-direction: column;
        }
        .header {
            background: #ca949f;
            height: 150px;
            padding: 20px;
            display: flex;
            border-radius: 10px 10px 0 0;
        }
        .footer {
            background: #ca949f;
            height: 150px;
            padding: 20px;
            margin-top: auto;
            border-radius: 0 0 10px 10px;
        }
        .container {
            display: flex;
            min-height: 59vh;
        }
        .content {
            width: 80%;
            padding: 20px;
        }
        .sidebar {
            width: 20%;
            min-width: 200px;
            padding: 10px;
            background: #ca949f;
        }
        .menu ul {
            display: flex;
            list-style: none;
        }
        .menu li {
            margin-right: 5px;
            padding: 10px;
            background: #7a5a60;
        }
        .menu li a {
            color: white;
            text-decoration: none;
        }
        .logo img {
            border-radius: 50px;
            width: 100px;
            height: 100px;
        }

        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 15px;
            padding: 15px;
            width: 250px;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .price {
            font-weight: bold;
            color: #ca949f;
            font-size: 18px;
            margin-top: 10px;
        }
        .add-to-cart {
            background: #7a5a60;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }
        .add-to-cart:hover {
            background: #5a3a40;
        }

        .cart-link {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #7a5a60;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            z-index: 1000;
        }
        .cart-link:hover {
            background: #5a3a40;
        }
        
        .slider {
            position: relative;
            max-width: 600px;
            margin: 20px auto;
            overflow: hidden;
            border-radius: 10px;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }
        .slide {
            min-width: 100%;
        }
        .slide img {
            width: 100%;
            height: auto;
        }
    </style>