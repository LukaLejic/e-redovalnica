<?php
if (isset($_SESSION["uporabnik"])) {
    if($_SESSION["stopnja"] == 1){
        header("location:ucenec.php");
    }else if($_SESSION["stopnja"] == 3){
        header("location:admin.php");
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
        $queryUcitelj = mysqli_query($connect, "SELECT id_ucenca,ime,priimek FROM ucitelj WHERE mail = '$mail' AND password = '$password'");


        if (mysqli_num_rows($queryUcitelj) > 0) {

            $imeUcitelj = mysqli_fetch_assoc($queryUcitelj);
            $ime = $imeUcitelj['ime'];
            $priimek = $imeUcitelj['priimek'];
            $id = $imeUcitelj['id_ucenca'];

            $_SESSION["stopnja"] = 2;
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
        <h3 align="center">Prijava</h3>
        <a href="index.php">Ucenec</a>
        <a href="loginAdmin.php">Admni</a>
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
            <p align="center"><a href="index.php">Register</a></p>
        </form>
</div>
</body>
</html>