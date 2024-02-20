<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Реєстрація</title>
    <link rel="stylesheet" href="../css/registerLogin.css">
</head>
<body>
<div class="register">
    <h1>Реєстрація</h1>
    <h2>
        <?php
        if ($_GET['error']) {
            echo('Користувач вже існує. Будь ласка, <a href="../pages/loginPage.php">увійдіть в акаунт</a>.');
        }
        ?>
    </h2>
    <form name="registerForm" action="../php/register.php" method="post">
        <label for="input-login">Логін:</label>
        <input id="input-login" type="text" name="login" required onChange="checkInput()">
        <p id="errorLogin"></p>
        <label for="input-password">Пароль:</label>
        <input id="input-password" type="password" name="password" required onChange="checkInput()">
        <label for="input-password-confirm">Підтвердження пароля:</label>
        <input id="input-password-confirm" type="password" name="passwordConfirm" required onChange="checkInput()">
        <p id="errorPass"></p>
        <label for="input-name">Ім'я та прізвище:</label>
        <input id="input-name" type="text" name="name" required onChange="checkInput()">
        <p id="errorName"></p>
        <button id="submit-register" type="button" onclick="validation()" disabled>Зареєструватися</button>
    </form>
    <a class="link" href="loginPage.php">Вже маєш акаунт? Увійти.</a>
</div>

<script>
    const button = document.getElementById('submit-register')
    const inputLogin = document.getElementById('input-login')
    const inputPassword = document.getElementById('input-password')
    const inputPasswordConfirm = document.getElementById('input-password-confirm')
    const inputName = document.getElementById('input-name')
    const errorLogin = document.getElementById('errorLogin')
    const errorPass = document.getElementById('errorPass')
    const errorName = document.getElementById('errorName')
    let samePass = false;
    let goodLogin = false;
    let goodName = false;

    function validation() {
        samePass = (inputPassword.value === inputPasswordConfirm.value)
        errorPass.innerHTML = samePass ? '' : 'Паролі не співпадають'

        if (inputLogin.value.length > 0 && inputLogin.value.length < 3) {
            errorLogin.innerHTML = 'Логін занадто короткий'
            goodLogin = false
        } else if (inputLogin.value.length > 30) {
            errorLogin.innerHTML = 'Логін занадто довгий'
            goodLogin = false
        } else {
            errorLogin.innerHTML = ''
            goodLogin = true
        }

        if (inputName.value.length > 0 && inputName.value.length < 3) {
            errorName.innerHTML = "Ім'я занадто коротке"
            goodName = false
        } else if (inputName.value.length > 100) {
            errorName.innerHTML = "Ім'я занадто довге"
            goodName = false
        } else {
            errorName.innerHTML = ''
            goodName = true
        }

        if (samePass && goodLogin && goodName)
            document.forms['registerForm'].submit()
    }

    function checkInput() {
        button.disabled = !(inputLogin.value !== '' &&
            inputPassword.value !== '' &&
            inputPasswordConfirm.value !== '' &&
            inputName.value !== '');
    }
</script>
</body>
</html>