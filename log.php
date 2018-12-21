<?php
session_start();
require_once "functions.php";
$lg=getLog();
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
    <input type="submit" name="submit" value="Вхід"><br>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])) {
    $name = $_POST["login"];
    $pas = $_POST["pas"];
    $j = 0;
    $tr = false;
    $k = count($lg);
    for ($i = 0; $i < $k; $i++) {
        if ($lg[$i]["name"] == $name && $lg[$i]["password"] == $pas) {
            $tr = true;
            $j = $i;
            break;
        }
    }
    if ($tr) {
        $id = $lg[$j]["id"];
        $email = $lg[$j]["email"];
        $_SESSION["login"] = $name;
        $_SESSION["pass"] = $pas;
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $id;
        header("Location:/index.php");
        exit;
    } else {
        echo "<br> Невірний логін чи пароль.<br>";
        echo '<a href="reg.php">Зареєструватись</a> ';
    }
}
?>