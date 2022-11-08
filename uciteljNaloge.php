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

if (isset($_GET['naloga'])) {
    $id_naloge = $_GET['naloga'];
    $_SESSION['naloga'] = $_GET['naloga'];
}
if (isset($_SESSION['naloga'])) {
    $id_naloge = $_SESSION['naloga'];
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
    <title>Učenci</title>
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
                <li><a href="uciteljPredmeti.php">Nazaj</a></li>
                <li><a href="logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>

<?php

echo "<table class='table'>";
echo "<thead>";

echo "<tr>
        <th>Učenci:</th><th>Oddano:</th></tr>";
echo "</thead>";
echo "<tbody>";
$result = mysqli_query($connect, "SELECT * FROM predmet WHERE kratica_predmeta = '$predmet'");
$result = mysqli_fetch_assoc($result);
$result = $result['razred'];
$result1 = mysqli_query($connect, "SELECT * FROM ucenec WHERE razred = '$result'");
while ($rows = mysqli_fetch_assoc($result1)) {
    $id_ucenca = $rows['id_ucenca'];
    $result3 = mysqli_query($connect, "SELECT * FROM oddane_naloge WHERE id_ucenca = '$id_ucenca' AND id_naloge = '$id_naloge'");
    $result3 = mysqli_fetch_assoc($result3);
    ?>
    <tr>
        <th>
            <a href="uciteljUcenci.php?ucenec=<?php echo $rows['id_ucenca'] ?>"><?php echo $rows['ime'] . ' ' . $rows['priimek'] ?></a>
        </th>
        <th><?php if (!empty($result3)) {
                echo 'Oddano: ' . $result3['datum_oddaje'];
            } else {
                echo "Ni še oddano";
            } ?></th>
    </tr>
    <?php
}
echo "</tbody>";
?>
</table>
</body>
</html>
