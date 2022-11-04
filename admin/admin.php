<?php
//entry.php
session_start();
if(!isset($_SESSION["username"]))
{
    echo($_SESSION["username"]);
    header("location:index.php?action=login");

}
if($_SESSION['stopnja'] == 2){
    header("location:ucitelj.php");
}
else if($_SESSION['stopnja'] == 1){
    header("location:ucenec.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

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
    <a href="adminPredmeti.php">Predmeti</a>
    <a href="adminUcenci.php">Učenci</a>
    <a href="adminUcitelji.php">Učitelj</a>
    <a href="adminRazred.php">Razred</a>

</body>
</html>
