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
                        <h1 class="h3 mb-0 text-gray-800">Visitantes</h1>
                        <a href="/visitor" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus-circle fa-sm text-white-50"></i> Novo visitante</a>
                    </div>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Visitantes conhecidos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>RG</th>
                                            <th>Email</th>
                                            <th>Telefone</th>
                                            <th>Whatsapp</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>RG</th>
                                            <th>Email</th>
                                            <th>Telefone</th>
                                            <th>Whatsapp</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<!-- Populates table with data from recovered visits -->
<?php
    foreach ($visitors as $a_visit) {
        echo '
                                        <tr>
                                            <td>' . $a_visit['fullname'] . '</td>
                                            <td>' . $a_visit['cpf']  . '</td>
                                            <td>' . $a_visit['rg']   . '</td>
                                            <td>' . $a_visit['email']. '</td>
                                            <td>' . $a_visit['phone']. '</td>
                                            <td>' . $a_visit['wpp']  . '</td>
                                        </tr>';
    }
?>                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End of DataTables Example -->
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
