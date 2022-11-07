<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:index.php?action=login");
}
if ($_SESSION['stopnja'] == 1) {
    header("location:ucenec.php");
} else if ($_SESSION['stopnja'] == 3) {
    header("location:admin.php");
}
$id = $_SESSION['id'];
$username = $_SESSION['username'];


$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Predmeti ki jih učite</title>
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
                <li><a href="logout.php">ODJAVA</a></li>
            </ul>
        </nav>
    </header>
</div>


<table class="table"">
<?php
echo "<thead>";
echo "<tr><th> Predmeti: </th><th>".$username."</th></tr>";
echo "</thead>";
echo "<tbody>";

    $result = mysqli_query($connect, "SELECT * FROM ucitelj_predmet WHERE id_ucitelja = '$id'");

    while ($rows = $result->fetch_assoc()) {
        ?>
        <tr>
        <th><a href="uciteljPredmeti.php?predmet=<?php echo $rows['kratica_predmeta'] ?>"><?php echo $rows['kratica_predmeta'] ?></a></th><th></th>
        </tr>
        <?php
    }
echo "</tbody>";
    ?>

</table>

</body>
</html>
