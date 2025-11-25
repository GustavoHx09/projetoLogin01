<?php 
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

session_start();

$router = new Router();

/* 
* 
* --- ROTAS DE LOGIN ---
*
*/
// Redireciona para a página de login
$router->get('/', 'App\\Controllers\\HomeController@index');

// Validação do login
$router->get('/login', 'App\\Controllers\\TesteLoginController@show');
$router->post('/login', 'App\\Controllers\\TesteLoginController@login');

// Destroi a sessão
$router->get('/logout', 'App\\Controllers\\TesteLoginController@logout');

/*
* 
* --- ROTAS DE USUÁRIOS ---
*
*/
$router->get('/users', 'App\\Controllers\\UsersController@listar');
$router->get('/users/new', 'App\\Controllers\\UsersController@formNew');
$router->post('/users/new', 'App\\Controllers\\UsersController@cadastrar');
$router->get('/users/edit/{id}', 'App\\Controllers\\UsersController@formEdit');
$router->post('/users/edit/{id}', 'App\\Controllers\\UsersController@editar');
$router->post('/users/delete/{id}', 'App\\Controllers\\UsersController@delete');

/* 
* 
* --- ROTAS DE GRUPOS DE USUÁRIOS ---
*
*/
$router->get('/grupos', 'App\\Controllers\\GruposController@listar');
$router->get('/grupos/new', 'App\\Controllers\\GruposController@listGrupos');
$router->post('/grupos/new', 'App\\Controllers\\GruposController@cadastrar');
$router->get('/grupos/edit/{id}', 'App\\Controllers\\GruposController@form');
$router->post('/grupos/edit/{id}', 'App\\Controllers\\GruposController@editar');
$router->post('/grupos/delete/{id}', 'App\\Controllers\\GruposController@delete');



$router->run();