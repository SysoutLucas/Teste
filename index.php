<?php 
require "vendor/autoload.php";
require "App/functions/fcomuns.php";

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\View\View;
use App\controller\ClienteController as Cliente;
use App\controller\DividaController as Divida;
$c = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($c);

ini_set("display_errors", 1);
error_reporting(E_ALL);

$app->get('/', function ($request, $response) {
    $View = new View();
    $View->render('login');
});
$app->get('/dashboard', function ($request, $response) {
    $View = new View();
    $Divida = new Divida;
    $Cliente = new Cliente;
    $d_quantidade = $Divida->getQtde()['quantidade'];
    $c_quantidade = $Cliente->getQtde()['quantidade'];
    $page_data = [
        "total_clientes" => $c_quantidade,
        "total_dividas" => $d_quantidade
    ];
    $View->render('dashboard',$page_data);
});

$app->group('/clientes', function() use ($app){
    $app->get('/add', function (){
        $Cliente = new Cliente;
        $Cliente->showAdd();
    });
    $app->post('/add', function ($request,$response){
        $Cliente =  new Cliente();
        $Cliente->add($request->getParsedBody());
    });
    $app->get('/list', function (){
        $Cliente = new Cliente;
        $Cliente->list();
    });
    $app->get('/edit/{id:[0-9]+}', function ($request,$response,$args){
        $Cliente = new Cliente;
        $Cliente->showEdit($args['id']);
    });
    $app->delete('/delete/{id:[0-9]+}', function ($resquest,$response,$args){
        $Cliente = new Cliente;
        $Cliente->delete($args['id']);
    });
    $app->get('/view/{id:[0-9]+}', function ($request,$response,$args){
        $Cliente = new Cliente;
        $Cliente->showView($args['id']);
    });
});

$app->group('/dividas', function() use ($app){
    $app->get('/add', function (){
        $Divida = new Divida;
        $Divida->showAdd();
    });
    $app->post('/add', function ($request,$response){
        $Divida =  new Divida();
        $Divida->add($request->getParsedBody());
    });
    $app->get('/list', function (){
        $Divida = new Divida;
        $Divida->list();
    });
    $app->get('/edit/{id:[0-9]+}', function ($request,$response,$args){
        $Divida = new Divida;
        $Divida->showEdit($args['id']);
    });
    $app->delete('/delete/{id:[0-9]+}', function ($resquest,$response,$args){
        $Divida = new Divida;
        $Divida->delete($args['id']);
    });
    $app->get('/view/{id:[0-9]+}', function ($request,$response,$args){
        $Divida = new Divida;
        $Divida->showView($args['id']);
    });
});

$app->run();