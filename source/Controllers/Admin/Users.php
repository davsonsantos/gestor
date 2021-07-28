<?php

namespace Source\Controllers\Admin;

use CoffeeCode\Paginator\Paginator;
use Source\Models\Admin\User;
use Source\Support\SSP;
use Source\Support\Thumb;

class Users extends Admin
{
    /**
     * @param mixed $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function list(?array $data): void
    {
        if (!empty($data['s'])) {
            $s = str_search($data['s']);
            echo $this->ajaxResponse(["redirect" => url("admin/dash/users/{$s}/1")]);
            return;
        }

        $search = null;
        $users = (new User())->find();

        if (!empty($data['search']) && str_search($data['search']) != "all") {
            $search = str_search($data['search']);
            $users = (new User())->find("MATCH(first_name, last_name,email) AGAINST(:s)", "s={$search}");
            if (!$users->count()) {
                flash("info", "Sua pesquisa não retornou resultados. <a class='alert-link' href=" . $this->router->route("users.list") . ">Voltar a lista de usuários</a>");
            }
        }

        $all = ($search ?? "all");
        $pager = new Paginator(url("admin/dash/users/{$all}/"));
        $pager->pager($users->count(), 10, (!empty($data["page"]) ? $data["page"] : 1), 2, "list");

        $head = $this->seo->optimize(
            "Usuários | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("users.list"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/users/list", [
            "head" => $head,
            "search" => $search,
            "users" => $users->order("first_name, last_name")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render(),
            "pages" => "Página " . $pager->page() . " de " . $pager->pages()
        ]);
    }



    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function user(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            // $this->create($data,$_FILES);

            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $userCreate = new User();
            $userCreate->first_name = $data["first_name"];
            $userCreate->last_name = $data["last_name"];
            $userCreate->email = $data["email"];
            $userCreate->password = $data["password"];
            $userCreate->level = $data["level"];
            $userCreate->genre = $data["genre"];
            $userCreate->datebirth = date_fmt_back($data["datebirth"]);
            $userCreate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            $userCreate->status = $data["status"];
            $userCreate->skills = $data["skills"];

            //upload photo
            if (!empty($_FILES['photo'])) {

                $upload = new \CoffeeCode\Uploader\Image(UPLOAD_DIR["raiz"], "images");

                $file = $_FILES['photo'];
                if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
                    echo "<p>Selecione uma imagem válida<p>";
                } else {
                    $userCreate->thumb = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), 350);
                }
            }


                if (!$userCreate->save()) {
                    echo $this->ajaxResponse([
                        "type" => "danger",
                        "message" =>  $userCreate->fail()->getMessage()
                    ]);
                    return;
                }

                $json['alert'] = ["success", "Usuário criado com sucesso..."];
                $json["redirect"] = url("/admin/dash/users/user/{$userCreate->id}");
                echo json_encode($json);
                return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userUpdate = (new User())->findById($data["user_id"]);

            if (!$userUpdate) {
                flash("warning","Você tentou gerenciar um usuário que não existe");
                echo $this->ajaxResponse([
                    "redirect" => $this->router->route("users.list")
                ]);
                return;
            }

            $userUpdate->first_name = $data["first_name"];
            $userUpdate->last_name = $data["last_name"];
            $userUpdate->email = $data["email"];
            $userUpdate->password = (!empty($data["password"]) ? $data["password"] : $userUpdate->password);
            $userUpdate->level = $data["level"];
            $userUpdate->genre = $data["genre"];
            $userUpdate->datebirth = date_fmt_back($data["datebirth"]);
            $userUpdate->document = preg_replace("/[^0-9]/", "", $data["document"]);
            $userUpdate->status = $data["status"];
            $userUpdate->skills = $data["skills"];

            //upload photo
            if (!empty($_FILES["photo"])) {
                if ($userUpdate->thumb && file_exists(__DIR__ . "/../../../{$userUpdate->thumb}")) {
                    unlink(__DIR__ . "/../../../{$userUpdate->thumb}");
                    (new Thumb())->flush($userUpdate->thumb);
                }

                $upload = new \CoffeeCode\Uploader\Image(UPLOAD_DIR["raiz"], "images");

                $file = $_FILES['photo'];
                if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
                    echo "<p>Selecione uma imagem válida<p>";
                } else {
                    $userUpdate->thumb = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), 350);
                }
            }

            if (!$userUpdate->save()) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" =>  $userUpdate->fail()->getMessage()
                ]);
                return;
            }
            $json['alert'] = ["success", "Usuário atualizado com sucesso..."];
            $json["reload"] = true;
            echo json_encode($json);
            return;
           
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $userDelete = (new User())->findById($data["user_id"]);

            if (!$userDelete) {
                $this->message->error("Você tentnou deletar um usuário que não existe")->flash();
                echo json_encode(["redirect" => $this->router->route("users.list")]);
                return;
            }

            if ($userDelete->thumb && file_exists(__DIR__ . "/../../../{$userDelete->thumb}")) {
                unlink(__DIR__ . "/../../../{$userDelete->thumb}");
                (new Thumb())->flush($userDelete->thumb);
            }

            $userDelete->destroy();

            $json['alert'] = ["success", "Usuário excluído com sucesso..."];
            $json["redirect"] = $this->router->route("users.list");
            echo json_encode($json);
            return;
        }

        $userEdit = null;
        if (!empty($data["user_id"])) {
            $userId = filter_var($data["user_id"], FILTER_VALIDATE_INT);
            $userEdit = (new User())->findById($userId);
        }

        $head = $this->seo->render(
            "Usuários | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("users.user"),
            asset("admin/images/shared.jpg"),
        );

        $genres = genre();
        $levels = levels();
        $status = status();

        echo $this->view->render("admin/users/user", [
            "head" => $head,
            "user" => $userEdit,
            "genres" => $genres,
            "levels" => $levels,
            "status" => $status
        ]);
    }


    public function search(): void
    {

        // DB table to use
        $table = 'users';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array(
                'db' => 'thumb',      'dt' => 0,
                'formatter' => function ($d, $row) {
                    $userPhoto = ($d ? image($d, 50, 50) : asset("images/avatar.jpg"));
                    return   "<img src='{$userPhoto}' />";
                }
            ),
            array(
                'db' => 'id',      'dt' => 1,
                'formatter' => function ($d, $row) {
                    $user = (new User())->findById($d);
                    return  "{$user->first_name} {$user->last_name}";
                }
            ),
            array('db' => 'email',      'dt' => 2),
            array('db' => 'level',      'dt' => 3),
            array(
                'db' => 'id',      'dt' => 4,
                'formatter' => function ($d, $row) {
                    $btnEdit = "<a href='" . $this->router->route("users.user") . "/{$d}' class='btn btn-warning btn-sm'><i class='fa fa-user-edit'></i> Editar</a>";
                    return  $btnEdit;
                }
            ),

        );

        echo json_encode(
            SSP::simple($_GET, $table, $primaryKey, $columns)
        );
    }
}
