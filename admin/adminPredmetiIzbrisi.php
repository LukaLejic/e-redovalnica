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
if (isset($_GET['predmet'])){
    $predmet = $_GET['predmet'];
    $_SESSION['predmet'] = $_GET['predmet'];
}
try {
    mysqli_query($connect, "DELETE FROM predmet WHERE kratica_predmeta = '$predmet'");

}catch (Exception $exception){
    echo '<script>alert("Predmet je v uporabi")</script>';
}
header("location:adminPredmeti.php");
?>


