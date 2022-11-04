<?php
//entry.php
session_start();
if (!isset($_SESSION["username"])) {
    echo($_SESSION["username"]);
    header("location:ucitelj.php");
    if ($_SESSION['stopnja'] == 2) {
        header("location:ucitelj.php");
    } else if ($_SESSION['stopnja'] == 3) {
        header("location:admin.php");
    }
}
if (isset($_SESSION['predmet'])) {
   $predmet = $_SESSION['predmet'];
}

$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");


if (isset ($_POST ['dodaj'])) {

    $ime_naloge = mysqli_real_escape_string($connect, $_POST["ime_naloge"]);
    $navodilo = mysqli_real_escape_string($connect, $_POST["navodilo"]);
    $rok_oddaje = mysqli_real_escape_string($connect, $_POST["rok_oddaje"]);

    mysqli_query($connect, "INSERT INTO naloga(naslov, navodilo, rok_oddaje, predmet, prikazan_naslov)VALUES('$ime_naloge', '$navodilo','$rok_oddaje','$predmet','$ime_naloge')");



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
<h1>Dodaj valuto</h1>
<form method="post">
    <div>
        <label>Ime naloge</label>
        <input type="text" name="ime_naloge" required/>
    </div>
    <div>
        <label>Navodilo</label>
        <textarea name="navodilo" rows="4" cols="50"></textarea>
    </div>
    <div>
        <label>Rok oddaje</label>
        <input type="datetime-local" name="rok_oddaje" required/>
    </div>
    <input type="submit" name="dodaj" value="Dodaj"/>
</form>

</body>
</html>
