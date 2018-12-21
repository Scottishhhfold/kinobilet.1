<?php
session_start();
require_once "functions.php";
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<form action="" method="post" name="reg">
    login<br>
    <input type="text" name="login" required minlength="6" ><br>
    password<br>
    <input type="password" name="pas" required minlength="6" ><br>
    e-mail<br>
    <input type="email" name="email" required ><br>
    <input type="submit" name="submit" value="Зареєструватись"><br>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])) {
    $name = $_POST["login"];
    $pas = $_POST["pas"];
    $email = $_POST["email"];
    $_SESSION["login"] = $name;
    $_SESSION["pass"] = $pas;
    $_SESSION["email"] = $email;
    pushLog($name, $pas, $email);
    header("Location:/index.php");
    exit;
}
?>