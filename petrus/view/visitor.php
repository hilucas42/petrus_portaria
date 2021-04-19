<!DOCTYPE html>
<html lang="en">

<?php include('head.inc'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar adjustable for all pages -->
        <?php include('sidebar.inc'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar used for all pages -->
                <?php include('topbar.inc'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Novo visitante</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                            onclick="document.getElementById('save').click()">
                            <i class="fas fa-plus-circle fa-sm text-white-50"></i> Salvar visitante
                        </a>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <!--div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Visitas (Total)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">7</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div-->

                    <!-- Dropdown Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Dados pessoais do visitante</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Editar:</div>
                                    <a class="dropdown-item" href="#">Salvar</a>
                                    <a class="dropdown-item" href="#">Excluir</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Registrar visita</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <form id="visitor" class="user" action="/visitor" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="visitorName"
                                    name="visitorName" placeholder="Nome completo">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="visitorCPF"
                                        name="visitorCPF" placeholder="CPF">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="visitorRG"
                                        name="visitorRG" placeholder="RG">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="visitorEmail"
                                    name="visitorEmail" placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="visitorPhone"
                                        name="visitorPhone" placeholder="Telefone">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="visitorWhatsapp"
                                        name="visitorWhatsapp" placeholder="Whatsapp">
                                    </div>
                                </div>
                                <div class="form-group d-none">
                                    <button type="submit" class="btn btn-primary btn-user btn-block" id='save'
                                    name="save" value="Save"></button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include('footer.inc'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal and scripts, used in all pages -->
    <?php include('bottom.inc') ?>

</body>

</html>
