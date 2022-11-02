<?php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
$path = $_GET['file'];
unlink('nalogeUcencev/' . $path);
mysqli_query($connect, "DELETE FROM oddane_datoteke WHERE filename = '$path'");
header("location:ucenecNaloge.php?predmet=" . $_SESSION['predmet'] . "&naloga=" . $_SESSION['naloga']);
?>