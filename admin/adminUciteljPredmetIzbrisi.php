<?php
//entry.php
session_start();
if ($_SESSION['stopnja'] == 2) {
    header("location:../ucitelj.php");
} else if ($_SESSION['stopnja'] == 1) {
    header("location:../ucenec.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
if (isset($_SESSION['ucitelj'])) {
    $ucitelj = $_SESSION['ucitelj'];
}
if (isset($_GET['predmet'])) {
    $predmet = $_GET['predmet'];
    echo $predmet;
}
try {
    mysqli_query($connect, "DELETE FROM ucitelj_predmet WHERE kratica_predmeta = '$predmet' AND id_ucitelja = '$ucitelj'");

} catch (Exception $exception) {
    echo '<script>alert("Napaka")</script>';
}
header("location:adminUciteljPredmeti.php");
?>

