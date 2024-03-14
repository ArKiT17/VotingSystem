<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Convergence&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="../css/registerLogin.css">
    <title>Вхід в акаунт</title>
</head>
<body>
<header>
    <h1 class="title">Вхід</h1>
</header>
<main>
    <div class="form">
        <h2>
            <?php
            session_start();
            if ($_SESSION['login'] !== null)
                header("Location: ../pages/availableVotes.php");
            const errors = array(
                'invalid_user' => 'Користувача не знайдено.</br>Будь ласка, <a class="link" href="register.php">зареєструйтесь</a>.',
                'incorrect_password' => 'Невірний пароль.'
            );
            echo(errors[$_GET['error']]);
            ?>
        </h2>
        <form action="../php/login.php" method="post">
            <label for="input-login">Логін</label>
            <input id="input-login" type="text" name="login" required oninput="checkInput()">
            <p></p>
            <label for="input-password">Пароль</label>
            <input id="input-password" type="password" name="password" required oninput="checkInput()">
            <p></p>
            <input id="t" type="hidden" name="t">
            <button name="btn" id="submit-login" type="submit" disabled>Login</button>
        </form>
        <a class="link" href="register.php">Ще не маєш акаунту? Зареєструватися.</a>
    </div>
</main>
<?php include "./components/footer.php" ?>
<script>
    const button = document.getElementById('submit-login')
    const inputLogin = document.getElementById('input-login')
    const inputPassword = document.getElementById('input-password')

    function checkInput() {
        button.disabled = !(inputLogin.value !== '' &&
            inputPassword.value !== '');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const date = new Date;
        document.getElementById('t').value = date.getTimezoneOffset() / 60
    });
</script>
</body>
</html>