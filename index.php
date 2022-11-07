<?php
if (isset($_SESSION["uporabnik"])) {
    if ($_SESSION["stopnja"] == 2) {
        header("location:ucitelj.php");
    } else if ($_SESSION["stopnja"] == 3) {
        header("location:admin.php");
    }
} else {
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
            $_SESSION['username'] = $ime . " " . $priimek;
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
    <head>
        <link rel="stylesheet" href="form.css">

    </head>
</head>
<body>

<?php
if (isset($_GET["action"]) == 'login') {
    ?>


    <div class="container">
        <div class="card">
            <div class="notri-box">
                <div class="card-spredaj">
                    <h2>PRIJAVA//DIJAK</h2>
                    <form action="" method="post">
                        <input type="text" name="mail" class="input-box" placeholder="Elektronska pošta" required>
                        <input type="password" name="password" class="input-box" placeholder="Geslo" required>
                        <button type="submit" name="login" value="Login" class="submit-btn"> PRIJAVA</button>
                    </form>
                    <div class="reg">Nov uporabnik? <a href="index.php">Registracija</a></div>
                    <br>
                    <div class="reg"><a href="loginUcitelj.php">Prijava za profesorje</a></div>
                    <br>
                    <div class="reg"><a href="loginAdmin.php"> Prijava za administratorja </a></div>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
?>
<div class="container">
    <div class="card">
        <div class="notri-box">
            <div class="card-spredaj">
                <h2>REGISTRACIJA</h2>
                <form action="" method="post">
                    <input type="text" name="ime" class="input-box" placeholder="Ime">
                    <input type="text" name="priimek" class="input-box" placeholder="Priimek">

                    <select name="razred" class="input-box">
                        <?php
                        $razred = mysqli_query($connect, "SELECT kratica_razreda FROM razred");
                        while ($rows = mysqli_fetch_assoc($razred)) {
                            echo "<label>" . $rows['kratica_razreda'] . "</label>";
                            echo "<option value='".$rows['kratica_razreda']."'>" . $rows['kratica_razreda'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="email" name="mail" class="input-box" placeholder="E-mail">
                    <input type="password" name="password" class="input-box" placeholder="Geslo" required>

                    <button type="submit" name="register" class="submit-btn"> Submit</button>

                </form>
                <div class="reg">Ste že uporabnik? <a href="index.php?action=login">Prijavite se</a></div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</body>
</html>
