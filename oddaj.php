<?php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
$naloga = $_GET['naloga'];
$id = $_SESSION['id'];

mysqli_query($connect, "INSERT INTO oddane_naloge(id_naloge, id_ucenca) VALUES ('$naloga','$id')");

header("location:ucenecNaloge.php?predmet=" . $_SESSION['predmet'] . "&naloga=" . $_SESSION['naloga']);

?>
