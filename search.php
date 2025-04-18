<?php
$host = 'localhost';
$db   = 'kulinarniy';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$locations = $conn->query("SELECT * FROM locations");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Локации ресторанов</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-color: #f5f5f5;
            color: #333;
        }
        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin: 30px 0;
            color: #ca949f;
        }

        .location-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: flex;
            gap: 20px;
        }
        .location-image {
            width: 300px;
            height: 200px;
            border-radius: 10px;
            object-fit: cover;
        }
        .location-info {
            flex: 1;
        }
        .location-info h3 {
            color: #ca949f;
            margin-bottom: 10px;
        }
        .location-info p {
            margin-bottom: 15px;
            color: #666;
        }
        .book-btn {
            background:#ca949f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }
        .book-btn:hover {
            background:rgb(139, 102, 109);
        }
        @media (max-width: 768px) {
            .location-card {
                flex-direction: column;
            }
            .location-image {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
    <div class="wrapper">
        <h1>Наши рестораны </h1>
        <?php while($location = $locations->fetch_assoc()): ?>
            <div class="location-card">
                <?php if($location['image']): ?>
                    <img src="images/location/<?= $location['image'] ?>" 
                         alt="<?= $location['name'] ?>" 
                         class="location-image">
                <?php endif; ?>
                <div class="location-info">
                    <h3><?= $location['name'] ?></h3>
                    <p><strong>Адрес:</strong> <?= $location['address'] ?></p>
                    <p><?= $location['description'] ?></p>
                    <p><strong>Вместимость:</strong> до <?= $location['capacity'] ?> гостей</p>
                    <a href="booking.php?location_id=<?= $location['id'] ?>" class="book-btn">Забронировать</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>