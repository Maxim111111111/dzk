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
    $location_id = $_POST['location_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $guests = $_POST['guests'];

    $stmt = $conn->prepare("INSERT INTO bookings (location_id, full_name, email, phone, booking_date, booking_time, guests) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssi", $location_id, $full_name, $email, $phone, $booking_date, $booking_time, $guests);
    $stmt->execute();
    echo "<script>alert('Бронь успешно оформлена!');</script>";
}

$location_id = $_GET['location_id'] ?? 0;
$sql = "SELECT * FROM locations WHERE id = $location_id";
$location = $conn->query($sql)->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Бронирование</title>
    <style>
        .locations-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    padding: 2rem;
}

.location-card {
    background: white;
    padding: 1.5rem;
    border-radius: 15px;
    box-shadow: var(--shadow);
    transition: transform 0.3s;
}

.location-card:hover {
    transform: translateY(-5px);
}

.location-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 1rem;
}

.capacity {
    color: var(--secondary);
    font-weight: 600;
    margin: 1rem 0;
}

.book-button {
    display: inline-block;
    background: var(--gradient);
    color: white;
    padding: 0.8rem 1.5rem;
    border-radius: 30px;
    text-decoration: none;
    transition: opacity 0.3s;
}

.book-button:hover {
    opacity: 0.9;
}
.booking-form {
    max-width: 600px;
    margin: 2rem auto;
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: var(--shadow);
}

.booking-form label {
    display: block;
    margin: 1rem 0 0.5rem;
    font-weight: 500;
}

.booking-form input {
    width: 100%;
    padding: 1rem;
    border: 2px solid #eee;
    border-radius: 10px;
}
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="wrapper">
        <div class="booking-form">
            <h1>Бронирование: <?= $location['name'] ?? 'Выберите локацию' ?></h1>
            <form method="POST">
                <input type="hidden" name="location_id" value="<?= $location_id ?>">
                
                <label>Ваше имя:</label>
                <input type="text" name="full_name" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Телефон:</label>
                <input type="tel" name="phone" pattern="[+]{0,1}[0-9]{11}" required>

                <label>Дата:</label>
                <input type="date" name="booking_date" min="<?= date('Y-m-d') ?>" required>

                <label>Время:</label>
                <input type="time" name="booking_time" min="10:00" max="22:00" required>

                <label>Количество гостей:</label>
                <input type="number" name="guests" min="1" max="<?= $location['capacity'] ?? 50 ?>" required>

                <button type="submit">Подтвердить бронь</button>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>