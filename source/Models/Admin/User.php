<?php

namespace Source\Models\Admin;

use CoffeeCode\DataLayer\DataLayer;
use Exception;
use Source\Core\Session;

/**
 * [Class User]
 * @package Source\Models\Admin
 */
class User extends DataLayer
{

    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "email", "password", "level"]);
    }

    /**
     * @return null|User
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return (new User())->findById($session->authUser);
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @return string|null
     */
    public function photo(): ?string
    {
        if ($this->thumb && file_exists(__DIR__ . "/../../" . UPLOAD_DIR["raiz"] . "/{$this->thumb}")) {
            return $this->photo;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->validateEmail() || !$this->validatePassword() || !parent::save()) {

            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    protected function validateEmail(): bool
    {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new Exception("Informe um e-mail válido");
            return false;
        }

        $userByEmail = null;
        if (!$this->id) {
            $userByEmail = $this->find("email = :email", "email={$this->email}")->count();
        } else {
            $userByEmail = $this->find("email = :email AND id != :id", "email={$this->email}&id={$this->id}")->count();
        }

        if ($userByEmail) {
            $this->fail = new Exception("O e-mail informado já está em uso");
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    protected function validatePassword(): bool
    {
        if (empty($this->password) || strlen($this->password) < 5) {
            $this->fail = new Exception("Informe uma senha com pelo menos 5 caracteres");
            return false;
        }

        if (password_get_info($this->password)["algo"]) {
            return true;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return true;
    }
}
