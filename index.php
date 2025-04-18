<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recepti");
if ($conn->connect_error) die("Ошибка подключения к БД: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']);
    $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Кулинарный сайт</title>
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
            color: #ca949f;
        }
        *{
            text-decoration: none;
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
        
.card {
    text-decoration: none !important;
}

.card a, .card a:visited, .card a:hover, .card a:active {
    text-decoration: none;
    color: inherit;
}

.card h2, .card h3, .card p {
    margin: 8px 0;
    color:rgb(114, 66, 102); 
}
    </style>
</head>
<body>
    <a href="cart.php" class="cart-link">Корзина (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a>
    
    <div class="wrapper">
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
        </div>
        <div class="container">
            <div class="content">
                <h1 style="text-align: center; margin: 20px 0;">Выбор рецептов</h1>
            
                
                <h2 style="margin: 20px 0 10px 40px;">Кухни мира</h2>
                
                <main>
    <?php
    $result = $conn->query("SELECT * FROM flex");
    while($row = $result->fetch_assoc()):
        $image_path = "images/dishes/{$row['id']}.jpg";
        $image_url = file_exists($image_path) ? $image_path : "";
    ?>
    <div class="card">
        <a href="product.php?id=<?= $row['id'] ?>">
            <img src="<?= $image_url ?>" alt="<?= $row['name'] ?>">
            <h3><?= $row['name'] ?></h3>
            <p><?= $row['description'] ?></p>
            <div class="price"><?= $row['price'] ?> руб.</div>
        </a>
        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            
                            
                        </form>
                    </div>
                    <?php endwhile; ?>
                </main>
            </div>
            
            <div class="sidebar">
                <div class="menu">
                    <ul style="flex-direction: column;">
                        <li><a href="o_nas.php">О нас</a></li>
                        <li><a href="news.php">Новости</a></li>
                        <li><a href="otzivi.php">Отзывы</a></li>
                        <li><a href="ingredienti.php">Ингредиенты</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div style="text-align: center; color: white; padding-top: 20px;">
                <p>Телефон: 7 (962) 576 98-11</p>
                <p>Email: info@kulinarniy.ru</p>
                <p>&copy; 2025 KuliNarniy. Все права защищены.</p>
            </div>
        </div>
    </div>
    
    <script>
        let currentSlide = 0;
        const slides = document.querySelector('.slides');
        const slideCount = document.querySelectorAll('.slide').length;
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slideCount;
            slides.style.transform = translateX(-${currentSlide * 100}%);
        }
        
        setInterval(nextSlide, 3000);
        
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                this.textContent = 'Добавлено!';
                setTimeout(() => {
                    this.textContent = 'В корзину';
                    this.form.submit();
                }, 500);
            });
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>