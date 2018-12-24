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
$b1=0;
if (isset($_GET["id"])&&isset($_GET["m"])) {
    $ind = $_GET["id"];
    $b1=explode(",", $_GET["m"]);
} else {
    header("Location:/index.php");
    exit;
}
//print_r($m);

$md=getKinoId($ind);
$ci=$md[0]['price'];
$sum=count($b1)*$ci;
//print_r($md);
$mis = explode(" ", $md[0]['misce']);
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <body>
    <form action="" method="post" name="buy">
        <?php
        $s="";
        for($i=0;$i<count($b1);$i++)
            $s.=$b1[$i]." ";
        echo "Місце(я) : ".$s;
        ?>
       <br>
        Прізвище Ім'я
        <input type="text" name="name1" required minlength="6" pattern="^[А-Яа-яІі\s]+$"><br>
        Номер телефону +380
        <input type="text" name="name2" required minlength="9" maxlength="9" pattern="[0-9]{9}"><br>
        Вартість білету(ів) <?php echo $sum ?> грн.
        <br>
        <input type="text" name="buyr" value="<?php echo $ind ?>" hidden><br>
        <input type="submit" name="submit" value="Бронювати"><br>
    </form>
    </body>
    </html>
<?php
if(isset($_POST["submit"])) {
    $name = $_POST['name1'];
    $phone = $_POST['name2'];
    $b2 = "";
    for ($i = 0; $i < count($b1); $i++) {
        $mis[$b1[$i]] = 1;
        if ($i == count($b1) - 1)
            $b2 .= $b1[$i];
        else
            $b2 .= $b1[$i] . " ";
    }
    $sf = "";
    for ($i = 0; $i < count($mis); $i++)
        if ($i == 49)
            $sf .= $mis[$i];
        else $sf .= $mis[$i] . " ";
    upKinoMisce($ind, $sf);
    pushBron($ind, $b2, $name, $phone);
    header("Location:/index.php");
    exit;
}
?>