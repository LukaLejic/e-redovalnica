<?php
//entry.php
session_start();
if (!isset($_SESSION["username"])) {
    echo($_SESSION["username"]);
    header("location:index.php?action=login");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:ucitelj.php");
} else if ($_SESSION['stopnja'] == 1) {
    header("location:ucenec.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
if (isset($_GET['ucenec'])){
    $ucenec = $_GET['ucenec'];
    $_SESSION['ucenec'] = $_GET['ucenec'];
}
try {
    mysqli_query($connect, "DELETE FROM ucenec WHERE id_ucenca = '$ucenec'");

}catch (Exception $exception){
    echo '<script>alert("Napaka")</script>';
}
header("location:adminPredmeti.php");
?>
