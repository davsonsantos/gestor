<?php

namespace Source\Controllers\Admin;

use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Admin\User;
use \Datetime;
use Source\Support\Email;

/**
 * [Class Auth]
 * @author Davson N. Santos <contato@davtech.com.br>
 */
class Auth extends Controller
{

    /**
     * @param mixed $router
     * @return [type]
     */
    public function __contruct($router)
    {
        parent::__construct($router);
    }

    /**
     *
     * @param type $data
     * @return void
     */
    public function login($data): void
    {
        if (!empty($data['csrf'])) {
            $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
            $password = filter_var($data["password"], FILTER_DEFAULT);

            if (request_limit("weblogin", 5, 60 * 5)) {
                echo $this->ajaxResponse([
                    "type" => "warning",
                    "message" => "Você já efetuou 5 tentativas, esse é o limite. Por favor, aguarde 5 minutos para tentar novamente!"
                ]);
                return;
            }

            if (!$email || !$password) {
                echo $this->ajaxResponse([
                    "type" => "info",
                    "message" => "Informe seu e-mail e senha para logar",
                ]);
                return;
            }

            $user = (new User())->find("email = :e", "e={$email}")->fetch();
            $user->last_access = (new DateTime())->format('Y-m-d H:i:s');
            $user->save();
            if (!$user || !password_verify($password, $user->password)) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" => "E-mail ou senha informado não conferem",
                ]);
                return;
            }

            if (!$user || $user->level < 5) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" => "Você não permissão de acesso",
                ]);
                return;
            }

            if (!$user || $user->status == "registered") {
                echo $this->ajaxResponse([
                    "type" => "warning",
                    "message" => "<strong>IMPORTANTE</strong>: Acesse seu e-mail para confirmar seu cadastro e ativar todos os recursos.",
                ]);
                return;
            }

            $save = (!empty($data['remember']) ? true : false);
            if ($save) {
                setcookie("authEmail", $email, time() + 604800, "/");
            } else {
                setcookie("authEmail", null, time() - 3600, "/");
            }

            (new Session())->set("authUser", $user->id);
            echo $this->ajaxResponse([
                "type" => "success",
                "message" => "Bem vindo de volta {$user->first_name} {$user->last_name}",
                "redirect" => $this->router->route("dash.home")
            ]);
        }else{
            echo $this->ajaxResponse([
                "type" => "danger",
                "message" => "<strong>ERRO</strong>: Token Inválido, atualize a página e tente novamente.",
            ]);
            return;
        }
    }

    /**
     * @param type $data
     * @return void
     */
    public function register(array $data): void
    {
        if (!empty($data['csrf'])) {
            $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (!csrf_verify($data)) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" => "Erro ao enviar, favor use o formulário"
                ]);
                return;
            }

            if (in_array("", $data)) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" => "Preencha todos os campos."
                ]);
                return;
            }

            if ($data["password"] != $data["password_re"]) {
                echo $this->ajaxResponse([
                    "type" => "warning",
                    "message" => "As senha devem ser iguais."
                ]);
                return;
            }

            if (empty($data['accept'])) {
                echo $this->ajaxResponse([
                    "type" => "info",
                    "message" => "Aceite os termos de provacidade da plataforma."
                ]);
                return;
            }

            if (!is_email($data['email'])) {
                echo $this->ajaxResponse([
                    "type" => "warning",
                    "message" => "Seu e-mail informado não é válido"
                ]);
                return;
            }


            $user = new User;
            if ($user->find("email = :email", "email={$data['email']}")->count() == 1) {
                echo $this->ajaxResponse([
                    "type" => "warning",
                    "message" => "O e-mail informado não está cadastrado"
                ]);
                return;
            }

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->password = $data["password"];
            $user->status = "registered";
            $user->level = 5;

            if (!$user->save()) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" => $user->fail()->getMessage()
                ]);
                return;
            }

            $email = new Email();
            $email->add(
                "Confirme seu cadastro sr(a). {$data['first_name']}",
                $this->view->render("email/admin/register", [
                    "name" => $data["first_name"],
                    "confirm_link" => url("/admin/confirma/" . base64_encode($data['email']))
                ]),
                "{$data['first_name']} {$data['last_name']}",
                $data['email']
            )->send();

            if ($email->error()) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" => "Encontramos um erro ao enviar o e-mail de confirmação, entre em contato com o suporte através do e-mail " . ADMIN['email']
                ]);
                return;
            }

            echo $this->ajaxResponse([
                "redirect" => $this->router->route("optin.thanks")
            ]);
        }
    }


    /**
     * @param mixed $data
     * @return void
     */
    public function forget($data): void
    {
        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo $this->ajaxResponse([
                "type" => "danger",
                "message" => "Informe SEU E-EMAIL para recuperar a senha"
            ]);
            return;
        }

        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if (!$user) {
            echo $this->ajaxResponse([
                "type" => "warning",
                "message" => "O e-mail informado não esta cadastrado"
            ]);
            return;
        }

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION["forget"] = $user->id;

        $email = new Email();
        $email->add(
            "Recupere sua senha | " . ADMIN["name"],
            $this->view->render("email/admin/reset", [
                "user" => $user,
                "link" => $this->router->route("access.reset", [
                    "email" => $user->email,
                    "forget" => $user->forget
                ])
            ]),
            "{$user->first_name} {$user->last_name}",
            $user->email
        )->send();

        echo $this->ajaxResponse([
            "type" => "success",
            "message" => "Enviamos um link de recuperação para seu e-mail"
        ]);
        return;
    }

    /**
     * @param mixed $data
     * @return void
     */
    public function reset($data): void
    {
        if (empty($_SESSION["forget"]) || !$user = (new User)->findById($_SESSION["forget"])) {
            flash("error", "Não foi possivel recuperar, tente novamente");
            echo $this->ajaxResponse([
                "redirect" => $this->router->route("access.forget")
            ]);
            return;
        }

        if (empty($data["password"]) || empty($data["password_re"])) {
            echo $this->ajaxResponse([
                "type" => "warning",
                "message" => "Informe e repita sua nova senha"
            ]);
            return;
        }

        if ($data["password"] != $data["password_re"]) {
            echo $this->ajaxResponse( [
                "type" => "warning",
                "message" => "Você informou senhas diferentes"
            ]);
            return;
        }


        $user->password = $data["password"];
        $user->forget = null;

        if (!$user->save()) {
            echo $this->ajaxResponse( [
                "type" => "danger",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        unset($_SESSION["forget"]);
        flash("success", "Sua senha foi atualizada com sucesso");
        echo $this->ajaxResponse([
            "redirect" => $this->router->route("access.login")
        ]);
    }
}
