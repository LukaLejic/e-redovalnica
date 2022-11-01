<?php
//entry.php
session_start();
if(!isset($_SESSION["username"]))
{
    echo($_SESSION["username"]);
    header("location:index.php?action=login");
    if($_SESSION['stopnja'] == 1){
        header("location:ucenec.php");
    }
    else if($_SESSION['stopnja'] == 3){
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
    <title>Vaši predmeti</title>
</head>
<body>
    <table>

    </table>

</body>
</html>
