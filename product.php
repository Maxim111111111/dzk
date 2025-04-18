<?php
session_start();
$conn = new mysqli("localhost", "root", "", "recepti");
$id = intval($_GET['id']);

$product = $conn->query("SELECT * FROM flex WHERE id = $id")->fetch_assoc();
$details = $conn->query("SELECT * FROM podrobnoe WHERE product_id = $id")->fetch_assoc();

$img_path = "images/dishes/$id.jpg";
if(!file_exists($img_path)) {
    $img_path = "images/no-image.jpg";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?> - KuliNarniy</title>
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="product-container">
        <img src="<?= $img_path ?>" class="product-image" alt="<?= htmlspecialchars($product['name']) ?>">
        <h1><?= htmlspecialchars($product['name']) ?></h1>
        <p><?= htmlspecialchars($product['description']) ?></p>
        
        <div class="price"><?= $product['price'] ?> руб.</div>
        
        <?php if($details): ?>
        <div class="details">
            <h3>Подробности:</h3>
            <p><strong>Ингредиенты:</strong> <?= htmlspecialchars($details['ingredients']) ?></p>
            <p><strong>Вес:</strong> <?= $details['weight'] ?> г</p>
            <p><strong>Калории:</strong> <?= $details['calories'] ?> ккал</p>
            <p><strong>Время приготовления:</strong> <?= $details['cooking_time'] ?> мин</p>
        </div>
        <?php endif; ?>
        
        <form method="post" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="<?= $id ?>">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
        
        <a href="index.php" class="back-link">← Вернуться к каталогу</a>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
<?php $conn->close(); ?>