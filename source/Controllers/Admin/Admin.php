<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Admin\User;
use Source\Models\Report\Access;
use Source\Models\Report\Online;
use Source\Controllers\Admin\Auth;

/**
 * Class Admin
 * @package Source\App\Admin
 */
class Admin extends Controller
{

    /** @vat User **/
    // protected $user;

    /**
     * Admin constructor.
     */
    public function __construct($router)
    {
        parent::__construct($router);
        $session = new Session();

        if (empty($session->__get('authUser')) || !$this->user = (new User())->findById($session->__get('authUser'))) {
            flash("danger", "Acesso negado. Faça o login para acessar");
            $this->router->redirect("access.login");
        }

        (new Access())->report();
        (new Online())->report();

       
    }

    public function logoff(): void
    {
        unset($_SESSION["authUser"]);

        flash("info", "Você saiu com sucesso, volte logo {$this->user->first_name}");
        $this->router->redirect("access.login");
    }
}
