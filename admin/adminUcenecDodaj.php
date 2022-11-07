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
if (isset($_GET['ucenec'])){
    $ucenec = $_GET['ucenec'];
}
if (isset ($_POST ['uredi'])) {
    $razred = mysqli_real_escape_string($connect, $_POST["razred"]);
    $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);
    $ime = mysqli_real_escape_string($connect, $_POST["ime"]);
    $priimek = mysqli_real_escape_string($connect, $_POST["priimek"]);

    mysqli_query($connect, "INSERT INTO ucenec(razred, ime, priimek, mail, password) VALUES ('$razred','$ime','$priimek','$mail','$password')");
    header("location:adminUcenci.php");
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
<link rel="stylesheet" href="../header.css">
<link rel="stylesheet" href="../tabela.css">

<div class="kista">
    <header>
        <nav>
            <label class="logo"> </label>
            <a href="../index.php"> <img class="logo" src="../slike/logo1.jpg" alt="ne radi"> </a>
            <label class="logotip"></label>
            <ul>
                <li><a href="adminUcenci.php">NAZAJ</a></li>
                <li><a href="../logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>
<h1>
    Dodaj učenca
</h1>
<form action="" method="post">
    <?php

    echo"<input type='text' name='ime' class='input-box' value='' placeholder='Ime'>";
    echo"<input type='text' name='priimek' class='input-box' value='' placeholder='Priimek'>";

    echo "<select name='razred' class='input-box'>";

    $razred = mysqli_query($connect, "SELECT kratica_razreda FROM razred");
    while ($rows = mysqli_fetch_assoc($razred)) {
        echo "<label>" . $rows['kratica_razreda'] . "</label>";
        echo "<option value='". $rows['kratica_razreda'] ."'>" . $rows['kratica_razreda'] . "</option>";
    }

    echo"</select>";
    echo"<input type='email' name='mail' class='input-box' value='' placeholder='E-mail'>";
    echo"<input type='password' name='password' class='input-box' placeholder='Geslo' required>";
    ?>
    <button type="submit" name="uredi" class="submit-btn">DODAJ</button>

</form>
</body>
</html>
