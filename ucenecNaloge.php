<?php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");


if (isset($_GET['predmet'])) {
    $predmet = $_GET['predmet'];
    $_SESSION['predmet'] = $_GET['predmet'];

} else {
    header("location:ucenec.php");
}
if (isset($_GET['naloga'])) {
    $naloga = $_GET['naloga'];
    $_SESSION['naloga'] = $_GET['naloga'];
} else {
    header("location:ucenecPredmeti.php?predmet='$predmet'");
}
if (!isset($_SESSION["username"])) {
    echo($_SESSION["username"]);
    header("location:ucitelj.php");

}
$id = $_SESSION['id'];

$zaklenjeno = mysqli_query($connect, "SELECT * FROM oddane_naloge WHERE  id_naloge = '$naloga' AND id_ucenca = '$id'");
$zaklenjeno = mysqli_fetch_assoc($zaklenjeno);
if (empty($zaklenjeno)) {
    $zaklenjeno = false;
} else {
    $zaklenjeno = true;
}

if ($_SESSION['stopnja'] == 2) {
    header("location:ucitelj.php");
} else if ($_SESSION['stopnja'] == 3) {
    header("location:admin.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Naloga</title>
    <link rel="stylesheet" href="tabela.css"/>
    <link rel="stylesheet" href="header.css"/>

</head>
<body>
<div class="kista">
    <header>
        <nav>
            <label class="logo"> </label>
            <a href="index.php"> <img class="logo" src="slike/logo1.jpg" alt="ne radi"> </a>
            <label class="logotip"></label>
            <ul>
                <li><a href="ucenecPredmeti.php">NAZAJ</a></li>
                <li><a href="logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>

<?php
$result = mysqli_query($connect, "SELECT * FROM naloga WHERE id_naloge = '$naloga'");
$result1 = mysqli_query($connect, "SELECT * FROM oddane_naloge WHERE id_naloge = '$naloga' AND id_ucenca = '$id'");
$result = mysqli_fetch_assoc($result);
$result1 = mysqli_fetch_assoc($result1);
echo "<h1 class='poravnava'>" . $result['naslov'] . "</h1>";
echo "<h4 class='poravnava'>" . $result['navodilo'] . "</h4>";
if (!$zaklenjeno) {
    ?>
    <form class='poravnava' action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="shrani"  class="submit-btn">Izberi datoteko</label>
        <input class="submit-btn" id= "shrani" type="file" name="file" style="visibility:hidden"></br>
            <input type="submit"  name="submit" value="Shrani" class="submit-btn" >
    </form>


    <?php

}
echo "<table class='table'>";
$id = $_SESSION['id'];
$query2 = "SELECT * FROM oddane_datoteke WHERE predmet = '$predmet' AND Id_dijaka = '$id' AND id_naloge = '$naloga'";
$downloads = mysqli_query($connect, $query2);

echo "<thead>";
echo "<tr><th> Rok oddaje: </th><th> Oddano: </th><th></th></tr>";
echo "</thead>";
echo "<tbody>";

echo "<tr>
<th>" . $result['rok_oddaje'] . "</th>";
if (!empty($result1['datum_oddaje'])) {
    if ($result['rok_oddaje'] > $result1['datum_oddaje']) {
        echo "<th style='background-color: rgba(146,255,143,0.4)'>" . $result1['datum_oddaje'] . "</th>";
    } else {
        echo "<th style='background-color: rgba(255,124,124,0.4)'>" . $result1['datum_oddaje'] . "</th>";
    }
}else{
   echo" <th></th>";
}

echo "<th></th></tr>";
echo "<tr style='background-color: #009879; color: #ffffff;'><th>Oddane datoteke:</th><th></th><th></th></tr>";
while ($rows = mysqli_fetch_assoc($downloads)) {
    ?>
    <tr>
        <th><a href="download.php?file=<?php echo $rows['filename'] ?>"><?php echo $rows['prikazanoIme'] ?></a></th>
        <?php if (!$zaklenjeno) { ?>
            <th><a href="delete.php?file=<?php echo $rows['filename'] ?>">Izbriši</a></th>
        <?php } else echo '<th></th>'
        ?>
        <th><?php echo $rows['datumOddaje'] ?></th>
    </tr>
    <?php
}
echo "</tbody>";
?>
</table>
<?php

if (!$zaklenjeno) {
    echo '<a id="submit-btn" class="poravnava" href="oddaj.php?naloga=' . $naloga . '">ODDAJ</a>';
}
?>

</body>
</html>