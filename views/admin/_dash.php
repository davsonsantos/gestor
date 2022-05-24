<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="base" href="<?= url(); ?>">

    <?= $head; ?>

    <link rel="icon" type="image/png" href="<?= asset("images/favicon.png") ?>" />

    <link rel="stylesheet" href="<?= asset("admin/css/style.css") ?>" />
    <link rel="stylesheet" href="<?= asset("css/style.min.css") ?>" />
    <link rel="stylesheet" type="text/css" href="<?= url("/shared/plugins/sweetalert2/sweetalert2.css") ?>">

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
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <nav class="pcoded-navbar">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <?php
                        // $photo = user()->thumb;
                        // $userPhoto = ($photo ? image($photo, 300, 300) : asset("images/avatar.jpg"));
                        echo gravatar(user()->email);
                        ?>
                        <!-- <img class="img-radius" src="<?= $userPhoto ?>" alt="<?= user()->first_name ?> <?= user()->last_name ?>" title="<?= user()->first_name ?> <?= user()->last_name ?>"> -->
                        <div class="user-details">
                            <span><?= user()->first_name ?> <?= user()->last_name ?></span>
                            <div id="more-details"><?= user()->skills ?? 'Usuário' ?><i class="fa fa-chevron-down m-l-5"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-unstyled">
                            <li class="list-group-item"><a href="#"><i class="feather icon-user m-r-5"></i>Perfil</a></li>
                            <li class="list-group-item"><a href="#"><i class="feather icon-settings m-r-5"></i>Configurações</a></li>
                            <li class="list-group-item"><a href="<?= $router->route("dash.logoff"); ?>"><i class="feather icon-log-out m-r-5"></i>Sair</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navegação</label>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $router->route("dash.home"); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Page layouts</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="layout-vertical.html" target="_blank">Vertical</a></li>
                            <li><a href="layout-horizontal.html" target="_blank">Horizontal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Usuários</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="<?= $router->route("users.list"); ?>">Lista</a></li>
                            <li><a href="<?= $router->route("users.user"); ?>">Novo</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">


        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="<?= $router->route("dash.home"); ?>" class="b-brand">
                <img src="<?= asset("images/logo-w.png") ?>" alt="<?= ADMIN['name'] ?>" title="<?= ADMIN['name'] ?>" class="logo" style="width:130px">
                <img src="<?= asset("images/favicon.png") ?>" alt="<?= ADMIN['name'] ?>" title="<?= ADMIN['name'] ?>" class="logo-thumb">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <span><img class="img-radius" src="<?= $userPhoto ?>" alt="<?= user()->first_name ?> <?= user()->last_name ?>" title="<?= user()->first_name ?> <?= user()->last_name ?>"></span>
                                <a href="<?= $router->route("dash.logoff"); ?>" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <li><a href="#" class="dropdown-item"><i class="feather icon-user"></i> Perfil</a></li>
                                <li><a href="#" class="dropdown-item"><i class="feather icon-mail"></i> Confirgurações</a></li>
                                <li><a href="<?= $router->route("dash.logoff"); ?>" class="dropdown-item"><i class="feather icon-lock"></i> Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <?= $this->section("content"); ?>
        </div>
    </div>




    <script src="<?= asset("admin/js/vendor-all.min.js") ?>"></script>
    <script src="<?= asset("admin/js/plugins/bootstrap.min.js") ?>"></script>
    <script src="<?= asset("admin//js/pcoded.min.js") ?>"></script>
    <script src="<?= asset("js/scripts.min.js") ?>"></script>
    <script src="<?= url("/shared/plugins/sweetalert2/sweetalert2.all.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.form.min.js") ?>"></script>
    <script src="<?= asset("js/form.js") ?>"></script>
    <!--  -->

    <!-- Apex Chart -->
    <!-- <script src="assets/js/plugins/apexcharts.min.js"></script> -->


    <!-- custom-chart js -->
    <!-- <script src="assets/js/pages/dashboard-main.js"></script> -->
</body>

</html>