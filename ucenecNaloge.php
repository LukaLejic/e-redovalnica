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
if (isset($_POST['oddaj'])) {
    unset($_POST);
        mysqli_query($connect, "INSERT INTO oddane_naloge(id_naloge, id_ucenca) VALUES ('$naloga','$id')");



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

</head>
<body>
<?php
$result = mysqli_query($connect, "SELECT * FROM naloga WHERE id_naloge = '$naloga'");
$result = mysqli_fetch_assoc($result);
echo $result['naslov'];
echo $result['navodilo'];


?>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label>
        <input type="file" name="file" style="display:block">
    </label>
    <label>
        <input type="submit" name="submit">
    </label>
</form>

<table class="table">


    <?php
    $id = $_SESSION['id'];
    $query2 = "SELECT * FROM oddane_datoteke WHERE predmet = '$predmet' AND Id_dijaka = '$id' AND id_naloge = '$naloga'";
    $downloads = mysqli_query($connect, $query2);
    echo "<tbody>";
    echo "<thead>";
    echo "<tr><th> Rok oddaje: </th><th> Oddano: </th><th></th></tr>";
    echo "</thead>";

    echo "<tr>
<th>" . $result['rok_oddaje'] . "</th>
<th></th></tr>";

    while ($rows = mysqli_fetch_assoc($downloads)) {
        ?>
        <tr>
            <th><a href="download.php?file=<?php echo $rows['filename'] ?>"><?php echo $rows['prikazanoIme'] ?></a></th>
            <?php if(!$zaklenjeno){ ?>
            <th><a href="delete.php?file=<?php echo $rows['filename'] ?>">Izbriši</a></th>
            <?php }else echo'<th></th>'
            ?>
            <th><?php echo $rows['datumOddaje'] ?></th>
        </tr>
        <?php
    }
    echo "</tbody>";
    ?>
</table>
<?php
if(!$zaklenjeno){
    echo'<form method="post">
        <label>
            <input type="submit" name="oddaj" value="Oddaj">Oddaj</input>
        </label>
    </form>';
}
?>

</body>
</html>