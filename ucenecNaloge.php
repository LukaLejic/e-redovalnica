<?php
session_start();
if (isset($_GET['predmet'])) {
    $predmet = $_GET['predmet'];

} else {
    header("location:ucenec.php");
}
if (isset($_GET['naloga'])) {
    $naloga = $_GET['naloga'];
    echo $naloga;
}else{
    header("location:ucenecPredmeti.php?predmet='$predmet'");
}
if (!isset($_SESSION["username"])) {
    echo($_SESSION["username"]);
    header("location:ucitelj.php");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:ucitelj.php");
} else if ($_SESSION['stopnja'] == 3) {
    header("location:admin.php");
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
<?php
    $result = mysqli_query($connect, "SELECT * FROM naloga WHERE prikazan_naslov = '$naloga'");
    $result = mysqli_fetch_assoc($result);
    echo $result['naslov'];
    echo $result['navodilo'];
    echo $result['rok_oddaje'];
?>
</body>
</html>