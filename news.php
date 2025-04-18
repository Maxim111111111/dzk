<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kulinarniy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "SELECT * FROM news ORDER BY published_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<style>
    .news-item {
        background: #fff5f5;
        border-left: 4px solid rgb(155, 114, 122);
        margin: 20px 0;
        padding: 15px;
        border-radius: 0 8px 8px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .news-item h3 {
        color: #ca949f;
        margin: 0 0 10px;
    }
    .news-item small {
        display: block;
        color: #666;
        font-size: 0.9em;
        margin-top: 10px;
    }
</style>
    
    <meta charset="UTF-8">
    <title>Новости</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="styles.css">
    <div class="content">
        <h1>Новости</h1>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="news-item">
                <h3><?= $row['title'] ?></h3>
                <p><?= $row['content'] ?></p>
                <small><?= $row['published_at'] ?></small>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>