<?php
//entry.php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

if(!isset($_SESSION["username"]))
{
    header("location:../index.php?action=login");

}
if($_SESSION['stopnja'] == 2){
    header("location:../ucitelj.php");
}
else if($_SESSION['stopnja'] == 1){
    header("location:../ucenec.php");
}
if (isset($_GET['ucitelj'])){
    $ucitelj = $_GET['ucitelj'];
}
if (isset ($_POST ['uredi'])) {
    $razred = mysqli_real_escape_string($connect, $_POST["razred"]);
    $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);
    $ime = mysqli_real_escape_string($connect, $_POST["ime"]);
    $priimek = mysqli_real_escape_string($connect, $_POST["priimek"]);
    // tu je treba za enkripcijo se zrihtat
    mysqli_query($connect, "UPDATE ucitelj SET ime = '$ime' ,priimek = '$priimek',mail = '$mail', password = '$password'  WHERE id_ucitelja = '$ucitelj'");
    header("location:adminUcitelji.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="adminUcitelji.php">Nazaj</a>
<a href="../logout.php">Odjava</a>
<h1>
    Urejanje učitelja
</h1>
<form method="post">
    <?php
    $result = mysqli_query($connect, "SELECT * FROM ucitelj WHERE id_ucitelja = '$ucitelj'");
    $result = mysqli_fetch_assoc($result);
    echo"<input type='text' name='ime' class='input-box' value='".$result['ime']."'>";
    echo"<input type='text' name='priimek' class='input-box' value='".$result['priimek']."'>";
    echo"<input type='email' name='mail' class='input-box' value='".$result['mail']."'>";
    echo"<input type='password' name='password' class='input-box' placeholder='Geslo' required>";
    ?>
    <button type="submit" name="uredi" class="submit-btn">Spremeni</button>

</form>
</body>
</html>
