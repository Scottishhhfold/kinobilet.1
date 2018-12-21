<?php
session_start();
require_once "functions.php";
header('Content-Type: text/html; charset=utf-8');
$m=getKinoAll();
echo ' <a href="index.php">Kino-Bilet</a> <br>';
echo ' <a href="sydbbron.php">Bron</a> <br>';
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
for($i=0;$i<count($m);$i++) {
    $st = "redag.php?id=" . $m[$i]["id"];
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