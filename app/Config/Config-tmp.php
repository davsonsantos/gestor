<?php

//Pasta na qual seu projeto se encontra, se nor na root manter apenas uma barra /
define('BASE', '/php-moderno/'); 

//Diretório para o admin
define('ADMIN_BASE', '/php-moderno/admin-site/');

//Diretório para o site base com a url completa
define('HOST', 'http://localhost/php-moderno/');

//Quantidade de "pedaços/itens" a serem removidos da URL para o funcionamento das rotas
define('REMOVE_INDEX', 1); // Em prod colocar 0

//Quais são as áreas do site
define('AREAS', [
    //Como acessa na URL => Qual pasta dentro de app\Sites\ o módulo se encontra
    'admin-site' => 'Admin'
]);

//Qual o servidor do banco de dados
define('DB_HOST', '');

//Qual o usuário de acesso ao banco de dados
define('DB_USER', '');

//Qual a senha de acesso do banco de dados
define('DB_PASS', '');

//Qual o nome da base de dados na qual será feita a conexão 
define('DB_NAME', '');

//Qual é o timezone da aplicação
//https://www.php.net/manual/pt_BR/timezones.php
define('TIME_ZONE', 'America/Sao_Paulo');