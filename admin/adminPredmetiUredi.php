<?php
//entry.php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

if (!isset($_SESSION["username"])) {

    header("location:../index.php?action=login");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:../ucitelj.php");
} else if ($_SESSION['stopnja'] == 1) {
    header("location:../ucenec.php");
}
if (isset($_GET['predmet'])){
    $predmet = $_GET['predmet'];
}

if (isset ($_POST ['dodaj'])) {
    $razred = mysqli_real_escape_string($connect, $_POST["razred"]);

    mysqli_query($connect, "UPDATE predmet SET razred = '$razred' WHERE kratica_predmeta = '$predmet'");
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
<link rel="stylesheet" href="../header.css">
<link rel="stylesheet" href="../tabela.css">

<div class="kista">
    <header>
        <nav>
            <label class="logo"> </label>
            <a href="../index.php"> <img class="logo" src="../slike/logo1.jpg" alt="ne radi"> </a>
            <label class="logotip"></label>
            <ul>
                <li><a href="adminPredmeti.php">NAZAJ</a></li>
                <li><a href="../logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>
<h1>

    Uredi predmet <?php echo $predmet ?>
</h1>
<form method="post">
    <select name="razred" class="input-box">
        <?php
        $razred = mysqli_query($connect, "SELECT kratica_razreda FROM razred");
        while ($rows = mysqli_fetch_assoc($razred)) {
            echo "<label>".$rows['kratica_razreda']."</label>";
            echo "<option value='".$rows['kratica_razreda']."' required>".$rows['kratica_razreda']."</option>";
        }
        ?>
    </select>
    <input type="submit" name="dodaj" value="Uredi" />
</form>

</body>
</html>
