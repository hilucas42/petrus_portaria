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
                        <h1 class="h3 mb-0 text-gray-800">Usuários</h1>
                        <a href="/user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus-circle fa-sm text-white-50"></i> Novo usuário</a>
                    </div>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Usuários cadastrados</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Telefone</th>
                                            <th>Tipo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Username</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Telefone</th>
                                            <th>Tipo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
<!-- Populates table with data from registered users -->
<?php
    foreach ($users as $an_user) {
?>
                                        <tr>
                                            <td><?=$an_user['username']?></td>
                                            <td><?=$an_user['fullname']?></td>
                                            <td><?=$an_user['email']?></td>
                                            <td><?=$an_user['phone']?></td>
                                            <td><?=$an_user['isadm'] ? 'Admin' : 'User'?></td>
                                            <td>
                                                <!-- Opens user data for update -->
                                                <a class="fas fa-user-edit text-decoration-none"
                                                href="/user/<?=$an_user['username']?>"></a>
                                                <!-- Deletes user -->
                                                <form class="d-inline" action="user/<?=$an_user['username']?>" method="POST">
                                                    <input name="_method" type="hidden" value="DELETE" />
                                                    <a href="#" class="fas fa-user-slash text-decoration-none"
                                                    onclick="$(this).closest('form').submit()"></a>
                                                </form>
                                            </td>
                                        </tr>
<?php
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
