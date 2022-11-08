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

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'doc', 'zip', 'rar');
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 50000) {

                $predmet = $_SESSION['predmet'];
                $imeDatoteke = $fileExt[0];

                $fileNameNew = $predmet . '-' . $fileName;
                $fileNameNew = preg_replace('/[č,š,ž,đ,č,ć,Č,Ć,Š,Ž,Đ]/', '', $fileNameNew);
                $obstaja = mysqli_query($connect, "SELECT * FROM gradivo WHERE filename = '$fileNameNew'");
                $fileDestination = 'gradivo/' . $fileNameNew;
                if (empty($obstaja)) {
                    $query = "INSERT INTO gradivo(filename,predmet) VALUES ('$fileNameNew','$predmet')";
                    $run = mysqli_query($connect, $query);
                } else {
                    $query = "DELETE FROM gradivo WHERE filename = '$fileNameNew'";
                    $run = mysqli_query($connect, $query);
                    $query = "INSERT INTO gradivo(filename, predmet) VALUES ('$fileNameNew','$predmet')";
                    $run = mysqli_query($connect, $query);
                }
                if ($run) {
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("location:uciteljPredmeti.php?predmet=" . $_SESSION['predmet']);
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

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="tabela.css">
</head>

<body>
<div class="kista">
    <header>
        <nav>
            <label class="logo"> </label>
            <a href="index.php"> <img class="logo" src="slike/logo1.jpg" alt="ne radi"> </a>
            <label class="logotip"></label>
            <ul>
                <li><a href="uciteljPredmeti.php">Nazaj</a></li>
            </ul>
        </nav>
    </header>
</div>
<form action="uciteljDodajGradivo.php" method="POST" enctype="multipart/form-data">
    <label>
        <input type="file" name="file" style="display:block">
    </label>
    <label>
        <input type="submit" name="submit">
    </label>
</form>
</body>
</html>


