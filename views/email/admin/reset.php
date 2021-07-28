<?php $v->layout("email/admin/_theme", ["title" => "Recupere sua senha da plataforma " . SITE["name"] . ""]); ?>
<h4>Presado(a) <?= $user->first_name; ?>,</h4>
<p>Recebemos em nosso site uma solicitação para recuperar sua senha, por favor, caso não tenha solicitado
    favor ignore este e-mail. Caso contrário...</p>
<p><a href="<?= $link; ?>" title="Recuperar Senha">CLIQUE AQUI PARA RECUPERAR SUA SENHA</a></p>