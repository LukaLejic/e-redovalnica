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
    <title>Učenci</title>
    <link rel="stylesheet" href="../tabela.css"/>

</head>
<body>
<?php
$result = mysqli_query($connect, "SELECT * FROM ucenec");
echo "<table class='table'>";
echo "<thead>";
echo "<tr><th> Ime in priimek: </th><th></tr>";
echo "</thead>";
echo "<tbody>";
while ($rows = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <th>
            <?php echo $rows['ime']. ' ' .$rows['priimek']?>
        </th>
        <th>
            <a href="adminUcenecIzbrisi.php?ucenec=<?php echo $rows['id_ucenca'] ?>">Izbriši</a>
            <a href="adminUcenecUredi.php?ucenec=<?php echo $rows['id_ucenca'] ?>">Uredi</a>
        </th>
    </tr>
    <?php
}
echo "</tbody>";
echo "</table>";
?>
</body>
</html>
