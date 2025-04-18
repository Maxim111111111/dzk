<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kulinarniy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "SELECT * FROM ingredients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<style>
    .ingredient {
        background:rgb(255, 255, 255);
        border: 1px solid rgb(180, 135, 145);
        padding: 15px;
        margin: 15px 0;
        border-radius: 8px;
    }
    .ingredient h3 {
        color: #ca949f;
        margin: 0 0 8px;
    }
    .ingredient small {
        color: #3498db;
        font-weight: bold;
    }
</style>
    <meta charset="UTF-8">
    <title>Ингредиенты</title>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="content">
        <h1>Ингредиенты</h1>
        <div class="ingredients-list">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="ingredient">
                    <h3><?= $row['name'] ?></h3>
                    <p><?= $row['description'] ?></p>
                    <small>Категория: <?= $row['category'] ?></small>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>