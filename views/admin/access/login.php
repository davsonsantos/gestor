<?php $this->layout("admin/_access", ['head' => $head]); ?>

<div class="col-md-12">
    <div class="card-body">
        <h4 class="mb-3 f-w-400">Acesso</h4>
        <hr>
        <form action="<?= $router->route("auth.login"); ?>" novalidate method="post" autocomplete="off">
        <?= csrf_input(); ?>
            <div class="form-group mb-3">
                <input class="form-control" type="email" name="email" value="<?= $cookie; ?>" placeholder="Seu E-mail" required autofocus>
                <!-- <div class="invalid-feedback">
                    Informe seu E-mail
                </div> -->
            </div>
            <div class="form-group mb-4">
                <input class="form-control" type="password" name="password" id="password" placeholder="Sua senha" required>
                <!-- <div class="invalid-feedback">
                    Informe sua Senha
                </div> -->
            </div>
            <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                <label class="custom-control-label" for="remember">Salvar E-mail.</label>
            </div>
            <button class="btn btn-block btn-primary mb-4">Acessar</button>
            <div class=" ajax_response"><?= flash(); ?></div>
            <hr>
        </form>
        <p class="mb-2 text-muted">Esqueceu a Senha? <a href="<?= $router->route("access.forget") ?>" class="f-w-400">Trocar</a></p>
        <!-- <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p> -->
    </div>
</div>