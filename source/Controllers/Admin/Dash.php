<?php

namespace Source\Controllers\Admin;

use Source\Models\Admin\User;
use Source\Models\Report\Online;

class Dash extends Admin
{

    public function home(): void
    {

        $head = $this->seo->optimize(
            "Dashboard | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("dash.home"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/dash/home", [
            "head" => $head,
            "users" => (object)[
                "users" => (new User())->find()->count()
            ],
            "online" => (new Online())->findByActive(),
            "onlineCount" => (new Online())->findByActive(true)
        ]);
    }


    public function profile()
    {
        $head = $this->seo->optimize(
            "Dashboard | " . ADMIN['name'],
            ADMIN['desc'],
            $this->router->route("dash.profile"),
            asset("admin/images/shared.jpg"),
        )->render();

        echo $this->view->render("admin/dash/profile", [
            "head" => $head
        ]);
    }
}
