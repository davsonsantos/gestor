<?php

namespace Source\Controllers\Admin;

use CoffeeCode\Paginator\Paginator;
use Source\Models\Admin\Category;
use Source\Models\Admin\Post;
use Source\Models\Admin\User;
use Source\Support\Thumb;

class Blog extends Admin
{

    /**
     * @param array|null $data
     */
    public function list(?array $data): void
    {
        //search redirect
        if (!empty($data['s'])) {
            $s = str_search($data['s']);
            echo $this->ajaxResponse(["redirect" => url("admin/dash/blog/{$s}/1")]);
            return;
        }

        $search = null;
        $posts = (new Post())->find();

        if (!empty($data["search"]) && str_search($data["search"]) != "all") {
            $search = str_search($data["search"]);
            $posts = (new Post())->find("MATCH(title, subtitle) AGAINST(:s)", "s={$search}");
            if (!$posts->count()) {
                flash("info", "Sua pesquisa não retornou resultados. <a class='alert-link' href=" . $this->router->route("blog.list") . ">Voltar a lista de artigos</a>");
            }
        }

        $all = ($search ?? "all");
        $pager = new Paginator(url("admin/dash/blog/{$all}/"));
        $pager->pager($posts->count(), 10, (!empty($data["page"]) ? $data["page"] : 1), 2, "list");

        $head = $this->seo->render(
            ADMIN['name'] . " | Blog",
            ADMIN['desc'],
            $this->router->route("blog.list"),
            asset("admin/images/shared.jpg"),
        );
        echo $this->view->render("admin/blog/articles", [
            "head" => $head,
            "search" => $search,
            "posts" => $posts->limit($pager->limit())->offset($pager->offset())->order("post_at DESC")->fetch(true),
            "paginator" => $pager->render(),
            "pages" => "Página " . $pager->page() . " de " . $pager->pages()
        ]);
    }

