<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recepti");

if(isset($_POST['remove'])) {
    unset($_SESSION['cart'][$_POST['product_id']]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Корзина - KuliNarniy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .cart-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .cart-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }
        .cart-item-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }
        .remove-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .total {
            font-size: 24px;
            text-align: right;
            margin: 20px 0;
            color: #ca949f;
            font-weight: bold;
        }
        .checkout-btn {
            background: #7a5a60;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        .empty-cart {
            text-align: center;
            padding: 40px;
            color: #777;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="cart-container">
        <h1>Ваша корзина</h1>
        
        <?php if(empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <p>Ваша корзина пуста</p>
                <a href="index.php" style="color: #7a5a60; font-weight: bold;">Перейти к покупкам</a>
            </div>
        <?php else: ?>
            <?php
            $total = 0;
            foreach($_SESSION['cart'] as $id => $qty):
                $product = $conn->query("SELECT * FROM flex WHERE id = $id")->fetch_assoc();
                $subtotal = $product['price'] * $qty;
                $total += $subtotal;
                
                $img_path = "images/dishes/$id.jpg";
                if(!file_exists($img_path)) {
                    $img_path = "images/no-image.jpg";
                }
            ?>
            <div class="cart-item">
                <img src="<?= $img_path ?>" class="cart-item-image" alt="<?= htmlspecialchars($product['name']) ?>">
                <div style="flex-grow: 1;">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= htmlspecialchars($product['description']) ?></p>
                    <p>Цена: <?= $product['price'] ?> руб. × <?= $qty ?> = <?= $subtotal ?> руб.</p>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?= $id ?>">
                        <button type="submit" name="remove" class="remove-btn">Удалить</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div class="total">Итого: <?= $total ?> руб.</div>
            
            <button class="checkout-btn">Оформить заказ</button>
            
            <a href="index.php" style="display: inline-block; margin-top: 20px; color: #7a5a60; font-weight: bold;">← Продолжить покупки</a>
        <?php endif; ?>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
<?php $conn->close(); ?>