<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/foundation.css"/>
</head>

<body>
<?php require("header.php"); ?>

<section>
    <div class="grid-x">
        <div class="cell large-12">
            <img src="recursos/images/bannerHome.jpg" alt="banner home" id="bannerHome">
        </div>
    </div>
</section>

<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle="example-menu"></button>
    <div class="title-bar-title"></div>
</div>

<div class="top-bar" id="example-menu">
    <div class="top-bar-left"></div>
    <div class="top-bar-right">
    <ul class="menu">
        <li><input id="headerWhite" type="search" placeholder="Buscar"></li>
        <li><a href="#0" class="button">Buscar</a></li>
    </ul>
    </div>
</div>
<br>

<h1>Inserte contenido aqui!</h1>

<?php require("footer.php"); ?>
<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
<script src="js/styleImport.js"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>