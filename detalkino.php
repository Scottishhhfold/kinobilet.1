<?php
session_start();
require_once "functions.php";
echo ' <a href="index.php">Kino-Bilet</a> <br>';
header('Content-Type: text/html; charset=utf-8');
if(!isset($_SESSION["login"])) {
    echo '<a href="reg.php">Зареєструватись</a> ';
    echo '<a href="log.php">Вхід</a> ';
}else {
    echo 'Привіт, ' . $_SESSION["login"];
    echo ' <a href="exit.php">Вихiд</a> ';
}
$ind = "0";
if (isset($_GET["id"])) {
    $ind = $_GET["id"];
} else {
    header("Location:/index.php");
    exit;
}
$m=getKinoId($ind);
//print_r($m);
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <body>
    <?php
    echo "<h2>" . $m[0]['name'] . "</h2>";
    $std = "upload/";
    echo "<img src='" . $std . $m[0]['foto'] . "' class='im' ><br>";
    echo "<p>Вартість " . $m[0]['price'] . " грн</p>";
    echo "<p><h3>Опис</h3> " . $m[0]['opus'] . "</p>";
    ?>
    <form action="" method="post" name="buy">
        <input type="text" name="buyr" value="<?php echo $ind ?>" hidden><br>
        <input type="submit" name="submit" value="Бронювати"><br>
    </form>
    </body>
    </html>
<?php
if(isset($_POST["submit"])) {
    if (isset($_SESSION["id"])) {
        $id=$_SESSION["id"];
        header("Location:/bron.php?id=" .$ind);
        exit;//exit
    } else {
        header("Location:/log.php");
        exit;
    }
}
?>