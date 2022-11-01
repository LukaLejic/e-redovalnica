<?php
if (isset($_SESSION["uporabnik"])) {
    if($_SESSION["stopnja"] == 1){
        header("location:ucenec.php");
    }else if($_SESSION["stopnja"] == 2){
        header("location:ucitelj.php");
    }
}else{
    $connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
    session_start();
}
if (isset($_POST["login"])) {
    if (empty($_POST["mail"]) && empty($_POST["password"])) {
        echo '<script>alert("Both Fields are required")</script>';
    } else {
        $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
        $queryAdmin = mysqli_query($connect, "SELECT id_admina,ime,priimek FROM admin WHERE mail = '$mail' AND password = '$password'");


        if (mysqli_num_rows($queryAdmin) > 0) {

            $imeAdmin = mysqli_fetch_assoc($queryAdmin);
            $ime = $imeAdmin['ime'];
            $priimek = $imeAdmin['priimek'];
            $id = $imeAdmin['id_admina'];

            $_SESSION["stopnja"] = 3;
            $_SESSION['username'] = $ime." ".$priimek;
            $_SESSION['id'] = $id;

            header("location:entry.php");
        } else {
            echo '<script>alert("Wrong User Details")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<br/><br/>
<div class="container" style="width:500px;">
    <br/>
        <h3>Prijava</h3>
        <a href="loginUcitelj.php">Učitelj</a>
        <a href="index.php?action=login">Ucenec</a>
        <br/>
        <form method="post">
            <label>Enter mail</label>
            <input type="text" name="mail" class="form-control"/>
            <br/>
            <label>Enter Password</label>
            <input type="password" name="password" class="form-control"/>
            <br/>
            <input type="submit" name="login" value="Login" class="btn btn-info"/>
            <br/>
            <p><a href="index.php">Register</a></p>
        </form>
</div>
</body>
</html>
