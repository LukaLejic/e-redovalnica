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
if (isset($_GET['ucitelj'])){
    $ucitelj = $_GET['ucitelj'];
}
if (isset ($_POST ['dodaj'])) {
    $predmet = mysqli_real_escape_string($connect, $_POST["predmet"]);
    // tu je treba za enkripcijo se zrihtat
    mysqli_query($connect, "INSERT INTO ucitelj_predmet(id_ucitelja, kratica_predmeta) VALUES ('$ucitelj','$predmet')");
    header("location:adminUciteljPredmeti.php");
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
<a href="adminUciteljPredmeti.php">Nazaj</a><br>
<h1>
    Dodaj predmet
</h1>
<form method="post">
    <select name="predmet" class="input-box">
        <?php

        $razred = mysqli_query($connect, "SELECT * FROM predmet");
        while ($rows = mysqli_fetch_assoc($razred)) {
            echo "<label>" . $rows['kratica_predmeta'] . "</label>";
            echo "<option value='" . $rows['kratica_predmeta'] . "'>" . $rows['kratica_predmeta'] . "</option>";
        }

        ?>

    </select>
    <button type="submit" name="dodaj" class="submit-btn">Spremeni</button>
</form>
</body>
</html>
