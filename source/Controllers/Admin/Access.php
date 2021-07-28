<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Models\Admin\User;

class Access extends Controller
{

    /**
     * @param mixed $router     * 
     * @return [type]
     */
    public function __contruct($router)
    {
        parent::__construct($router);
    }

    /**
     * @return void
     */
    public function login(): void
    {
        $head = $this->seo->optimize(
            "Faça Login | " . url("name"),
            url("desc"),
            $this->router->route("access.login"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/access/login", [
            "head" => $head,
            "cookie" => filter_input(INPUT_COOKIE, "authEmail")
        ]);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $head = $this->seo->optimize(
            "Cadastre-se | " . ADMIN["name"],
            ADMIN['desc'],
            $this->router->route("access.register"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/access/register", [
            "head" => $head
        ]);
    }

    /**
     * @return void
     */
    public function forget(): void
    {
        $head = $this->seo->optimize(
            "Recuperar senha | " . ADMIN["name"],
            ADMIN['desc'],
            $this->router->route("access.register"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/access/forget", [
            "head" => $head
        ]);
    }

    /**
     * @return void
     */
    public function reset($data): void
    {

        if (empty($_SESSION["forget"])) {
            flash("info", "Informe seu e-mail para recuperar a senha");
            $this->router->redirect("access.forget");
        }

        $errForget = "Não foi possivel recuperar, tente novamente";

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget = filter_var($data["forget"], FILTER_DEFAULT);

        if (empty($email) || empty($forget)) {
            flash("error", $errForget);
            $this->router->redirect("access.forget");
        }

        $user = (new User())->find("email = :e AND forget = :f", "e={$email}&f={$forget}")->fetch();

        if (!$user) {
            flash("error", $errForget);
            $this->router->redirect("access.forget");
        }

        $head = $this->seo->optimize(
            "Nova Senha | " . ADMIN["name"],
            ADMIN['desc'],
            $this->router->route("access.register"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/access/reset", [
            "head" => $head
        ]);
    }

    public function manifest(?array $data)
    {
        var_dump($data);
    }


}
