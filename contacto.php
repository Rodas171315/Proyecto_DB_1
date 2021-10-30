<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>

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

<section class="ContactForm">
    <video id="ContactVideo" src="recursos/videos/Background 1 Flying Clouds.mp4" autoplay loop muted
        poster="recursos/images/Computer 1.jpg"></video>
    <div class="grid-x">
        <div class="cell small-1 large-2"></div>
        <div class="cell small-10 large-8">
            <article class="ContactBody">
                <h1>FORMULARIO DE CONTACTO</h1>
                <hr>
                <p>Envíanos un mensaje, estaremos encantados de responderte ante todas tus dudas. Recuerda que
                    puedes llamarnos o escribirnos un correo a nuestro email, o bien puede escribirnos por este formulario. 
                    Te responderemos lo más inmediatamente posible.</p>
                <div class="grid-x grid-margin-y">
                    <div class="cell small-12 large-4">
                        <img class="icon" src="recursos/icons/Contact Us/007-house.png">&nbsp; <span>(+502) 1234-5678</span>
                    </div>
                    <div class="cell small-12 large-4">
                        <img class="icon" src="recursos/icons/Contact Us/013-mail.png">&nbsp; 
                        <a href="mailto:info@proyectodb.com?Subject=[Vacuna%20Web]%20Nuevo%20contacto" id="Fcontact">info@proyectodb.com</a>
                    </div>
                    <div class="cell small-12 large-4">
                        <img class="icon" src="recursos/icons/Contact Us/029-telephone-1.png">&nbsp; <span>(+502) 1234-5678</span>
                    </div>
                </div>
                <br>
                <form data-abide novalidate action="enviar_correo.php" method="post">
                    <div class="grid-x grid-margin-x">
                        <div class="cell">
                            <div data-abide-error class="alert callout" style="display: none;">
                                <p><span class="iconify" data-icon="foundation:alert"></span> Se encuentran algunos errores en el formulario, que debera corregir para poder enviar.</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell large-6">
                            <label for="usuario">
                                <input type="text" name="usuario" id="usuario" placeholder="Nombre o Usuario" aria-describedby="exampleHelpTex" required>
                            </label>
                            <p class="help-text" id="exampleHelpTex">Nombre y apellido o nombre de usuario</p>
                        </div>
                        <div class="cell large-6">
                            <label for="email">
                                <input type="text" name="email" id="email" placeholder="Correo Electronico" aria-describedby="exampleHelpTex" required pattern="email">
                            </label>
                            <p class="help-text" id="exampleHelpTex">sucorreo@ejemplo.com</p>
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell large-12">
                            <label for="asunto">
                                <input type="text" name="asunto" id="asunto" placeholder="Asunto" required>
                            </label>
                        </div>
                        <div class="cell large-12">
                            <label for="mensaje">
                                <textarea name="mensaje" id="mensaje" placeholder="Mensaje" required></textarea>
                            </label>
                        </div>
                    </div>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4 medium-5 large-7">
                            <aside class="ContactAdvertisement">
                                <h6>- Advertisement -</h6>
                                <a href="#0"> <img src="recursos/images/horizontal adv 3.jpg" alt="image for advertising"> </a>
                            </aside>
                        </div>
                        <fieldset class="cell small-3 medium-3 large-2">
                            <button class="button" type="reset" value="Limpiar">Limpiar</button>
                        </fieldset>
                        <fieldset class="cell small-5 medium-4 large-3">
                            <button class="button" type="submit" name="enviar" id="enviar" value="Enviar">Enviar Mensaje</button>
                        </fieldset>
                    </div>
                </form>
            </div>
        </article>
        <div class="cell small-1 large-2"></div>
    </div>
</section>

<?php require("footer.php"); ?>
<?php require("scripts.php"); ?>
</body>
</html>