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
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="<?= asset("images/logo.png") ?>" alt="<?=ADMIN['name']?>">
                            </div>
                            <?= $v->section("content"); ?>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <script src="<?= asset("admin/js/bundle.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.form.min.js") ?>"></script>
    <script src="<?= asset("admin/js/scripts.min.js") ?>"></script>
    <script src="<?= asset("js/form.js") ?>"></script>
   
</body>

</html>