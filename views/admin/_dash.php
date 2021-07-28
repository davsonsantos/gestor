<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="base" href="<?= url(); ?>">

    <?= $head; ?>

    <link rel="stylesheet" href="<?= asset("/admin/css/style.min.css"); ?>" />
    <link rel="stylesheet" href="<?= asset("/admin/plugins/mdi/css/materialdesignicons.min.css"); ?>" />
    <link rel="stylesheet" href="<?= asset("/admin/plugins/feather/feather.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= url("/shared/plugins/sweetalert2/sweetalert2.css") ?>">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="icon" type="image/png" href="<?= asset("/images/favicon.png") ?>" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>

    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?= $router->route("dash.home"); ?>">
                    <img src="<?= asset("images/logo-w.png") ?>" alt="<?= ADMIN['name'] ?>" title="<?= ADMIN['name'] ?>" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="<?= $router->route("dash.home"); ?>">
                    <img src="<?= asset("images/favicon.png") ?>" alt="<?= ADMIN['name'] ?>" title="<?= ADMIN['name'] ?>" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="fa fa-bars"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="search">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Pesquisa..." aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown d-flex mr-4 ">
                        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <p class="mb-0 font-weight-normal float-left dropdown-header">Configurações</p>
                            <a class="dropdown-item preview-item" href="<?= $router->route("dash.profile") ?>">
                                <i class="fa fa-user"></i> Perfil
                            </a>
                            <a class="dropdown-item preview-item" href="<?= $router->route("dash.logoff") ?>">
                                <i class="fa fa-lock-open"></i> Sair
                            </a>
                        </div>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="fa fa-bars"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <div class="user-profile">
                    <div class="user-image">
                        <?php
                        $photo = user()->thumb;
                        $userPhoto = ($photo ? image($photo, 300, 300) : asset("images/avatar.jpg"));
                        ?>
                        <img src="<?= $userPhoto ?>" alt="<?= user()->first_name ?> <?= user()->last_name ?>" title="<?= user()->first_name ?> <?= user()->last_name ?>">
                    </div>
                    <div class="user-name"><?= user()->first_name ?> <?= user()->last_name ?></div>
                    <div class="user-designation"><?= user()->skills ?> </div>
                </div>
                <ul class="nav">
                    <li class="nav-item home">
                        <a class="nav-link" href="<?= url("admin/dash") ?>">
                            <i class="fa fa-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="fa fa-book menu-icon"></i>
                            <span class="menu-title">Artigos</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="<?=$router->route("blog.categories")?>">Categorias</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?=$router->route("blog.list")?>">Artigos</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("users.list"); ?>">
                            <i class="fa fa-users menu-icon"></i>
                            <span class="menu-title">Usuários</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->route("dash.logoff"); ?>">
                            <i class="fa fa-lock-open menu-icon"></i>
                            <span class="menu-title">Sair</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="main-panel">
                <?= flash(); ?>
                <?= $v->section("content"); ?>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <?= AGENCY['name'] ?></span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            <div id="data-hora"></div>
                        </span>
                    </div>
                </footer>
            </div>
        </div>
    </div>



    <script src="<?= asset("/admin/js/bundle.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.form.min.js") ?>"></script>
    <script src="<?= url("/shared/plugins/sweetalert2/sweetalert2.all.min.js") ?>"></script>
    <script src="<?= asset("/admin/js/scripts.min.js") ?>"></script>
    <script src="<?= asset("js/form.js") ?>"></script>
    <?= $v->section("scripts"); ?>
</body>

</html>