<!-- Uses the name of the called script to activate the link to the page -->
<?php $page = basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PETRUS<sub>portaria</sub></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= $page == "index" ? "active" : "" ?>">
                <a class="nav-link" href=".">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Portaria
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item <?= $page == "visits" ? "active" : "" ?>">
                <a class="nav-link" href="visits.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Visitas</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?= $page == "visitors" ? "active" : "" ?>">
                <a class="nav-link" href="visitors.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Visitantes</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Configurações
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Usuários</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Relatórios</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
