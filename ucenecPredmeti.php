<?php
session_start();
if (isset($_GET['predmet'])) {
    $predmet = $_GET['predmet'];
} else {
    header("location:ucenec.php");
}
if (!isset($_SESSION["username"])) {

    header("location:index.php");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:ucitelj.php");
} else if ($_SESSION['stopnja'] == 3) {
    header("location:admin.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");


?>
<!doctype html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="tabela.css"/>
</head>
<body>
<a href="logout.php">Odjava</a>
<?php
echo "<table class='table'>";
$result = mysqli_query($connect, "SELECT prikazan_naslov,id_naloge FROM naloga WHERE predmet = '$predmet'");
echo "<thead><tr><th>Naloge predmeta - $predmet</th></tr><thead>";
echo "<tbody>";
while ($row = $result->fetch_assoc()){


    echo"<tr>";
    echo"<th><a href='ucenecNaloge.php?predmet=".$predmet."&naloga=".$row["id_naloge"]."'>".$row['prikazan_naslov'].'</a></th>';
    echo"</tr>";


}
echo "</tbody>";
?>
</table>


</body>
</html>