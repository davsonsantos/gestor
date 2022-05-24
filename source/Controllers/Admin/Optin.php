<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Models\Admin\User;

class Optin extends Controller
{

    /**
     * @param mixed $router
     * @return [type]
     */
    public function __contruct($router)
    {
        parent::__construct($router);
    }


    public function thanks(?array $data): void
    {
        $head = $this->seo->render(
            "Usuários | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("optin.thaks"),
            asset("admin/images/shared.jpg"),
        );
        echo $this->view->render("admin/optin/thanks", [
            "head" => $head
        ]);
    }

    public function confirm(?array $data)
    {

        $email = base64_decode($data["email"]);
        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if (!$user) {
            $process = "
            Não conseguimos validar seu e-mail.
            <p>Tente os seguinte procedimentos: 
            <ul>
                <li>Tente recuperar sua senha. <a class='alert-link' href='" . $this->router->route("access.forget") . "'>Clique aqui</a></li>
                <li>Refaça seu cadastro. <a class='alert-link' href='" . $this->router->route("access.register") . "'>Clique aqui</a></li>
                <li>Caso não consiga resolver entre em contato com nosso suporte pelo e-mail: <strong>" . ADMIN["email"] . "</strong></li>
            </ul>
            
            </p>
            ";
            flash("danger", $process);
            $this->router->redirect("access.login");
            return;
        }

        if ($user && $user->status != "confirmed") {
            $user->status = "confirmed";
            $user->save();
        }


        $head = $this->seo->render(
            "Usuários | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("optin.confirm"),
            asset("admin/images/shared.jpg"),
        );
        echo $this->view->render("admin/optin/confirm", [
            "head" => $head,
            "user" => $user
        ]);
    }
}
