<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kulinarniy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $email = $_POST['email'];
    $text = $_POST['text'];
    $stmt = $conn->prepare("INSERT INTO reviews (author, email, text) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $author, $email, $text);
    $stmt->execute();
}

$sql = "SELECT * FROM reviews ORDER BY created_at DESC";
$reviews = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Отзывы</title>
</head>
<body>
<style>
    form {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    input, textarea {
        display: block;
        width: 100%;
        margin: 10px 0;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .review {
        background: #fff;
        padding: 15px;
        margin: 15px 0;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
</style>
    <?php include 'header.php'; ?>
    
    <div class="content">
        <h1>Отзывы</h1>
        <form method="POST">
            <input type="text" name="author" placeholder="Ваше имя" required>
            <input type="email" name="email" placeholder="Ваш email" required>
            <textarea name="text" placeholder="Ваш отзыв" required></textarea>
            <button type="submit">Отправить</button>
        </form>

        <div class="reviews-list">
            <?php while ($review = $reviews->fetch_assoc()): ?>
                <div class="review">
                    <h4><?= $review['author'] ?></h4>
                    <p><?= $review['text'] ?></p>
                    <small><?= $review['created_at'] ?></small>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>