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
if (isset($_GET['predmet'])) {
    $predmet = $_GET['predmet'];
    $_SESSION['predmet'] = $_GET['predmet'];
}
if (isset($_SESSION['predmet'])) {
    $predmet = $_SESSION['predmet'];
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Naloge</title>
    <link rel="stylesheet" href="tabela.css"/>
    <link rel="stylesheet" href="header.css">
</head>
<body>

<div class="kista">
    <header>
        <nav>
            <label class="logo"> </label>
            <a href="index.php"> <img class="logo" src="slike/logo1.jpg" alt="ne radi"> </a>
            <label class="logotip"></label>
            <ul>
                <li><a href="ucitelj.php">NAZAJ</a></li>
                <li><a href="logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>



<?php
$result = mysqli_query($connect, "SELECT * FROM naloga WHERE predmet = '$predmet'");

echo "<table class='table'>";
echo "<thead>";

echo "<tr>
<th>Naloge:</th><th><a href='uciteljDodajNalogo.php'>Dodaj nalogo</a></th></tr>";
echo "</thead>";
echo "<tbody>";
while ($rows = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <th><a href="uciteljNaloge.php?naloga=<?php echo $rows['id_naloge'] ?>"><?php echo $rows['naslov'] ?></a></th>
        <th><?php echo $rows['rok_oddaje'] ?></th>
    </tr>
    <?php
}
echo "</tbody>";
?>
</table>
<?php
$result = mysqli_query($connect, "SELECT * FROM gradivo WHERE predmet = '$predmet'");

echo "<table class='table'>";
echo "<thead>";

echo "<tr>
<th>Gradivo:</th><th><a href='uciteljDodajGradivo.php'>Dodaj gradivo</a></th></tr>";
echo "</thead>";
echo "<tbody>";
while ($rows = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <th><a href="downloadGradivo.php?file=<?php echo $rows['filename'] ?>"><?php echo $rows['filename'] ?></a></th>
        <th><a href="deleteGradivo.php?file=<?php echo $rows['filename'] ?>">Izbriši</a></th>
    </tr>


    <?php
}
echo "</tbody>";
?>
</table>

</body>
</html>
