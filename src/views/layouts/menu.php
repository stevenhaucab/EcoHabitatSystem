<?php
// Obtener la URL actual
$current_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<ul class="side-nav-menu scrollable">
    <li class="nav-item dropdown <?= ($current_url == '/desarrollos') ? 'open' : ''; ?>">
        <a class="dropdown-toggle" href="javascript:void(0);">
            <span class="icon-holder">
                <i class="anticon anticon-dashboard"></i>
            </span>
            <span class="title">Panel de Control</span>
            <span class="arrow">
                <i class="arrow-icon"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
            <li class="<?= ($current_url == '/desarrollos') ? 'active' : ''; ?>">
                <a href="/desarrollos">Desarrollos</a>
            </li>
            <li class="<?= ($current_url == '/etapas') ? 'active' : ''; ?>">
                <a href="/etapas">Etapas</a>
            </li>
            <li class="<?= ($current_url == '/plan-de-pagos') ? 'active' : ''; ?>">
                <a href="/plan-de-pagos">Plan de Pagos</a>
            </li>
        </ul>
    </li>
    <li class="nav-item dropdown <?= ($current_url == '/usuarios') ? 'open' : ''; ?>">
        <a class="dropdown-toggle" href="javascript:void(0);">
            <span class="icon-holder">
                <i class="anticon anticon-user"></i>
            </span>
            <span class="title">Usuarios</span>
            <span class="arrow">
                <i class="arrow-icon"></i>
            </span>
        </a>
        <ul class="dropdown-menu">
            <li class="<?= ($current_url == '/lista-de-usuarios') ? 'active' : ''; ?>">
                <a href="/lista-de-usuarios">Lista de usuarios</a>
            </li>
        </ul>
    </li>
</ul>
