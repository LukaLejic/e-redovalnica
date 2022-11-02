<?php
session_start();
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
if ($_SESSION['stopnja'] == 2) {
    header("location:ucitelj.php");
} else if ($_SESSION['stopnja'] == 3) {
    header("location:admin.php");
}
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
$result = mysqli_query($connect, "SELECT * FROM naloga WHERE prikazan_naslov = '$naloga'");
$result = mysqli_fetch_assoc($result);
echo $result['naslov'];
echo $result['navodilo'];
echo $result['rok_oddaje'];

?>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label>
        <input type="file" name="file" style="display:block">
    </label>
    <label>
        <input type="submit" name="submit">
    </label></form>
<table>


    <?php
    $id = $_SESSION['id'];
    $query2 = "SELECT * FROM oddane_datoteke WHERE predmet = '$predmet' AND Id_dijaka";
    $downloads = mysqli_query($connect, $query2);

    while ($rows = mysqli_fetch_assoc($downloads)) {
        ?>
        <tr>
            <td><a href="download.php?file=<?php echo $rows['filename'] ?>"><?php echo $rows['imeDatoteke'] ?></a><br></td>
            <td><a href="delete.php?file=<?php echo $rows['filename'] ?>">Izbriši</a><br></td>
        </tr>
        <?php
    }
    ?>


</table>

</body>
</html>