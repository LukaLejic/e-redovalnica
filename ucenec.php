<?php
//entry.php
session_start();
if(!isset($_SESSION["username"]))
{
    echo($_SESSION["username"]);
        header("location:ucitelj.php");
    if($_SESSION['id'] == 2){
        header("location:ucitelj.php");
    }
    else if($_SESSION['id'] == 3){
        header("location:admin.php");
    }
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
<body>
<?php
echo "</table>";
$result = mysqli_query("SELECT * FROM razred WHERE trr_posiljatelja = '$ff' OR trr_prejemnika = '$ff'  ORDER BY datum DESC");

echo "<table class='table'>";
    echo "<thead>";
    echo "<tr><th> ID transakcije: </th><th> TRR posiljatelja: </th><th> TRR prejemnika: </th><th> Kolicina: </th><th> Valuta: </th><th> Datum: </th></tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {

    $id_valute = $row['valuta'];
    $valuta = $connect->query("SELECT ime_valute FROM valuta WHERE id_valute = $id_valute");

    $valuta1 = mysqli_fetch_assoc($valuta);
    $valuta2 = $valuta1['ime_valute'];

    echo "<tr><td>" . htmlspecialchars($row['id_transakcije']) . "</td><td>" . htmlspecialchars($row['trr_posiljatelja']) . "</td><td>" . htmlspecialchars($row['trr_prejemnika']) . "</td><td>" . htmlspecialchars($row['kolicina']) . "</td><td>" . htmlspecialchars($valuta2) . "</td><td>" . htmlspecialchars($row['datum']) . "</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
?>
</body>
</html>