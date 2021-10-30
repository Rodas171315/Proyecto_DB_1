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
        <li class="has-submenu">
            <a id="headerWhite" href="#0">Usuarios</a>
            <ul class="submenu menu vertical" data-submenu>
                <li><a id="headerWhite" href="importar.php">Importar Masivamente</a></li>
                <li><a id="headerWhite" href="habilitar.php">Habilitar Masivamente</a></li>
                <li><a id="headerWhite" href="actualizar.php">Actualizar Masivamente</a></li>
            </ul>
        </li>
        <li><a id="headerWhite" href="crud_usuarios.php">CRUD Usuarios</a></li>
        <li><a id="headerWhite" href="registro_centro.php">Centros de Vacunacion</a></li>
        <li><a id="headerWhite" href="registro_vacuna.php">Catalogo de Vacunas</a></li>
        <li><a id="headerWhite" href="reportes.php">Reportes</a></li>
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

<div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
</div>