    /**
     * @param array|null $data
     * 
     * @return void
     */
    public function article(?array $data): void
    {
        //MCE Upload
        if (!empty($data["upload"]) && !empty($_FILES["image"])) {
            $json["mce_image"] =  upload_mce($_FILES);
            echo json_encode($json);
            return;
        }

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $content = $data["content"];
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $postCreate = new Post();
            $postCreate->author_id = $data["author_id"];
            $postCreate->category_id = $data["category_id"];
            $postCreate->title = $data["title"];
            $postCreate->uri = str_slug($postCreate->title);
            $postCreate->subtitle = $data["subtitle"];
            $postCreate->content = str_replace(["{title}"], [$postCreate->title], $content);
            $postCreate->video = $data["video"];
            $postCreate->status = $data["status"];
            $postCreate->post_at = date_fmt_back($data["post_at"]);

            //upload photo
            if (!empty($_FILES['cover   '])) {

                $upload = new \CoffeeCode\Uploader\Image(UPLOAD_DIR["raiz"], "images");

                $file = $_FILES['photo'];
                if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
                    echo "<p>Selecione uma imagem válida<p>";
                } else {
                    $postCreate->cover = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), 1920);
                }
            }


            if (!$postCreate->save()) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" =>  $postCreate->fail()->getMessage()
                ]);
                return;
            }

            $json['alert'] = ["success", "Artigo criado com sucesso..."];
            $json["redirect"] = url("/admin/dash/blog/artigo/{$postCreate->id}");
            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $content = $data["content"];
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $postEdit = (new Post())->findById($data["post_id"]);

            if (!$postEdit) {
                flash("warning", "Você tentou gerenciar um usuário que não existe");
                echo $this->ajaxResponse([
                    "redirect" => $this->router->route("blog.list")
                ]);
                return;
            }

            $postEdit->author_id = $data["author_id"];
            $postEdit->category_id = $data["category_id"];
            $postEdit->title = $data["title"];
            $postEdit->uri = str_slug($postEdit->title);
            $postEdit->subtitle = $data["subtitle"];
            $postEdit->content = str_replace(["{title}"], [$postEdit->title], $content);
            $postEdit->video = $data["video"];
            $postEdit->status = $data["status"];
            $postEdit->post_at = date_fmt_back($data["post_at"]);
            
            //upload photo
            if (!empty($_FILES["cover"])) {
                if ($postEdit->cover && file_exists(__DIR__ . "/../../../{$postEdit->cover}")) {
                    unlink(__DIR__ . "/../../../{$postEdit->cover}");
                    (new Thumb())->flush($postEdit->cover);
                }

                $upload = new \CoffeeCode\Uploader\Image(UPLOAD_DIR["raiz"], "posts");

                $file = $_FILES['cover'];
                if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
                    echo "<p>Selecione uma imagem válida<p>";
                } else {
                    $postEdit->cover = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), 1920);
                }
            }
            
            if (!$postEdit->save()) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" =>  $postEdit->fail()->getMessage()
                ]);
                return;
            }
            $json['alert'] = ["success", "Post atualizado com sucesso..."];
            $json["reload"] = true;
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $postDelete = (new Post())->findById($data["post_id"]);

            if (!$postDelete) {
                $this->message->error("Você tentnou deletar um artigo que não existe")->flash();
                echo json_encode(["redirect" => $this->router->route("blog.list")]);
                return;
            }

            if ($postDelete->cover && file_exists(__DIR__ . "/../../../{$postDelete->cover}")) {
                unlink(__DIR__ . "/../../../{$postDelete->cover}");
                (new Thumb())->flush($postDelete->cover);
            }

            $postDelete->destroy();

            $json['alert'] = ["success", "Artigo excluído com sucesso..."];
            $json["redirect"] = $this->router->route("blog.list");
            echo json_encode($json);
            return;
        }

        $postEdit = null;
        if (!empty($data["post_id"])) {
            $postId = filter_var($data["post_id"], FILTER_VALIDATE_INT);
            $postEdit = (new Post())->findById($postId);
        }

        $head = $this->seo->render(
            "Usuários | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("users.user"),
            asset("admin/images/shared.jpg"),
        );

        echo $this->view->render("admin/blog/article", [
            "head" => $head,
            "post" => $postEdit,
            "categories" => (new Category())->find("type = :type", "type=post")->order("title")->fetch(true),
            "authors" => (new User())->find("level >= :level", "level=5")->order("first_name")->fetch(true)
        ]);
    }

    /**
     * @param array|null $data
     * 
     * @return void
     */
    public function categories(?array $data): void
    {
        $categories = (new Category())->find();
        $pager = new Paginator(url("admin/dash/blog/categorias/"));
        $pager->pager($categories->count(), 10, (!empty($data["page"]) ? $data["page"] : 1), 2, "list");

        $head = $this->seo->optimize(
            "Dashboard | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("blog.categories"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/blog/categories", [
            "head" => $head,
            "categories" => $categories->order("title")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render(),
            "pages" => "Página " . $pager->page() . " de " . $pager->pages()
        ]);
    }

    /**
     * @param array|null $data
     * @throws \Exception
     */
    public function category(?array $data): void
    {

        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $categoryCreate = new Category();
            $categoryCreate->title = $data["title"];
            $categoryCreate->uri = str_slug($categoryCreate->title);
            $categoryCreate->description = $data["description"];

            //upload photo
            if (!empty($_FILES['cover'])) {

                $upload = new \CoffeeCode\Uploader\Image(UPLOAD_DIR["raiz"], "images");

                $file = $_FILES['cover'];
                if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
                    echo "<p>Selecione uma imagem válida<p>";
                } else {
                    $categoryCreate->cover = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), 350);
                }
            }


            if (!$categoryCreate->save()) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" =>  $categoryCreate->fail()->getMessage()
                ]);
                return;
            }

            $json['alert'] = ["success", "Categoria criada com sucesso..."];
            $json["redirect"] = url("/admin/dash/blog/categoria/{$categoryCreate->id}");
            echo json_encode($json);
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryEdit = (new Category())->findById($data["category_id"]);

            if (!$categoryEdit) {
                $this->message->error("Você tentou editar uma categoria que não existe ou foi removida")->flash();
                echo json_encode(["redirect" => url("/admin/blog/categories")]);
                return;
            }

            $categoryEdit->title = $data["title"];
            $categoryEdit->uri = str_slug($categoryEdit->title);
            $categoryEdit->description = $data["description"];


            //upload photo
            if (!empty($_FILES["cover"])) {
                if ($categoryEdit->cover && file_exists(__DIR__ . "/../../../{$categoryEdit->cover}")) {
                    unlink(__DIR__ . "/../../../{$categoryEdit->cover}");
                    (new Thumb())->flush($categoryEdit->cover);
                }

                $upload = new \CoffeeCode\Uploader\Image(UPLOAD_DIR["raiz"], "images");

                $file = $_FILES['cover'];
                if (empty($file['type']) || !in_array($file['type'], $upload::isAllowed())) {
                    echo "<p>Selecione uma imagem válida<p>";
                } else {
                    $categoryEdit->cover = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), 350);
                }
            }

            if (!$categoryEdit->save()) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" =>  $categoryEdit->fail()->getMessage()
                ]);
                return;
            }

            $json['alert'] = ["success", "Categoria atualizada com sucesso..."];
            $json["reload"] = true;
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $categoryDelete = (new Category())->findById($data["category_id"]);

            if (!$categoryDelete) {
                echo $this->ajaxResponse([
                    "type" => "danger",
                    "message" =>  "A categoria não existe ou já foi excluída antes"
                ]);
                return;
            }

            if ($categoryDelete->posts()->count()) {
                $json['alert'] = ["info", "Não é possível remover pois existem artigos cadastrados"];
                echo json_encode($json);
                return;
            }

            if ($categoryDelete->cover && file_exists(__DIR__ . "/../../../{$categoryDelete->cover}")) {
                unlink(__DIR__ . "/../../../{$categoryDelete->cover}");
                (new Thumb())->flush($categoryDelete->cover);
            }

            $categoryDelete->destroy();

            $json['alert'] = ["success", "Categoria foi excluída com sucesso..."];
            $json["reload"] = true;
            echo json_encode($json);
            return;
        }

        $categoryEdit = null;
        if (!empty($data["category_id"])) {
            $categoryId = filter_var($data["category_id"], FILTER_VALIDATE_INT);
            $categoryEdit = (new Category())->findById($categoryId);
        }

        $head = $this->seo->render(
            "Categoria | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("blog.category"),
            asset("admin/images/shared.jpg"),
        );

        echo $this->view->render("admin/blog/category", [
            "head" => $head,
            "category" => $categoryEdit
        ]);
    }
}
