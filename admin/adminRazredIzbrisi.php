<?php
//entry.php
session_start();
if (!isset($_SESSION["username"])) {

    header("location:../index.php?action=login");

}
if ($_SESSION['stopnja'] == 2) {
    header("location:../ucitelj.php");
} else if ($_SESSION['stopnja'] == 1) {
    header("location:../ucenec.php");
}
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
if (isset($_GET['razred'])){
    $razred = $_GET['razred'];
}
$result = mysqli_query($connect, "SELECT * FROM predmet WHERE razred = razred");
while($row = mysqli_fetch_assoc($result)){
    $predmet = $row['kratica_predmeta'];
    mysqli_query($connect, "DELETE FROM naloga WHERE predmet = '$predmet'");
    mysqli_query($connect, "DELETE FROM ucitelj_predmet WHERE kratica_predmeta = '$predmet'");
}


mysqli_query($connect, "DELETE FROM predmet WHERE razred = '$razred'");
mysqli_query($connect, "DELETE FROM razred WHERE kratica_razreda = '$razred'");
try {


}catch (Exception $exception){
    echo '<script>alert("Napaka")</script>';
}
header("location:adminRazred.php");
?>
