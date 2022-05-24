<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;


$router = new Router(url());
/******************************************************************/
/**********************ROUTER CONTROLLERS WEB**********************/
/******************************************************************/
$router->namespace("Source\Controllers\Web");
$router->group(null);
/** web **/
$router->get("/", "Site:home", "site.home");
/** errors **/
$router->group("ops");
$router->get("/{errcode}", "Site:error", "site.error");


/******************************************************************/
/*********************ROUTER CONTROLLERS ADMIN*********************/
/******************************************************************/
$router->namespace("Source\Controllers\Admin");
$router->group("/admin");
//** * login ***/
$router->get("/", "Access:login","access.login");
$router->get("/login", "Access:login","access.login");
$router->get("/cadastrar", "Access:register", "access.register");
$router->get("/recuperar", "Access:forget","access.forget");
$router->get("/senha/{email}/{forget}", "access:reset","access.reset");
//** * optin **/
$router->get("/obrigado", "Optin:thanks","optin.thanks");
$router->get("/confirma/{email}", "Optin:confirm","optin.confirm");
//** * auth **/
$router->group(null);
$router->post("/login", "Auth:login","auth.login");
$router->post("/register", "Auth:register","auth.register");
$router->post("/forget", "Auth:forget","auth.forget");
$router->post("/reset", "Auth:reset","auth.reset");
//** * dashboard **/
$router->group("/admin");
$router->get("/dash", "Dash:home","dash.home");
$router->get("/dash/home", "Dash:home","dash.home");
$router->get("/dash/perfil", "Dash:profile","dash.profile");
/** * get users**/
$router->get("/dash/users", "Users:list","users.list");
$router->get("/dash/users/{search}/{page}", "Users:list","users.list");
$router->get("/dash/users/user","Users:user","users.user");
$router->get("/dash/users/user/{user_id}","Users:user","users.user");
/** * post users**/
$router->post("/dash/users", "Users:list","users.list");
$router->post("/dash/users/user","Users:user","users.user");
$router->post("/dash/users/user/{user_id}","Users:user","users.user");
/** * get articles **/
$router->get("/dash/blog", "Blog:list","blog.list");
$router->get("/dash/blog/{search}/{page}", "Blog:list","blog.list");
$router->get("/dash/blog/artigo", "Blog:article","blog.article");
$router->get("/dash/blog/artigo/{post_id}", "Blog:article","blog.article");
/** * post articles **/
$router->post("/dash/blog", "Blog:list","blog.list");
$router->post("/dash/blog/article","Blog:article","blog.article");
$router->post("/dash/blog/article/{post_id}","Blog:article","blog.article");
/** * get articles category **/
$router->get("/dash/blog/categorias", "Blog:categories","blog.categories");
$router->get("/dash/blog/categorias/{page}", "Blog:categories","blog.categories");
$router->get("/dash/blog/categoria", "Blog:category","blog.category");
$router->get("/dash/blog/categoria/{category_id}", "Blog:category","blog.category");
/** * post articles category **/
$router->post("/dash/blog/category", "Blog:category","blog.category");
$router->post("/dash/blog/category/{category_id}", "Blog:category","blog.category");



/** * logoff**/
$router->get("/dash/sair", "Dash:logoff","dash.logoff");
/** * get erros**/
$router->get("/opsss/{errcode}", "Error:error","error.error");


/******************************************************************/
/***********************ROUTER CONTROLLERS APP*********************/
/******************************************************************/
$router->namespace("Source\Controllers\App");
$router->group("/app");
//** * login ***/
$router->get("/", "Access:login","access.login");
$router->get("/login", "Access:login","access.login");



/** ROUTES PROVESS **/
$router->dispatch();

/** ERRORS PROCESS **/
if ($router->error()) {
    $router->redirect("site.error", ["errcode" => $router->error()]);
}

ob_end_flush();