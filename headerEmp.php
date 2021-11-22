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
        <li><a id="headerWhite" href="empView.php">Buscar Usuarios</a></li>
        <li><a id="headerWhite" href="validar_comprobante.php">Validar Comprobante</a></li>
        <li class="has-submenu">
            <a id="headerWhite" href="crud.php">CRUD</a>
            <ul class="submenu menu vertical" data-submenu>
                <li><a id="headerWhite" href="crud.php#crud_personas">Personas</a></li>
                <li><a id="headerWhite" href="crud.php#crud_usuarios">Usuarios</a></li>
            </ul>
        </li>
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