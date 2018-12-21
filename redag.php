<?php
session_start();
require_once "functions.php";
header('Content-Type: text/html; charset=utf-8');
$i=$_GET["id"];
$m=getKinoId($i);
echo ' <a href="index.php">Kino-Bilet</a> <br>';
$f=$m[1]["name"];
echo $f;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<form enctype="multipart/form-data" action="" method="POST" class="reg">
    Назва<br>
    <input type="text" name="name" required minlength="2" value=<?php echo $m[0]["name"]?> ><br>
    Опис<br>
    <textarea name="opus" required cols="40" rows="3"><?php echo $m[0]["opus"]?></textarea><br>
    Ціна<br>
    <input type="text" name="price" required minlength="2" value=<?php echo $m[0]["price"]?>><br>
    Фото<br>
    <input name="userfile1" type="file" /><br/>
    <input type="submit" name="submit1" value="Додати"><br>
    <input type="submit" name="submit2" value="Редагувати"><br>
    <input type="submit" name="submit3" value="Видалити"><br>
</form>
</body>
</html>
<?php
if(isset($_POST["submit1"])) {
    $name = $_POST["name"];
    $opus = $_POST["opus"];
    $price = $_POST["price"];
    $foto = "";
    if (!is_dir('upload/')) mkdir('upload/');
    $uploaddir = "upload/";
    $uploadfile = basename($_FILES['userfile1']['name']);
    if ($uploadfile != "") {
        $foto = $uploadfile;
        $uploadfile = $uploaddir . basename($_FILES['userfile1']['name']);
        move_uploaded_file($_FILES['userfile1']['tmp_name'], $uploadfile);
    }
    if ($foto == "") $foto = $m[0]["foto"];
    addKino($name, $opus, $price, $foto);
    header("Location:/sybdkino.php");
    exit;
}
if(isset($_POST["submit2"])) {
    $name = $_POST["name"];
    $opus = $_POST["opus"];
    $price = $_POST["price"];
    $foto = "";
    if (!is_dir('upload/')) mkdir('upload/');
    $uploaddir = "upload/";
    $uploadfile = basename($_FILES['userfile1']['name']);
    if ($uploadfile != "") {
        $foto = $uploadfile;
        $uploadfile = $uploaddir . basename($_FILES['userfile1']['name']);
        move_uploaded_file($_FILES['userfile1']['tmp_name'], $uploadfile);
    }
    if ($foto == "") $foto = $m[0]["foto"];
    upKino($m[0]["id"], $name, $opus, $price, $foto);
    header("Location:/sybdkino.php");
    exit;
}
if(isset($_POST["submit3"])) {

    $id = $_SESSION["id"];
    delKino($m[0]["id"]);
    header("Location:/sybdkino.php");
    exit;
}
?>
