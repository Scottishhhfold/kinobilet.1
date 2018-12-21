<?php
session_start();
require_once "functions.php";
echo ' <a href="index.php">SeconTal</a> <br>';
header('Content-Type: text/html; charset=utf-8');
if(!isset($_SESSION["login"])) {
    echo '<a href="reg.php">Зареєструватись</a> ';
    echo '<a href="log.php">Вхід</a> ';
}else {
    echo 'Привіт, ' . $_SESSION["login"];
    echo ' <a href="exit.php">Вихiд</a> ';
    if ($_SESSION["priv"]) {
        echo '<a href="cabinetprobavca.php">Особистий кабінет</a> ';
    } else {
        echo '<a href="cabinetpocupca.php">Особистий кабінет</a> ';
    }
}
$ind = "0";
if (isset($_GET["tov"])) {
    $ind = $_GET["tov"];
} else {
    header("Location:/index.php");
    exit;
}
$m = getTovarId($ind);
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
    $img = explode(" ", $m[0]['foto']);
    //print_r($img);
    $st = "upload/";
    for ($i = 0; $i < count($img); $i++) {
        echo "<img src='" . $st . $img[$i] . "'><br>";
    }
    echo "<p>Вартість " . $m[0]['cina'] . " грн</p>";
    echo "<p><h3>Опис</h3> " . $m[0]['opus'] . "</p>";

    ?>
    <form action="" method="post" name="buy">
        <input type="text" name="buyr" value="<?php echo $ind ?>" hidden><br>
        <input type="submit" name="submit" value="Додати в кошик"><br>
    </form>
    </body>
    </html>
<?php
if(isset($_POST["submit"])) {
    if(isset($_SESSION["id"])){
        $buyid = $_POST["buyr"];
        pushBuy($_SESSION["id"],$buyid);}
    else{
        header("Location:/log.php");
        exit;
    }
}