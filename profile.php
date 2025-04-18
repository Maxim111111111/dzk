<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'config.php';

$stmt = $pdo->prepare("SELECT username, created_at FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Профиль</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 80%;
            min-width: 600px;
            margin: 0px auto;
            min-height: 97vh;
            display: flex;
            flex-direction: column;
        }
        .header, .footer {
            background-color: #ca949f;
            padding: 20px;
            border-radius: 50px 50px 0 0;
        }
        .header {
            height: 150px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer {
            height: 150px;
            margin-top: auto;
        }
        .logo {
            height: 150px;
            border-radius: 20px;
        }
        .profile-container {
            background-color: white;
            padding: 30px;
            margin: 20px 0;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logout-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }
        .sidebar {
            background-color: #ca949f;
            padding: 20px;
            border-radius: 0 0 50px 50px;
        }
        .menu ul {
            list-style: none;
            padding: 0;
        }
        .menu li {
            margin: 10px 0;
        }
        .menu a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        .menu a:hover {
            text-decoration: underline;
        }
        .pip h2{
        text-align :center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <a href="index.html"><img src="images/logo.png" alt="logo" class="logo"/></a>
            <div class="pip">
                <h2>Добро пожаловать, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            </div>
        </div>
        
        <div class="profile-container">
            <h2>Ваш профиль</h2>
            <p><strong>Логин:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Дата регистрации:</strong> <?php echo date('d.m.Y H:i', strtotime($user['created_at'])); ?></p>
            
            <a href="logout.php" class="logout-btn">Выйти</a>
        </div>
        
        <div class="sidebar">
            <div class="menu">
                <ul>
                    <li><a href="index.php">Домашняя</a></li>
                    <li><a href="o nas.html">О нас</a></li>
                    <li><a href="news.html">Новости в мире кулинарии</a></li>
                    <li><a href="otzivi.html">Отзывы реальных покупателей</a></li>
                </ul>
            </div>
        </div>
        
        <div class="footer">
        </div>
    </div>
    
</body>
</html>