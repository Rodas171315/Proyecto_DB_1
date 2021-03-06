<!DOCTYPE html>
<html class="no-js" lang="en">
<head><title>Home</title></head>
<?php require("head.php"); ?>

<body>
<?php require("header.php"); ?>

<div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
</div>

<section>
    <div class="grid-x">
        <div class="cell large-12">
            <img src="recursos/images/bannerHome.jpg" alt="banner home" id="bannerHome">
        </div>
    </div>
</section>

<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle="example-menu"></button>
    <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="example-menu">
    <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
        <li id="headerWhite" class="menu-text">Perfiles</li>
        <li><a id="headerWhite" href="userView.php">Cliente</a></li>
        <li><a id="headerWhite" href="empView.php">Empleado</a></li>
        <li><a id="headerWhite" href="adminView.php">Admin</a></li>
    </ul>
    </div>
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
<?php require("scripts.php"); ?>
</body>
</html>