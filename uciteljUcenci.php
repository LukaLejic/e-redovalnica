<?php
//entry.php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
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

if (isset($_GET['ucenec'])){
    $id_ucenca = $_GET['ucenec'];
    $_SESSION['ucenec'] = $_GET['ucenec'];
}
if (isset($_SESSION['naloga'])){
    $id_naloge = $_SESSION['naloga'];
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oddane naloge</title>
    <link rel="stylesheet" href="tabela.css"/>

</head>
<body>
<a href="uciteljNaloge.php">Nazaj</a>
<?php

$result = mysqli_query($connect, "SELECT * FROM ucenec WHERE id_ucenca = '$id_ucenca'");
$result = mysqli_fetch_assoc($result);
$result1 = mysqli_query($connect, "SELECT * FROM naloga WHERE id_naloge = '$id_naloge'");
$result1 = mysqli_fetch_assoc($result1);
$query2 = "SELECT * FROM oddane_datoteke WHERE predmet = '$predmet' AND Id_dijaka = '$id_ucenca' AND id_naloge = '$id_naloge'";
$downloads = mysqli_query($connect, $query2);
echo "<table class='table'>";
    echo "<thead>";

    echo "<tr>
        <th>Pri nalogi ". $result1['prikazan_naslov'].' je '.$result['ime'].' '.$result['priimek']." oddal:</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($rows = mysqli_fetch_assoc($downloads)) {
    ?>
    <tr>
        <th><a href="download.php?file=<?php echo $rows['filename'] ?>"><?php echo $rows['filename'] ?></a></th>
    </tr>
    <?php
}
echo "</tbody>";
?>
</table>
</body>
</html>

