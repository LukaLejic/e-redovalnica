<?php
session_start();
if (isset($_GET['predmet'])) {
    $predmet = $_GET['predmet'];
} else {
    header("location:ucenec.php");
}
if (!isset($_SESSION["username"])) {

    header("location:index.php");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:ucitelj.php");
} else if ($_SESSION['stopnja'] == 3) {
    header("location:admin.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");


?>
<!doctype html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php

$result = mysqli_query($connect, "SELECT prikazan_naslov FROM naloga WHERE predmet = '$predmet'");

while ($row = $result->fetch_assoc()){
    echo'<a href="ucenecNaloge.php?predmet='.$predmet.'&naloga='.$row['prikazan_naslov'].'">'.$row['prikazan_naslov'].'</a><br/>';

}
?>



</body>
</html>