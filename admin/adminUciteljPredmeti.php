<?php
//entry.php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

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
if(isset($_SESSION['ucitelj'])){
    $ucitelj = $_SESSION['ucitelj'];
}
if (isset($_GET['ucitelj'])){
    $ucitelj = $_GET['ucitelj'];
    $_SESSION['ucitelj'] = $_GET['ucitelj'];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Predmeti</title>
    <link rel="stylesheet" href="../tabela.css"/>
    <link rel="stylesheet" href="../header.css"/>
</head>
<body>

<div class="kista">
    <header>
        <nav>
            <label class="logo"> </label>
            <a href="../index.php"> <img class="logo" src="../slike/logo1.jpg" alt="ne radi"> </a>
            <label class="logotip"></label>
            <ul>
                <li><a href="adminUcitelji.php">NAZAJ</a></li>
                <li><a href="../logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>
<?php
$result = mysqli_query($connect, "SELECT * FROM ucitelj WHERE id_ucitelja = '$ucitelj'");
$result = mysqli_fetch_assoc($result);
echo "<table class='table'>";
echo "<thead>";
echo "<tr><th> Predmeti katere uči ".$result['ime'] .' '.$result['priimek'].": </th><th><a href='adminUciteljPredmetiDodaj.php?ucitelj=". $ucitelj ."'>Dodaj</a>
</th></tr>";
echo "</thead>";
echo "<tbody>";
$result1 = mysqli_query($connect, "SELECT * FROM ucitelj_predmet WHERE id_ucitelja = '$ucitelj'");
while ($rows = mysqli_fetch_assoc($result1)) {
    ?>
    <tr>
        <th>
            <?php echo $rows['kratica_predmeta'] ?>
        </th>
        <th>
            <a href="adminUciteljPredmetIzbrisi.php?predmet=<?php echo $rows['kratica_predmeta']?>">Odstani</a>

        </th>
    </tr>
    <?php
}
echo "</tbody>";
echo "</table>";
?>
</body>
</html>
