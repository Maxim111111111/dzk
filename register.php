<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $error = "Логин и пароль обязательны для заполнения";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            $error = "Пользователь с таким логином уже существует";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);
            
            $success = "Регистрация прошла успешно! Теперь вы можете войти.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Регистрация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .logo {
            height: 150px;
            border-radius: 20px;
            display: block;
            margin: 0 auto 20px;
        }
        .refff{
            text-decoration: none;
            color:rgb(255, 255, 255);
            background-color:rgb(92, 180, 89);
            font-family: serif;
            border-radius: 5px;
            width: 50px;
            height: 50px;
        }
        .refff:hover{
        color:rgb(122, 122, 122);
        background-color:rgb(9, 94, 1);
        transition: 1s;
        
        }
        .refff:active{
        color:rgb(53, 53, 53);
        background-color:rgb(111, 255, 98);
        transition: 1ms;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <a href="index.php"><img src="images/logo.jpg" alt="logo" class="logo"/></a>
        <h2>Регистрация</h2>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
            <p style="text-align: center;"><a href="login.php">Войти в аккаунт</a></p>
        <?php else: ?>
            <form action="register.php" method="post">
                <input type="text" name="username" placeholder="Логин" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="submit" value="Зарегистрироваться">
            </form>
            <p style="text-align: center; margin-top: 10px;">Уже есть аккаунт? <a href="login.php" class="refff">Войти</a></p>
        <?php endif; ?>
    </div>
</body>
</html>