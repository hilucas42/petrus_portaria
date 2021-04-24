<!DOCTYPE html>
<html lang="en">

<?php include('head.inc'); ?>

<body id="page-top">

    <link href="https://unpkg.com/uppload@2.3.0/dist/uppload.css" rel="stylesheet">
    <link href="https://unpkg.com/uppload@2.3.0/dist/themes/light.css" rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-gray-800">Novo usuário</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                            onclick="validateUserForm()">
                            <i class="fas fa-plus-circle fa-sm text-white-50"></i> Salvar usuário
                        </a>
                    </div>

                    <!-- Dropdown Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Dados do usuário</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Editar:</div>
                                    <a class="dropdown-item" id="uppload-button" href="#">Alterar foto</a>
                                    <a class="dropdown-item" href="#">Salvar</a>
                                    <a class="dropdown-item" href="#">Excluir</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Registrar visita</a>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-md-4 card-body pl-1">
                                <img class="rounded mx-auto d-block uppload-image" src="/picture/<?=$user->username?>" alt="User picture" style="max-width: 170px">
                            </div>
                            <div class="col-md-8">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form id="user" class="user" action="/user" method="POST">
                                        <input name="_method" type="hidden" value="<?=isset($put) ? 'PUT' : 'POST'?>" />
                                        <div class="form-group">
                                            <input type="text" id="userUsername" name="username" placeholder="Username"
                                            class="form-control form-control-user 
                                            <?=isset($err_uts) ? 'is-invalid" aria-describedby="shortUNameMsg' : null?>
                                            <?=isset($err_mfu) ? 'is-invalid" aria-describedby="malformedUNameMsg' : null?>"
                                            <?=isset($user) ? 'value="' . $user->username . '"' : null?>
                                            <?=isset($put) ? 'readonly' : null?>>
                                            <div id="shortUNameMsg" class="invalid-feedback <?=isset($err_uts) ? null : 'd-none'?>">
                                                O username deve ter pelo menos 4 caracteres.
                                            </div>
                                            <div id="malformedUNameMsg" class="invalid-feedback <?=isset($err_mfu) ? null : 'd-none'?>">
                                                O username deve ter letras, números ou _ e começar com letras.
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" id="userPassword" name="password"
                                                class="form-control form-control-user <?=isset($err_pts) ? 'is-invalid" aria-describedby="shortPasswdMsg' : null?>"
                                                placeholder="<?=isset($user) ? '********' : 'Senha'?>">
                                                <div id="shortPasswdMsg" class="invalid-feedback <?=isset($err_pts) ? null : 'd-none'?>">
                                                    A senha deve ter pelo menos 8 dígitos.
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" id="userPasswordC" name="password"
                                                class="form-control form-control-user" aria-describedby="unmatchPasswdMsg"
                                                placeholder="<?=isset($user) ? '********' : 'Confirmação da senha'?>">
                                                <div id="unmatchPasswdMsg" class="invalid-feedback d-none">
                                                    A confirmação não confere.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="userFullname" name="fullname" placeholder="Nome completo"
                                            class="form-control form-control-user <?=isset($err_fns) ? 'is-invalid" aria-describedby="shortFullNameMsg' : null?>"
                                            <?=isset($user) ? 'value="' . $user->fullname . '"' : null?>>
                                            <div id="shortFullNameMsg" class="invalid-feedback <?=isset($err_fns) ? null : 'd-none'?>">
                                                O nome deve ter pelo menos 4 caracteres.
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="userPhone"
                                                name="phone" placeholder="Telefone" <?=isset($user) ? 'value="' . $user->phone . '"' : null?>>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control form-control-user" id="userEmail"
                                                name="email" placeholder="Email" <?=isset($user) ? 'value="' . $user->email . '"' : null?>>
                                            </div>
                                        </div>
                                        <div class="form-group custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="userIsAdm" name="isadm" <?=isset($user) && $user->isadm ? 'checked' : null?>>
                                            <label class="custom-control-label" for="userIsAdm">Administrador</label>
                                        </div>
                                        <div class="form-group d-none">
                                            <button type="submit" class="btn btn-primary btn-user btn-block" id='save'
                                            name="save" value="Save"></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <script src="https://unpkg.com/uppload@2.3.0/dist/browser.js"></script>

    <script>
        window.addEventListener('load', function() {
            const uploader = new uppload_Uppload({
                lang: uppload_en,
                uploader: uppload_fetchUploader({endpoint: "/picture" }),
                bind: ".uppload-image",
                call: "#uppload-button"
            });
            uploader.use([new uppload_Local(), new uppload_Camera(), new uppload_Crop({
                aspectRatio: 1,
                hideAspectRatioSettings: true
            })]);
        });

        function validateUserForm() {
            if ($('#userPassword').val() != $('#userPasswordC').val()) {
                $('#userPassword').addClass('is-invalid');
                $('#userPasswordC').addClass('is-invalid');
                $('#unmatchPasswdMsg').removeClass('d-none');
            } else {
                $('#save').click();
            }
        }
    </script>

</body>

</html>
