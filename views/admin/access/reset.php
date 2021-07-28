<?php $v->layout("admin/_access"); ?>
<h4>Recupere sua senha</h4>
<h6 class="font-weight-light">Informe sua nova senha.</h6>

<form class="pt-3" action="<?= $router->route("auth.reset"); ?>" novalidate="" method="post" autocomplete="off">
    <?= csrf_input(); ?>
    <div class="form-group">
        <input id="password" type="password" class="form-control form-control-lg" name="password" value="" placeholder="Senha" required autofocus>
        <div class="invalid-feedback">
            Informe sus senha
        </div>
    </div>
    <div class="form-group">
        <input id="password" type="password" class="form-control form-control-lg"" name=" password_re" placeholder="Confirma senha" required data-eye>
        <div class="invalid-feedback">
            Confirme sua senha
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">ATUALIZAR SENHA</button>
    </div>
    
    <div class="mb-2 mt-2">
        <div class=" ajax_response"><?= flash(); ?></div>
    </div>
    <div class="text-center mt-4 font-weight-light">
        Você também pode <a href="<?= $router->route("access.login") ?>" class="text-primary">voltar e logar</a>
    </div>
</form>