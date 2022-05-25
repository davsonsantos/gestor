<?php
/*
 * SERVER / LOCALHOST
 */

/**PARAMENTRO DE CONEXÃO**/
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define("CONF_DB_DRIVE", "mysql");
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_PORT", "3306");
    define("CONF_DB_NAME", "gestor");
    define("CONF_DB_USER", "root");
    define("CONF_DB_PASS", "");
    define("CONF_URL_ROOT", "https://localhost/projetos/gestor");
} else {
    define("CONF_DB_DRIVE", "mysql");
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_PORT", "3306");
    define("CONF_DB_NAME", "u470494612_gestor");
    define("CONF_DB_USER", "u470494612_gestor");
    define("CONF_DB_PASS", "Qo=7?7i9");
    define("CONF_URL_ROOT", "https://app.davtech.com.br/gestor");
}


/*
 * DATABASE CONECT
 */
define("DATA_LAYER_CONFIG", [
    "driver" => CONF_DB_DRIVE,
    "host" => CONF_DB_HOST,
    "port" => CONF_DB_PORT,
    "dbname" => CONF_DB_NAME,
    "username" => CONF_DB_USER,
    "passwd" => CONF_DB_PASS,
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/*
 * SITE CONFIG
 */
define("SITE", [
    "name" => "Gestor",
    "desc" => "Gerenciamento de conteúdo para sites e sistemas web",
    "domain" => CONF_URL_ROOT,
    "locale" => "pt_BR",
    "root" => CONF_URL_ROOT,
    "email" => "contato@davtech.com.br"
]);

/*
 * ADMIN CONFIG
 */
define("ADMIN", [
    "name" => "Gestor",
    "desc" => "Gerenciamento de conteúdo para sites e sistemas web",
    "email" => "contato@davtech.com.br",
    "addr_street" => "Enredeço do Negócio",
    "addr_number" => "XXX",
    "addr_complement" => "Complemento",
    "addr_city" => "Cidade",
    "addr_state" => "Estado",
    "addr_zipcode" => "00000-000"
]);

/**
 * APP CONFIG
 */
define("APP",[
        "name" => "APP Gestor",
        "desc" => "Gerenciamento de conteúdo para sites e sistemas web",
]);

/*
 * SOCIAL CONFIG
 */
define("SOCIAL", [
    "facebook_page" => "davtech.am",
    "facebook_author" => "davson.n.santos",
    "facebook_appId" => "123456789",
    "twitter_creator" => "davson.n.santos",
    "twitter_site" => "davsonsantos.com.br",
]);

/*
 * MAIL CONNECT
 */
// define("MAIL", [
//     "host" => "smtp.sendgrid.net",
//     "port" => "465",
//     "user" => "apikey",
//     "passwd" => "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",
//     "from_name" => "DavTech - Soluções Inteligentes",
//     "from_email" => "contato@davtech.com.br"
// ]);

define("MAIL", [
    "host" => "mail.smtp2go.com",
    "port" => "2525",
    "user" => "davtech.com.br",
    "passwd" => "IHzDA2KbcMYg",
    "from_name" => "DavTech - Soluções Inteligentes",
    "from_email" => "contato@davtech.com.br"
]);

/**AGENCY**/
define("AGENCY", [
    "name" => "DavTech - Soluções Inteligentes",
    "E-mail" => "contato@davtech.com.br",
    "site" => "https://www.davtech.com.br"
]);

/**
 * UPLOAD
 */
define("UPLOAD_DIR", [
    "raiz" => "storage",
    "images" => "images",
    "files" => "files",
    "medias" => "medias",
    "send" => "send"
]);

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", UPLOAD_DIR['raiz'] . "/" . UPLOAD_DIR['images'] . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");
