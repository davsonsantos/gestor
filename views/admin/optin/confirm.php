<?php $v->layout("admin/_optin"); ?>

<h4 class="text-center mb-5">Tudo pronto. Obrigado por confirmar seu cadastro</h4>
<h6 class="font-weight-light mb-5 text-center" style="line-height:1.5rem">Bem vindo(a) <?="{$user->first_name} {$user->last_name}"?>, agora você tem acesso a plataforma</h6>
<div class="text-center"><a href="<?=$router->route("access.login")?>" class="btn btn-primary">ACESSAR AGORA</a></div>