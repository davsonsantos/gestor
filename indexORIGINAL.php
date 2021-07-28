<?php

ob_start();
session_start();

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$router = new Router(url());

//** * ADMIN ROUTE ***/
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
/** * logoff**/
$router->get("/dash/sair", "Dash:logoff","dash.logoff");
/** * get erros**/
$router->get("/opsss/{errcode}", "Error:error","error.error");  

//** * ADMIN ROUTE ***/
$router->namespace("Source\Controllers\App");
$router->group("/app");
//** * login ***/
$router->get("/", "Access:login","access.login");
$router->get("/login", "Access:login","access.login");













// /** WEB ROUTES **/
// $router->namespace("Source\Controllers\Web");
// $router->group(null);
// $router->get("/","Site:home","site.home");


// /*** ADMIN ROUTE ***/
// $router->namespace("Source\Controllers\Admin");
// $router->group("/admin");

// /** * login ***/
// $router->get("/", "Access:login","access.login");
// $router->get("/login", "Access:login","access.login");
// $router->get("/cadastrar", "Access:register", "access.register");
// $router->get("/recuperar", "Access:forget","access.forget");
// $router->get("/senha/{email}/{forget}", "access:reset","access.reset");

// /** dashboard **/
// $router->get("/dash", "Dash:home","dash.home");
// $router->get("/dash/home", "Dash:home","dash.home");
// 






// /*** APP ROUTE ***/
// $router->namespace("Source\Controllers\App");
// $router->group("/app");

// /** * login ***/
// $router->get("/", "Login:root","login.root");
// $router->get("/login", "Login:root","login.root");


/*** ADMIN ROUTE ***/
// $router->namespace("Source\Controllers");
// $router->group("ops");
// $router->get("/{errcode}", "Error:error","error.error");    
/*
 * ROUTES PROVESS
 */
$router->dispatch();

/*
 * ERRORS PROCESS
 */
if($router->error()){
    $router->redirect("error.error",["errcode" => $router->error()]);
}
ob_end_flush();