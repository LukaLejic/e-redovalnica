<?php
session_start();
$connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'rtf', 'docx', 'zip', 'rar');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 50000) {

                $id = $_SESSION['id'];
                $predmet = $_SESSION['predmet'];
                $imeDatoteke = $fileExt[0];
                $id_naloge = $_SESSION['naloga'];
                $result = mysqli_query($connect, "SELECT ime,priimek FROM ucenec WHERE id_ucenca = '$id'");
                $result = mysqli_fetch_assoc($result);
                $fileNameNew = $result['priimek'] . $result['ime'] . "-" . $fileName;
                $fileNameNew = preg_replace('/[č,š,ž,đ,č,ć,Č,Ć,Š,Ž,Đ]/', '', $fileNameNew);
                $obstaja = mysqli_query($connect, "SELECT * FROM oddane_datoteke WHERE filename = '$fileNameNew'");
                $fileDestination = 'nalogeUcencev/' . $fileNameNew;
                if (empty($obstaja)) {
                    $query = "INSERT INTO oddane_datoteke(filename, Id_dijaka, prikazanoIme, predmet, id_naloge) VALUES ('$fileNameNew', '$id', '$imeDatoteke','$predmet','$id_naloge')";
                    $run = mysqli_query($connect, $query);
                } else {
                    $query = "DELETE FROM oddane_datoteke WHERE filename = '$fileNameNew'";
                    $run = mysqli_query($connect, $query);
                    $query = "INSERT INTO oddane_datoteke(filename, Id_dijaka, prikazanoIme, predmet, id_naloge) VALUES ('$fileNameNew', '$id', '$imeDatoteke','$predmet','$id_naloge')";
                    $run = mysqli_query($connect, $query);
                }
                if ($run) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
            } else {
                $error = "Datoteka je prevelika";
            }
        } else {
            echo $error = "Napaka pri nalaganju";
        }
    } else {
        $error = "Nepodprt tip datoteke";
    }
    $error = "Naloženo";
}
header("location:ucenecNaloge.php?predmet=" . $_SESSION['predmet'] . "&naloga=" . $_SESSION['naloga'] . "&error=" . $error);
?>
