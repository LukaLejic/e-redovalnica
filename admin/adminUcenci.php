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
<link rel="stylesheet" href="../header.css">


<div class="kista">
    <header>
        <nav>
            <label class="logo"> </label>
            <a href="../index.php"> <img class="logo" src="../slike/logo1.jpg" alt="ne radi"> </a>
            <label class="logotip"></label>
            <ul>
                <li><a href="admin.php">NAZAJ</a></li>
                <li><a href="../logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>
<?php
$result = mysqli_query($connect, "SELECT * FROM ucenec");
echo "<table class='table'>";
echo "<thead>";
echo "<tr><th> Ime in priimek: </th><th></th><th></th><th><a href='adminUcenecDodaj.php'>Dodaj</a></th></tr>";
echo "</thead>";
echo "<tbody>";
while ($rows = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
        <th>
            <?php echo $rows['ime']. ' ' .$rows['priimek']?>
        </th>
        <th>
            <?php
            echo $rows['razred'];
            ?>
        </th>
        <th>
            <?php
            echo $rows['mail'];
            ?>
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
