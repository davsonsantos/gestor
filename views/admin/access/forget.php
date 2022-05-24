<?php $this->layout("admin/_access", ['head' => $head]); ?>


<div class="col-md-12">
    <div class="card-body">
        <h4 class="mb-3 f-w-400">Não se preocupe!</h4>
        <h6 class="font-weight-light">Informe seu e-mail cadastrado que lhe enviamos um link.</h6>
        <hr>
        <form action="<?= $router->route("auth.forget"); ?>" novalidate method="post" autocomplete="off">
        <?= csrf_input(); ?>
            <div class="form-group mb-3">
                <input class="form-control" type="email" name="email" value="" placeholder="Seu E-mail" required autofocus>
            </div>
            <button class="btn btn-block btn-primary mb-4">ENVIAR LINK</button>
            <div class=" ajax_response"><?= flash(); ?></div>
            <hr>
        </form>
        <p class="mb-2 text-muted">Lembrou? <a href="<?= $router->route("access.login") ?>" class="f-w-400">Clique aqui.</a></p>
        <!-- <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p> -->
    </div>
</div>

<!-- <h4>Não se preocupe!</h4>
<h6 class="font-weight-light">Informe seu e-mail cadastrado que lhe enviamos um link.</h6>

<form class="pt-3" action="<?= $router->route("auth.forget"); ?>" novalidate="" method="post" autocomplete="off">
    <div class="form-group">
        <input id="email" type="email" class="form-control form-control-lg" name="email" placeholder="Seu E-mail" required autofocus>
        <div class="invalid-feedback">
            Informe seu E-mail
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">ENVIAR LINK</button>
    </div>
    <div class="mb-2 mt-2">
        <div class=" ajax_response"><?= flash(); ?></div>
    </div>
    <div class="text-center mt-4 font-weight-light">
        <div class="row">
            <div class="col-6"><span class="float-left"> Não tem conta? <a href="<?= $router->route("access.register") ?>">Cadastre-se</a></span></div>
            <div class="col-6"><a href="<?= $router->route("access.login") ?>" class="float-right">Voltar e Logar</a></div>
        </div>
    </div>
</form> -->