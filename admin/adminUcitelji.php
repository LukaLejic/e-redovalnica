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
<a href="admin.php">Nazaj</a>

<?php
$result = mysqli_query($connect, "SELECT * FROM ucitelj");
echo "<table class='table'>";
echo "<thead>";
echo "<tr><th> Ime in priimek: </th><th><a href='adminUciteljDodaj.php'>Dodaj</a></th></tr>";
echo "</thead>";
echo "<tbody>";
while ($rows = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <th>
            <?php echo $rows['ime']. ' ' .$rows['priimek']?>
        </th>
        <th>
            <a style href="adminUciteljIzbrisi.php?ucitelj=<?php echo $rows['id_ucitelja'] ?>">Izbriši</a>
            <a href="adminUciteljUredi.php?ucitelj=<?php echo $rows['id_ucitelja'] ?>">Uredi</a>
            <a href="adminUciteljPredmeti.php?ucitelj=<?php echo $rows['id_ucitelja'] ?>">Predmeti</a>

        </th>
    </tr>
    <?php
}
echo "</tbody>";
echo "</table>";
?>
</body>
</html>