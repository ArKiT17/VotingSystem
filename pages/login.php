<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вхід в акаунт</title>
    <link rel="stylesheet" href="../css/registerLogin.css">
</head>
<body>
<div class="login">
    <h1>Вхід</h1>
    <h2>
        <?php
        session_start();
        if ($_SESSION['login'] !== null)
            header("Location: ../pages/availableVotes.php");
        const errors = array(
            'invalid_user' => 'Користувача не знайдено. Будь ласка, <a href="register.php">зареєструйтесь</a>.',
            'incorrect_password' => 'Невірний пароль.'
        );
        echo(errors[$_GET['error']]);
        ?>
    </h2>
    <form action="../php/login.php" method="post">
        <label for="input-login">Логін:</label>
        <input id="input-login" type="text" name="login" required oninput="checkInput()">
        <label for="input-password">Пароль:</label>
        <input id="input-password" type="password" name="password" required oninput="checkInput()">
        <button name="btn" id="submit-login" type="submit" disabled>Login</button>
    </form>
    <a href="register.php">Ще не маєш акаунту? Зареєструватися.</a>
</div>
<footer>
    <h3>© 2024. Всі права захищені.</h3>
</footer>
<script>
    const button = document.getElementById('submit-login')
    const inputLogin = document.getElementById('input-login')
    const inputPassword = document.getElementById('input-password')

    function checkInput() {
        button.disabled = !(inputLogin.value !== '' &&
            inputPassword.value !== '');
    }
</script>
</body>
</html>