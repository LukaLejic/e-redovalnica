<?php
//entry.php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

if (!isset($_SESSION["username"])) {
    echo($_SESSION["username"]);
    header("location:index.php?action=login");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:ucitelj.php");
} else if ($_SESSION['stopnja'] == 1) {
    header("location:ucenec.php");
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
<body><?php
echo "<table class='table'>";
echo "<thead>";

echo "<tr>
        <th>Predmeti</th><th></th></tr>";
echo "</thead>";
?>
<a href="adminPredmetiDodaj.php?naloga=<?php echo"" ?>">Dodaj predmet</a>
<?php
echo "<tbody>";
$result = mysqli_query($connect, "SELECT * FROM predmet");
while ($rows = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <th><?php echo $rows['kratica_predmeta'] ?></a></th>
        <th>
            <a href="adminPredmetiIzbrisi.php?predmet=<?php echo $rows['kratica_predmeta'] ?>">Izbriši</a>
            <a href="adminPredmetiUredi.php?predmet=<?php echo $rows['kratica_predmeta'] ?>">Uredi</a>
        </th>
    </tr>
    <?php
}
echo "</tbody>";
echo "</table>";
?>


</body>
</html>
