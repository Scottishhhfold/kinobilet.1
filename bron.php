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
$md=getKinoId($ind);
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
    echo "<p> ".$md[0]['name']."</p>";
    for($i=0;$i<50;$i++)
    {
        if($i%10==0)echo " <div class='cl'></div> ";
        if($mis[$i]==0){
        echo "<div class='bf'> ";
        echo '<input type="checkbox" name="b1[]" value="'.$i.'">';}
        else{
            echo "<div class='bf1'> ";
        }
        echo "</div> ";
    }
    ?>
    <br><br>
        Прізвище Ім'я
        <input type="text" name="name1" required><br>
        Номер телефону
        <input type="text" name="name2" required><br>
        Вартість 1 білету <?php echo $md[0]['price']?> грн.
        <br>
        <input type="text" name="buyr" value="<?php echo $ind ?>" hidden><br>
        <input type="submit" name="submit" value="Бронювати"><br>
    </form>
    </body>
    </html>
<?php
if(isset($_POST["submit"])) {
    $b1 = $_POST['b1'];
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
    header("Location:/bron.php?id=" . $ind);
    exit;
}
?>