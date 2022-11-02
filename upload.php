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
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = 'nalogeUcencev/' . $fileNameNew;
                $id = $_SESSION['id'];
                $predmet = $_SESSION['predmet'];
                $imeDatoteke = $fileExt[0];
                $query = "INSERT INTO oddane_datoteke(filename, Id_dijaka, imeDatoteke, predmet, id_naloge) VALUES ('$fileNameNew', '$id', '$imeDatoteke','$predmet')";
                $run = mysqli_query($connect,$query);
                if($run){
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}
header("location:ucenecNaloge.php?predmet=".$_SESSION['predmet']."&naloga=".$_SESSION['naloga']);
?>
