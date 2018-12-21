<?php
$mysqli=false;
function connectDB()
{
    global $mysqli;
    $mysqli= new mysqli("localhost","root","","kinobilet");
    $mysqli->query("SET NAMES 'utf8';");
    $mysqli->query("SET CHARACTER SET 'utf8';");
    $mysqli->query("SET SESSION collation_connection = 'utf8_general_ci';");
}
function closeDB()
{
    global $mysqli;
    $mysqli->close();
}
function getLog()
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `login`");
    closeDB();
    return resultToArray($result);
}

function getLog1($id)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `login` WHERE `id`=$id");
    closeDB();
    return resultToArray($result);
}
function pushLog($login,$pass,$email){
    global $mysqli;
    connectDB();
    $mysqli->query("INSERT INTO `kinobilet`.`login` (`id`, `name`, `password`, `email`) VALUES (NULL, '$login', '$pass', '$email');");
    closeDB();
}
function getKinoAll()
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `kino`;");
    closeDB();
    return resultToArray($result);
}
function getKinoId($id)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `kino` WHERE `id` = '$id';");
    closeDB();
    return resultToArray($result);
}
function addKino($name,$opus,$cina,$foto="",$misce = "")
{
    for ($i = 0; $i < 50; $i++) {
        if ($i == 49) $misce .= "0";
        else $misce .= "0 ";
    }
    global $mysqli;
    connectDB();
    $mysqli->query("INSERT INTO `kino` (`id`, `name`, `opus`, `price`, `foto`, `misce` ) VALUES (NULL, '$name', '$opus', '$cina', '$foto','$misce');");
    closeDB();
}
function upKino($id,$name,$opus,$cina,$foto="")
{
    global $mysqli;
    connectDB();
    $mysqli->query("UPDATE `kino` SET `name` = '$name',`opus` = '$opus',`price` = '$cina',`foto` = '$foto' WHERE `id` ='$id';");
    closeDB();
}
function upKinoMisce($id,$misce = "")
{
    if ($misce == "")
        for ($i = 0; $i < 50; $i++)
            if ($i == 49) $misce .= "0";
            else $misce .= "0 ";
    global $mysqli;
    connectDB();
    $mysqli->query("UPDATE `kino` SET `misce` = '$misce' WHERE `id` ='$id';");
    closeDB();
}
function delKino($id)
{
    global $mysqli;
    connectDB();
    $mysqli->query("DELETE FROM `kino` WHERE `id` ='$id';");
    closeDB();
}
function getBronId($id)
{
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `bron` WHERE `idkino` = '$id';");
    closeDB();
    return resultToArray($result);
}
function pushBron($idkino,$misce,$name,$phone)
{
    global $mysqli;
    connectDB();
    $mysqli->query("INSERT INTO `bron` (`id`, `idkino`, `misce`, `name`, `phone`) VALUES (NULL, '$idkino', '$misce', '$name', '$phone');");
    closeDB();
}
function delBron($id)
{
    global $mysqli;
    connectDB();
    $mysqli->query("DELETE FROM `bron` WHERE `idkino` = '$id';");
    closeDB();
}
function resultToArray($result)
{
    $array = array();
    while (($row = $result->fetch_assoc()) != false)
        $array[] = $row;
    return $array;
}
?>