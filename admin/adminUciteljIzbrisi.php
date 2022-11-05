<?php
session_start();
if (!isset($_SESSION["username"])) {

    header("location:../index.php?action=login");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:../ucitelj.php");
} else if ($_SESSION['stopnja'] == 1) {
    header("location:../ucenec.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
if (isset($_GET['ucitelj'])){
    $ucitelj = $_GET['ucitelj'];

}
try {
    mysqli_query($connect, "DELETE FROM ucitelj WHERE id_ucitelja = '$ucitelj'");

}catch (Exception $exception){
    echo '<script>alert("Napaka")</script>';
}
header("location:adminUcitelji.php");
?>
