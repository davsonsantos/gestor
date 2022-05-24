<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="base" href="<?= url(); ?>">

    <?php echo $head; ?>

    <link rel="icon" type="image/png" href="<?= asset("images/favicon.png") ?>" />

    <link rel="stylesheet" href="<?= asset("admin/css/style.css") ?>" />
    <link rel="stylesheet" href="<?= asset("css/style.min.css") ?>" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body class="inner_page login">
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>

    <div class="auth-wrapper">
        <div class="auth-content text-center">
            <img src="<?= asset("images/logo.png") ?>" alt="<?= ADMIN['name'] ?>" title="<?= ADMIN['name'] ?>" class="img-fluid mb-4">
            <div class="card borderless">
                <div class="row align-items-center ">
                    <?= $this->section("content"); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" src="<?= asset("images/logo.png") ?>" alt="<?= ADMIN['name'] ?>" />
                        </div>
                    </div>
                    <?= $this->section("content"); ?>

                </div>
            </div>
        </div>
    </div> -->

    <script src="<?= asset("admin/js/vendor-all.min.js") ?>"></script>
    <script src="<?= asset("admin/js/plugins/bootstrap.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.form.min.js") ?>"></script>
    <script src="<?= asset("js/form.js") ?>"></script>

</body>

</html>