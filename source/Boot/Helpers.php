<?php

/**
 * @return \Source\Models\User|null
 */
function user(): ?\Source\Models\Admin\User
{
    return \Source\Models\Admin\User::user();
}

/**
 * @param string $path
 * @return string
 */
function url(string $path = null): string
{
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        if ($path) {
            return SITE['root'] . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return SITE['root'];
    }

    if ($path) {
        return SITE['root'] . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return SITE['root'];
}


function gravatar($email): string
{
    $emailUser = user()->email;
    $thumbUser = user()->thumb;
    if(!$emailUser || !$thumbUser){
        $img = md5($email);
        return "<img class='img-radius' src='https://www.gravatar.com/avatar/{$img}?s=300&d=mp' />";
    }else{
        $photo = user()->thumb;
        $userPhoto = ($photo ? image($photo, 300, 300) : asset("images/avatar.jpg"));
        return "<img class='img-radius' src='{$userPhoto}' alt='". user()->first_name ." ". user()->last_name. "' title='". user()->first_name ." ". user()->last_name. "'>";
    }

}

/**
 *
 * @param string $imageUrl
 * @return string
 */
function routeImage(string $imageUrl): string
{
    return "https://via.placeholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";
}

/**
 * @param string $image
 * @param int $width
 * @param int|null $height
 * @return string
 */
function image(?string $image, int $width, int $height = null): ?string
{
    if ($image) {
        return url() . "/" . (new \Source\Support\Thumb())->make($image, $width, $height);
    }

    return null;
}

/**
 * @return string
 */
function url_back(): string
{
    return ($_SERVER['HTTP_REFERER'] ?? url());
}

/**
 *
 * @param string $path
 * @param type $time
 * @return string
 */
function asset(string $path, $time = true): string
{
    $file = SITE['root'] . "/views/_assets/{$path}";
    $fileOnDir = dirname(__DIR__, 1) . "/views/_assets/{$path}";
    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . filemtime($fileOnDir);
    }
    return $file;
}


/**
 *
 * @param string $path
 * @param type $time
 * @return string
 */
function assetCommon(string $path, $time = true): string
{
    $file = SITE['root'] . "/shared/common/{$path}";
    $fileOnDir = dirname(__DIR__, 1) . "/shared/common/{$path}";
    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . filemtime($fileOnDir);
    }
    return $file;
}


/**
 *
 * @param string $type
 * @param string $message
 * @return string|null
 */
function flash(string $type = null, string $message = null): ?string
{
    if ($type && $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];
        return null;
    }
    if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) {
        unset($_SESSION["flash"]);
        return "<div class=\"alert  alert-{$flash["type"]}\"> {$flash["message"]} </div>";
    }


    return null;
}

/**
 * @param string $key
 * @param int $limit
 * @param int $seconds
 * @return bool
 */
function request_limit(string $key, int $limit = 5, int $seconds = 60): bool
{
    $session = new \Source\Core\Session();
    if ($session->has($key) && $session->$key->time >= time() && $session->$key->requests < $limit) {
        $session->set($key, [
            "time" => time() + $seconds,
            "requests" => $session->$key->requests + 1
        ]);
        return false;
    }

    if ($session->has($key) && $session->$key->time >= time() && $session->$key->requests >= $limit) {
        return true;
    }

    $session->set($key, [
        "time" => time() + $seconds,
        "requests" => 1
    ]);

    return false;
}

/**
 * ###################
 * ###   REQUEST   ###
 * ###################
 */

/**
 * @return string
 */
function csrf_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'/>";
}

/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool
{
    $session = new \Source\Core\Session();
    if (empty($session->csrf_token) || empty($request['csrf']) || $request['csrf'] != $session->csrf_token) {
        return false;
    }
    return true;
}

/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}


/**
 * ################
 * ###   DATE   ###
 * ################
 */

/**
 * @param string $date
 * @param string $format
 * @return string
 * @throws Exception
 */
function date_fmt(?string $date, string $format = "d/m/Y H\hi"): string
{
    $date = (empty($date) ? "now" : $date);
    return (new DateTime($date))->format($format);
}

/**
 * @param string $date
 * @return string
 * @throws Exception
 */
function date_fmt_br(?string $date): string
{
    $date = (empty($date) ? "now" : $date);
    return (new DateTime($date))->format(CONF_DATE_BR);
}

/**
 * @param string $date
 * @return string
 * @throws Exception
 */
function date_fmt_app(?string $date): string
{
    $date = (empty($date) ? "now" : $date);
    return (new DateTime($date))->format(CONF_DATE_APP);
}

/**
 * @param string|null $date
 * @return string|null
 */
function date_fmt_back(?string $date): ?string
{
    if (!$date) {
        return null;
    }

    if (strpos($date, " ")) {
        $date = explode(" ", $date);
        return implode("-", array_reverse(explode("/", $date[0]))) . " " . $date[1];
    }

    return implode("-", array_reverse(explode("/", $date)));
}

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * @param string $string
 * @return string
 */
function str_slug(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(
        ["-----", "----", "---", "--"],
        "-",
        str_replace(
            " ",
            "-",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}
/**
 * @param string|null $search
 * @return string
 */
function str_search(?string $search): string
{
    if (!$search) {
        return "all";
    }

    $search = preg_replace("/[^a-z0-9A-Z\@\ ]/", "", $search);
    return (!empty($search) ? $search : "all");
}

/*
 * Descreve nivel de usuário
 */

function getLevel($Level = null)
{
    $UserLevel = [
        1 => 'Cliente (user)',
        2 => 'Assinante (user)',
        3 => 'Gerente Geral (adm)',
        4 => 'Administrador (adm)',
        5 => 'Super Admin (adm)'
    ];

    if (!empty($Level)) :
        return $UserLevel[$Level];
    else :
        return $UserLevel;
    endif;
}

/**
 * @return array
 */
function genre(): array
{
    return ["male" => "Masculino", "female" => "Feminino", "other" => "Outro"];
}
/**
 * @return array
 */
function levels(): array
{
    return ["1" => "Cliente (user)", "2" => "Assinante (user)", "3" => "Gerente Geral (adm)", "4" => "Administrador (adm)", "5" => "Super Admin (adm)"];
}
/**
 * @return array
 */
function status(): array
{
    return ["registered" => "Registrado", "confirmed" => "Confirmado"];
}

/**
 * @param data $data
 * @return string
 */
function data_portuguese($data)
{
    date_default_timezone_set('America/Sao_Paulo');

    $data = new DateTime();
    $formatter = new IntlDateFormatter(
        'pt_BR',
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'America/Sao_Paulo',
        IntlDateFormatter::GREGORIAN
    );
    return $formatter->format($data);
}


function upload_mce($file)
{
    if (!empty($file) && !empty($file["image"])) {

        $upload = new \CoffeeCode\Uploader\Image(UPLOAD_DIR["raiz"], "posts");
        if (empty($file["image"]['type']) || !in_array($file["image"]['type'], $upload::isAllowed())) {
            return "Selecione uma imagem válida";
        } else {
            $image = $upload->upload($file["image"], pathinfo($file["image"]['name'], PATHINFO_FILENAME), 1920);
        }

        if (!$image) {
            return "Erro ao enviar a imagem, selecione um arquivo .jpeg, .jpg ou .png";
        }

        $json["mce_image"] = '<img style="width: 100%;" src="' . url("/{$image}") . '" alt="{title}" title="{title}">';
        return $json["mce_image"];
    } else {
        return false;
    }
}
