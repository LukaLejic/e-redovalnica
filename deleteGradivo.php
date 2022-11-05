<?php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
$path = $_GET['file'];
unlink('gradivo/' . $path);
mysqli_query($connect, "DELETE FROM gradivo WHERE filename = '$path'");
header("location:uciteljPredmeti.php");
?>
