<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="../css/registerLogin.css">
</head>
<body>
<div class="register">
    <?php
    echo("<h2>");
    $mysqli = new mysqli('localhost', 'root', '', 'voting');
    if ($mysqli->connect_error) {
        die("Connection error: " . $mysqli->connect_error);
    }

    $login = $_POST['login'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $queryExistUser = "select count(login) as 'count' from user where login like '$login'";
    $resultExistUser = $mysqli->query($queryExistUser);
    if (!$resultExistUser) {
        die("Error in SQL query: " . $mysqli->error);
    }
    if ($resultExistUser->fetch_assoc()['count'] > 0) {
        echo('Користувач вже існує. Будь ласка, <a href="../pages/loginPage.php">увійдіть в акаунт</a>.');
        exit();
    }
    $hashPass = password_hash($password, PASSWORD_BCRYPT);
    $query = "insert into user (login, name, password, role) value ('$login', '$name', '$hashPass', 0)";
    $result = $mysqli->query($query);
    if (!$result) {
        die("Error in SQL query: " . $mysqli->error);
        echo("</h2>");
    } else {
        header("Location: loginPage.php");;
    }

    $mysqli->close();
    ?>
</div>
</body>
</html>