<?php $v->layout("admin/_access"); ?>

<h4>Novo por aqui?</h4>
<h6 class="font-weight-light">Inscrever-se é fácil. Leva apenas alguns passos</h6>
<form class="pt-3" action="<?= $router->route("auth.register"); ?>" novalidate="" method="post" autocomplete="off">
    <?= csrf_input(); ?>
    <div class="form-group">
        <input id="first_name" type="text" class="form-control form-control-lg" name="first_name" required autofocus placeholder="Nome" autofocus>
        <div class="invalid-feedback">
            Informe seu Nome
        </div>
    </div>
    <div class="form-group">
        <input id="last_name" type="text" class="form-control form-control-lg" name="last_name" required autofocus placeholder="Sobrenome">
        <div class="invalid-feedback">
            Informe seu Sobrenome
        </div>
    </div>
    <div class="form-group">
        <input id="email" type="email" class="form-control form-control-lg" name="email" required placeholder="E-mail">
        <div class="invalid-feedback">
            Informe seu E-mail
        </div>
    </div>

    <div class="form-group">
        <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Sua senha" required data-eye>
        <div class="invalid-feedback">
            Informe sua senha
        </div>
    </div>

    <div class="form-group">
        <input id="password" type="password" class="form-control form-control-lg" name="password_re" placeholder="Confirme sua senha" required data-eye>
        <div class="invalid-feedback">
            Confirme sua senha
        </div>
    </div>

    <div class="form-group">
        <div class="form-check form-check-primary">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="accept" id="accept">
                <i class="input-helper"></i>Declaro que li e concordo com os <a href="<?= $router->route("access.forget") ?>" class="text-black">termos de uso e política de privacidade</a> da plataforma.</label>
        </div>
    </div>

    <div class="mb-2">
        <div class=" ajax_response"><?= flash(); ?></div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">CADASTRAR</a>
    </div>
    <div class="text-center mt-4 font-weight-light">
        <div class="row">
            <div class="col-6"><a href="<?= $router->route("access.forget") ?>" class="float-left">Esqueceu a senha?</a></div>
            <div class="col-6"><a href="<?= $router->route("access.login") ?>" class="float-right">Voltar e Logar</a></div>
        </div>
    </div>
</form>