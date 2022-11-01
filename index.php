<?php
if (isset($_SESSION["uporabnik"])) {
    if($_SESSION["stopnja"] == 2){
    header("location:ucitelj.php");
    }else if($_SESSION["stopnja"] == 3){
        header("location:admin.php");
    }
}else{
    $connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
    session_start();
    $_SESSION['connect'] = $connect;
}
if (isset($_POST["register"])) {
    if (empty($_POST["mail"]) && empty($_POST["password"])) {
        echo '<script>alert("Izpolnite vsa polja!")</script>';
    } else {
        $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
        $ime = mysqli_real_escape_string($connect, $_POST["ime"]);
        $priimek = mysqli_real_escape_string($connect, $_POST["priimek"]);
        $razred = mysqli_real_escape_string($connect, $_POST["razred"]);
        if (mysqli_num_rows(mysqli_query($connect, "SELECT mail FROM ucenec WHERE mail ='$mail'")) > 0) {
            echo '<script>alert("Ta mail je že bil uporabljen!")</script>';
        } else {
            $query = "INSERT INTO ucenec (mail, password, ime, priimek, razred ) VALUES('$mail', '$password', '$ime', '$priimek','$razred')";
            if (mysqli_query($connect, $query)) {
                echo '<script>alert("Registration Done")</script>';
            }
        }
    }
}
if (isset($_POST["login"])) {
    if (empty($_POST["mail"]) && empty($_POST["password"])) {
        echo '<script>alert("Both Fields are required")</script>';
    } else {
        $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
        $queryUcenec = mysqli_query($connect, "SELECT id_ucenca,ime,priimek FROM ucenec WHERE mail = '$mail' AND password = '$password'");


        if (mysqli_num_rows($queryUcenec) > 0) {

                $imeUcenec = mysqli_fetch_assoc($queryUcenec);
                $ime = $imeUcenec['ime'];
                $priimek = $imeUcenec['priimek'];
                $id = $imeUcenec['id_ucenca'];

                $_SESSION["stopnja"] = 1;
                $_SESSION['username'] = $ime." ".$priimek;
                $_SESSION['id'] = $id;

            header("location:ucenec.php");
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
    <?php
    if (isset($_GET["action"])) {
        ?>
        <h3>Prijava</h3>
        <a href="loginUcitelj.php">Učitelj</a>
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
            <p><a href="index.php">Register</a></p>
        </form>
        <?php
    } else {
        ?>
        <h3>Registracija</h3>
        <br/>
        <form method="post">
            <label>Ime</label>
            <input type="text" name="ime" class="form-control"/>
            <br/>
            <label>Priimek</label>
            <input type="text" name="priimek" class="form-control"/>
            <br/>

            <div>
                <label>Razed</label>
                <select name="razred">
                    <?php
                    $razred = mysqli_query($connect, "SELECT kratica_razreda FROM razred");
                    $razred1 = mysqli_fetch_assoc($razred);
                    foreach ($razred1 as $item) {
                        echo "<label>$item</label>";
                        echo "<option value='$item'>$item</option>";
                    }
                    ?>
                </select>
            </div>
            <br class="form-control"/>
            <label>Mail</label>
            <input type="email" name="mail" class="form-control"/>
            <br/>
            <label>Geslo</label>
            <input type="password" name="password" class="form-control"/>
            <br/>
            <input type="submit" name="register" value="Register" class="btn btn-info"/>
            <br/>
            <p align="center"><a href="index.php?action">Login</a></p>
        </form>
        <?php
    }
    ?>
</div>
</body>
</html>
