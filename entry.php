<?php
//entry.php
session_start();
if(!isset($_SESSION["username"]))
{
    echo($_SESSION["username"]);
    header("location:index.php?action=login");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Webslesson Tutorial | PHP Login Registration Form with md5() Password Encryption</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<br /><br />
<div class="container" style="width:500px;">
    <br />
    <?php
    echo '<h1>Welcome - '.$_SESSION["username"].'</h1>';
    echo '<label><a href="logout.php">Logout</a></label>';
    ?>
</div>
</body>
</html>
