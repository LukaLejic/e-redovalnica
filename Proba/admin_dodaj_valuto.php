
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

<article id="mainArticle" class="main">

    <div class="center">
        <h1>Dodaj valuto</h1>
        <div class="error"></div>
        <div class="error2"></div>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="ime_valute" class="form-control" required/>
                <span></span>
                <label>Ime valute</label>
            </div>
            <div class="txt_field">
                <input type="text" name="vrednost_valute" class="form-control" required/>
                <span></span>
                <label>Vrednost valute</label>
            </div>
            <input type="submit" name="spremeni" value="Dodaj" class="btn btn-info"/>


        </form>
    </div>

</article>


<script src="app.js"></script>
</body>
</html>
