<?php

$connect = mysqli_connect("127.0.0.1", "basicuser", "M/*CSh0Z[YKFC.UV", "uporabniki");
session_start();
$user_check = $_SESSION['admin'];

$ses_sql = mysqli_query($connect, "SELECT role FROM uporabnik WHERE username = '$user_check'");

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$message = "";
$message2 = "";

if (!isset($_SESSION["admin"])) {
    header("location:login.php?action=login");
    die();
}
if (isset ($_POST ['spremeni'])) {
    $id_valute = mysqli_real_escape_string($connect, $_POST["Valuta"]);
    $vrednost_valute = mysqli_real_escape_string($connect, $_POST["Nova_vrednost"]);
    $vrednost_valute = (double)$vrednost_valute;

    mysqli_query($connect, "UPDATE valuta SET vrednost_valute = $vrednost_valute WHERE id_valute = '$id_valute'");

}

?>
<html>
<head>

    <title>Spremeni valuto</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="login.css"/>
    <link rel="stylesheet" href="postavitev.css"/>

</head>

<body>
<header id="pageHeader">
    <div class="nav-container">
        <nav class="navbar">
            <h1 id="navbar-logo">U-BANK</h1>
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav-menu">
                <li><a href="admin_uporabniki.php" class="nav-links">Uporabniki</a></li>
                <li><a href="admin_racuni.php" class="nav-links">Računi</a></li>
                <li><a href="admin_valute.php" class="nav-links">Valute</a></li>
                <li><?php echo '<a href="signout.php" class="nav-links nav-links-btn">(ADMIN) ' . $_SESSION["admin"] . ' - Sign out</a>' ?></li>

            </ul>
        </nav>
    </div>
</header>
<article id="mainArticle" class="main">

    <div class="center">
        <h1>Spremeni valuto</h1>
        <div class="error"><?php echo $message ?></div>
        <div class="error2"><?php echo $message2 ?></div>
        <form method="post">
            <?php
            $result = $connect->query("SELECT ime_valute, id_valute FROM valuta");
            echo '<form method="post">';
            echo '<label>Izberi Valuto: </label>';
            echo '<html lang="en">';
            echo '<body>';
            echo '<select name="Valuta" id="Valuta">';
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id_valute'] . '">' . $row['ime_valute'] . '</option>';
            }
            echo '</select>';
            echo '</body>';
            echo '</html>';
            ?>
            <div class="txt_field">
                <input type="text" name="Nova_vrednost" class="form-control" required/>
                <span></span>
                <label>Nova vrednost</label>
            </div>
            <input type="submit" name="spremeni" value="Spremeni" class="btn btn-info"/>


        </form>
    </div>

</article>


<script src="app.js"></script>
</body>
</html>
