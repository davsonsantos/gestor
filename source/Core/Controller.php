<?php

namespace Source\Core;

use CoffeeCode\Optimizer\Optimizer;
use CoffeeCode\Router\Router;
use League\Plates\Engine;

abstract class Controller
{

    /** @var Engine */
    protected $view;

    /** @var Router */
    protected $router;

    /** @var Optimizer */
    protected $seo;

    /**
     *
     * @param type $router
     */
    public function __construct($router)
    {
        $this->router = $router;
        // $this->view = Engine::create(dirname(__DIR__, 2) . "/views", "php");
        $this->view = new Engine(dirname(__DIR__, 2) . "/views", "php");


        $this->view->addData(["router" => $this->router]);

        $this->seo = new Optimizer();
        $this->seo->openGraph(url("name"), url("locale"),"article")
                ->publisher(SOCIAL['facebook_page'],SOCIAL['facebook_author'])
                ->twitterCard(SOCIAL["twitter_creator"],SOCIAL["twitter_site"], url("domain"))
                ->facebook(SOCIAL["facebook_appId"]);
    }

    /**
     *
     * @param string $param
     * @param array $values
     * @return string
     */
    public function ajaxResponse(array $param): string
    {
        return json_encode($param);
    }
    // public function ajaxResponse(string $param, array $values): string
    // {
    //     return json_encode([$param => $values]);
    // }
}
