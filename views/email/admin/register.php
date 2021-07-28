<?php $v->layout("email/admin/_theme", ["title" => "Cadastro efeutado na Plataforma ".SITE["name"].""]); ?>
<h1>IMPORTANTE</h1>
<h2>Olá Sr(a), <?= $name; ?>!</h2>
<p>Você está recebendo este e-mail pois foi realizado um cadastro no site <?=SITE["name"]?>.</p>
<p>Vamos confirmar seu cadastro?</p>
<p>É importante confirmar seu cadastro para ativar as notificações. Assim podemos enviar a você avisos de vencimentos e muito mais.</p>
<p><a title='Confirmar Cadastro' href='<?= $confirm_link; ?>'>CLIQUE AQUI PARA CONFIRMAR</a></p>
