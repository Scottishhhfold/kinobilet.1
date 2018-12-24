<?php
session_start();
require_once "functions.php";
echo ' <a href="index.php">Kino-Bilet</a> <br>';
echo ' <a href="sybdkino.php">Kino</a> <br>';
echo ' <a href="sydbbron.php">Bron</a> <br>';
header('Content-Type: text/html; charset=utf-8');
$ind = "0";
if (isset($_GET["id"])) {
    $ind = $_GET["id"];
} else {
    header("Location:/index.php");
    exit;
}
$md=getBronId($ind);
$mf=getKinoId($ind);
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
        echo "<p> ".$mf[0]['name']."</p>";

        for($i=0;$i<count($md);$i++) {
            echo " <div class='tov'>";
            echo "Прізвище Ім'я ".$md[$i]["name"]."<br>";
            echo "Номер телефону ".$md[$i]["phone"]."<br>";
            echo "Місце " .$md[$i]["misce"]."<br>";
            echo "</div> ";
        }
        ?>
        <br>
        <form action="" method="post" name="buy">
        <input type="text" name="buyr" value="<?php echo $ind ?>" hidden><br>
        <input type="submit" name="submit" value="Видалити дані"><br>
    </form>
    </body>
    </html>
<?php
if(isset($_POST["submit"])) {
    $misce="";
    for ($i = 0; $i < 50; $i++)
        if ($i == 49) $misce .= "0";
        else $misce .= "0 ";
    upKinoMisce($ind, $misce);
    delBron($ind);
    header("Location:/pbr.php?id=" . $ind);
    exit;
}
?>