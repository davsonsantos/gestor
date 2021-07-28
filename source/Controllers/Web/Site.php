<?php

namespace Source\Controllers\Web;

use Source\Core\Controller;

class Site extends Controller
{

    /**
     * @param mixed $router
     * @return [type]
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function home(): void
    {
        var_dump("PAGINA HOME");
    }


    /**
     * @param mixed $data
     * 
     * @return void
     */
    public function error($data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);
        var_dump($error);
        // $head = $this->seo->optimize(
        //     "Oooops {$error}" . site("name"),
        //     site("desc"),
        //     $this->router->route("web.error", ["errcode" => $error]),
        //     routeImage($error)
        // )->render();

        // echo $this->view->render("theme/error", [
        //     "head" => $head,
        //     "error" => $error
        // ]);
    }
}
