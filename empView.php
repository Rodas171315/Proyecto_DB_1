<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/foundation.css"/>
</head>

<body>
<?php require("headerlogged.php"); ?>

<?php

    // Reanuda la sesion del usuario.
    session_start();
    if(!isset($_SESSION["usuario"]))
    {
        header("location:login.php");
    }

?>

<?php require("ejecuta_busqueda.php"); ?>

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
        <li id="headerWhite" class="menu-text">Opciones</li>
        <li><a id="headerWhite" href="#h1empView">Buscar Usuarios</a></li>
        <li><a id="headerWhite" href="crud_usuarios.php">CRUD Usuarios</a></li>
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

<br>
<hr>
<h1 id="h1empView">BUSQUEDA DE USUARIO</h1>
<hr>
<br>

<form data-abide novalidate action="<?php $pagina_destino ?>" method="get">
<table id ="tableempView">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <tr>
            <td id="tdempView">
            <br>
            <div class="cell small-12">
                <label for="buscar">Ingresar CUI (DPI):
                <input type="text" name="buscar" id="buscar" placeholder="1234" pattern="number">
                </label>
            </div>
            </td>
            </tr>
            <tr>
            <td id="tdempView">
            <br>
            <div class="grid-container">
                <div class="grid-x grid-margin-x">
                    <fieldset class="cell large-2"></fieldset>
                    <fieldset class="cell large-4">
                        <button class="button" type="submit" name="enviando" value="Buscar!">Buscar!</button>
                    </fieldset>
                    <fieldset class="cell large-4">
                        <button class="button" type="reset" value="Limpiar">Limpiar</button>
                    </fieldset>
                    <fieldset class="cell large-2"></fieldset>
                </div>
            </div>
            </td>
            </tr>
        </div>
    </div>
</table>
</form>
<br>

<?php

// Comprueba si el formulario esta lleno para realizar una busqueda especializada, de lo contrario, muestra todos los registros. 
if($busqueda_ingresada!=NULL)
{
    ejecuta_busqueda($busqueda_ingresada);
}
else
{
    $busqueda_ingresada="";
}

?>

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