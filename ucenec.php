<?php
//entry.php
session_start();
if(!isset($_SESSION["username"]))
{
    echo($_SESSION["username"]);
        header("location:ucitelj.php");
    if($_SESSION['stopnja'] == 2){
        header("location:ucitelj.php");
    }
    else if($_SESSION['stopnja'] == 3){
        header("location:admin.php");
    }
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
    <title>Predmeti</title>
    <link rel="stylesheet" href="tabela.css"/>

</head>
<body>
<link rel="stylesheet" href="header.css">
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

<?php


$id = $_SESSION['id'];

$result = mysqli_query($connect,"SELECT razred FROM ucenec WHERE id_ucenca = $id");
$result = mysqli_fetch_assoc($result);
$result = $result['razred'];
echo '<table class="table">';
echo "<thead><tr><th>Predmeti razreda - $result</th></tr><thead>";
echo "<tbody>";
$result1 = mysqli_query($connect, "SELECT kratica_predmeta FROM predmet WHERE razred = '$result'");
while ($row = $result1->fetch_assoc()){
    echo'<tr><th><a href="ucenecPredmeti.php?predmet='.$row['kratica_predmeta'].'">'.$row['kratica_predmeta'].'</a></th></tr>';

}echo "</tbody>";
echo '</table>';
?>
</body>
</html>

