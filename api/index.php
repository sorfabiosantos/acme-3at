<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
// timezone para São Paulo América
date_default_timezone_set('America/Sao_Paulo');

ob_start();

require  __DIR__ . "/vendor/autoload.php";

// os headers abaixo são necessários para permitir o acesso a API por clientes externos ao domínio
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Credentials: true'); // Permitir credenciais

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

use CoffeeCode\Router\Router;
// localhost/acme-3am/api
$route = new Router(url("api"),":");

$route->namespace("Source\Controller");

$route->group("/users");
$route->post("/register","Users:register"); // Registrar usuário comum
$route->post("/login","Users:auth"); // login de usuário comum
$route->put("/update","Users:update"); // update de usuário comum
$route->post("/register-admin","Users:registerAdmin"); // Registrar usuário admin NÃO IMPLEMENTADO
$route->post("/login-admin","Users:authAdmin"); // login de usuário admin
$route->put("/update-admin","Users:updateAdmin"); // update de usuário admin
$route->group(null);

$route->group("/address");
$route->post("/register","Addresses:register");
$route->put("/update","Addresses:update");
$route->get("/by-user","Addresses:getAddressByUserId");
$route->group(null);

// Início - Exercícios - Desafios
// Produtos
$route->group("/products");
$route->get("/list/{product_id}","Products:listById"); // select by id
$route->get("/list","Products:listAll"); // select all
$route->get("/list/paginator/{page}/{per_page}","Products:listPaginator"); // select all
$route->post("/","Products:insert"); // insert
$route->put("/{product_id}","Products:update"); // update
$route->delete("/{product_id}","Products:delete"); // update
$route->group(null);
// FAQs
$route->group("/faqs");
$route->get("/","Faqs:listAll");
$route->get("/{faqId}","Faqs:listById");
$route->get("/category/{categoryId}","Faqs:listByCategory");
$route->post("/","Faqs:insert");
$route->put("/{faqId}","Faqs:update");
$route->delete("/{faqId}","Faqs:delete");
$route->group(null);
// Categorias de FAQs
$route->group("/faqs-categories");
$route->get("/","FaqsCategories:listAll");
$route->get("/{categoryId}","FaqsCategories:listById");
$route->post("/","FaqsCategories:insert");
$route->put("/{categoryId}","FaqsCategories:update");
$route->delete("/{categoryId}","FaqsCategories:delete");
$route->group(null);

$route->dispatch();

/** ERROR REDIRECT */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "code" => 404,
        "status" => "not_found",
        "message" => "URL não encontrada"
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

}

ob_end_flush();