<?php
if (isset($_SESSION["uporabnik"])) {
    if ($_SESSION["stopnja"] == 1) {
        header("location:ucenec.php");
    } else if ($_SESSION["stopnja"] == 3) {
        header("location:admin.php");
    }
} else {
    $connect = mysqli_connect("localhost", "basicuser", "edD-AgA_FeFfqjOC", "moodle");
    session_start();
}
if (isset($_POST["login"])) {
    if (empty($_POST["mail"]) && empty($_POST["password"])) {
        echo '<script>alert("Both Fields are required")</script>';
    } else {
        $mail = mysqli_real_escape_string($connect, $_POST["mail"]);
        $password = mysqli_real_escape_string($connect, $_POST["password"]);
        $queryUcitelj = mysqli_query($connect, "SELECT id_ucitelja,ime,priimek FROM ucitelj WHERE mail = '$mail' AND password = '$password'");


        if (mysqli_num_rows($queryUcitelj) > 0) {

            $imeUcitelj = mysqli_fetch_assoc($queryUcitelj);
            $ime = $imeUcitelj['ime'];
            $priimek = $imeUcitelj['priimek'];
            $id = $imeUcitelj['id_ucitelja'];

            $_SESSION["stopnja"] = 2;
            $_SESSION['username'] = $ime . " " . $priimek;
            $_SESSION['id'] = $id;

            header("location:ucitelj.php");
        } else {
            echo '<script>alert("Wrong User Details")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head> <link rel="stylesheet" href="form.css"</head>
<body>
    <div class="container">
        <div class="card">
            <div class="notri-box">
                <div class="card-spredaj">
                    <h2>PRIJAVA//PROFESOR</h2>
                    <form action = "" method = "post">
                        <input type="text" name="mail" class="input-box" placeholder="Elektronska pošta" required>
                        <input type="password" name="password" class="input-box" placeholder="Geslo" required>
                        <button type="submit" name="login" value="Login" class="submit-btn"> PRIJAVA </button>
                    </form>
                    <div class="reg"><a href="index.php?action=login">Prijava za dijake</a></div>
                    <br>
                    <div class="reg"><a href="loginAdmin.php"> Prijava za administratorje </a> </div>
                </div>
            </div>
        </div>
</div>
</body>
</html>