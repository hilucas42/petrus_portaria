<?php
    session_start();

    # User not logged in, redirects to login page
    if (!$_SESSION || !$_SESSION['userid']) {
        header("Location: login.php");
        exit;
    }

    # Otherwise, render page

    # [Example data] Change it later to retrieve the data from database
    $fake_visitors = '[
        {"name": "Garrett Winters", "cpf": "02994078023", "rg": "216392858", "email": "g.winters@yahoo.com", "phone": "996734776", "wpp": "996734776"},
        {"name": "Ashton Cox", "cpf": "96253105094", "rg": "316382723", "email": "", "phone": "996300191", "wpp": "996300191"},
        {"name": "Cedric Kelly", "cpf": "56039455080", "rg": "369076862", "email": "kelly.cedric@gmail.com", "phone": "34361706", "wpp": "988264619"},
        {"name": "Airi Satou", "cpf": "15165140091", "rg": "", "email": "aspsyco@gmail.com", "phone": "35210100", "wpp": ""},
        {"name": "Brielle Williamson", "cpf": "74259032020", "rg": "", "email": "", "phone": "54999953123", "wpp": "54999953123"},
        {"name": "Herrod Chandler", "cpf": "84968453035", "rg": "433285679", "email": "", "phone": "988131946", "wpp": "988131946"}
    ]';

    if (!$_SESSION['visitors']) {
        $_SESSION['visitors'] = json_decode($fake_visitors, true);
    }

    if (isset($_POST['save'])) {
        $_SESSION['visitors'][] = [
            'name' => $_POST['visitorName'],
            'cpf' => $_POST['visitorCPF'],
            'rg' => $_POST['visitorRG'],
            'email' => $_POST['visitorEmail'],
            'phone' => $_POST['visitorPhone'],
            'wpp' => $_POST['visitorWhatsapp'],
        ];
    }

    $visitors = $_SESSION['visitors'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PETRUS - Visitante</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

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
                        <a href="visitor.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                            <td>' . $a_visit['name'] . '</td>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>