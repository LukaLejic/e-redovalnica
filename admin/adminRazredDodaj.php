<?php
//entry.php
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
if (isset($_GET['ucenec'])) {
    $ucenec = $_GET['ucenec'];
}
if (isset ($_POST ['uredi'])) {
    $razred = mysqli_real_escape_string($connect, $_POST["razred"]);
    try {

        mysqli_query($connect, "INSERT INTO razred(kratica_razreda) VALUES ('$razred')");
        header("location:adminRazred.php");
    }catch(Exception $exception){
        echo"<script>alert('Razred že obstaja')</script>";
    }

}
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
<a href="adminRazred.php">Nazaj</a>
<a href="../logout.php">Odjava</a><br>
<h1>
    Dodaj razred
</h1>
<form action="" method="post">
    <?php

    echo "<input type='text' name='razred' class='input-box' value='' placeholder='Ime'>";

    ?>
    <button type="submit" name="uredi" class="submit-btn">Spremeni</button>

</form>
</body>
</html>
