<?php
//entry.php
session_start();
if(!isset($_SESSION["username"]))
{
    header("location:../index.php?action=login");

}
if($_SESSION['stopnja'] == 2){
    header("location:../ucitelj.php");
}
else if($_SESSION['stopnja'] == 1){
    header("location:../ucenec.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

if (isset ($_POST ['dodaj'])) {
    $ime_predmeta = mysqli_real_escape_string($connect, $_POST["ime_predmeta"]);
    $vrednost_valute = mysqli_real_escape_string($connect, $_POST["razred"]);

    mysqli_query($connect, "INSERT INTO predmet(kratica_predmeta, razred) VALUES('$ime_predmeta', '$vrednost_valute')");
 header("location:adminPredmeti.php");
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
<h1>
    Dodaj predmet
</h1>
<form method="post">
    <label>Ime predmeta</label>
    <input type="text" name="ime_predmeta"required/>
    <select name="razred" class="input-box">
        <?php
        $razred = mysqli_query($connect, "SELECT kratica_razreda FROM razred");
        while ($rows = mysqli_fetch_assoc($razred)) {
            echo "<label>".$rows['kratica_razreda']."</label>";
            echo "<option value='".$rows['kratica_razreda']."' required>".$rows['kratica_razreda']."</option>";
        }
        ?>
    </select>
    <input type="submit" name="dodaj" value="dodaj" />
</form>

</body>
</html>