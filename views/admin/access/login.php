<?php $v->layout("admin/_access"); ?>
<h4>Olá! vamos começar</h4>
<h6 class="font-weight-light">Informe seus dados de acesso.</h6>

<form class="pt-3" action="<?= $router->route("auth.login"); ?>" novalidate="" method="post" autocomplete="off">
    <?= csrf_input(); ?>
    <div class="form-group">
        <input id="email" type="email" class="form-control form-control-lg" name="email" value="<?= $cookie; ?>" placeholder="Seu E-mail" required autofocus>
        <div class="invalid-feedback">
            Informe seu E-mail
        </div>
    </div>
    <div class="form-group">
        <input id="password" type="password" class="form-control form-control-lg"" name=" password" placeholder="Sua senha" required data-eye>
        <div class="invalid-feedback">
            Informe sua senha
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">ACESSAR</button>
    </div>
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input" name="remember" id="remember" <?= (!empty($cookie) ? "checked" : ""); ?> />
                Salvar E-mail
            </label>
        </div>
        <a href="<?= $router->route("access.forget") ?>" class="auth-link text-black">Esqueceu a senha?</a>
    </div>
    <div class="mb-2">
        <div class=" ajax_response"><?= flash(); ?></div>
    </div>
    <div class="text-center mt-4 font-weight-light">
        Não tem conta? <a href="<?= $router->route("access.register") ?>" class="text-primary">Cadastre-se</a>
    </div>
</form>