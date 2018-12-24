<?php
session_start();
require_once "functions.php";
echo ' <a href="index.php">Kino-Bilet</a> <br>';
header('Content-Type: text/html; charset=utf-8');
$m=getKinoAll();
if(!isset($_SESSION["login"])) {
    echo '<a href="reg.php">Зареєструватись</a> ';
    echo '<a href="log.php">Вхід</a> ';
}else {
    echo 'Привіт, ' . $_SESSION["login"];
    echo ' <a href="exit.php">Вихiд</a> ';
}
?>
<!doctype html>
<head>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <title>Document</title>
</head>
<body>
<?php
for($i=0;$i<count($m);$i++) {
    $st = "detalkino.php?id=" . $m[$i]["id"];
    echo "<a href=$st><div class='tov'>";
    $std = "upload/";
    echo "<img src='" . $std . $m[$i]['foto'] . "'><br>";
    echo "<h2>" . $m[$i]['name'] . "</h2>";
    echo "<p>Вартість " . $m[$i]['price'] . " грн</p>";
    echo "</div></a>";
}
?>
</body>
</html>
