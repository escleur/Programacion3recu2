<?php

use Config\Database;
use Slim\Factory\AppFactory;
use Middlewares\JsonMiddleware;
use Slim\Routing\RouteCollectorProxy;
use Middlewares\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Enum\UserRole;

use Controllers\LoginController;
use Controllers\MascotaController;
use Controllers\UsuarioController;
use Controllers\TurnoController;

use Illuminate\Support\Facades\Auth;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Servicio funcando correctamente.");
    return $response;
});

$conn = new Database();


$app->group('/usuario', function(RouteCollectorProxy $group){
    $group->get('[/]', UsuarioController::class . ":getAll");

    $group->post('[/]', UsuarioController::class . ":addOne");

    $group->get('/{id}', UsuarioController::class . ":getOne");

    $group->put('/{id}', UsuarioController::class . ":updateOne");

    $group->delete('/{id}', UsuarioController::class . ":deleteOne");
})->add(new JsonMiddleware);

$app->group('/login', function(RouteCollectorProxy $group){
    $group->post('[/]', LoginController::class . ":login");
})->add(new JsonMiddleware);

$app->group('/mascota', function(RouteCollectorProxy $group){
    $group->post('[/]', MascotaController::class . ":addOne");
})->add(new AuthMiddleware([UserRole::ADMIN]))->add(new JsonMiddleware);

$app->group('/turno', function(RouteCollectorProxy $group){
    $group->post('[/]', TurnoController::class . ":addOne")->add(new AuthMiddleware([UserRole::CLIENTE]));
})->add(new JsonMiddleware);


/*
$app->group('/mesa', function(RouteCollectorProxy $group){
    $group->get('[/]', MesaController::class . ":getAll");

    $group->post('[/]', MesaController::class . ":addOne")->add(new AuthMiddleware([UserRole::ADMIN]));

    $group->get('/{id}', MesaController::class . ":getOne");

    $group->put('/{id}', MesaController::class . ":updateOne")->add(new AuthMiddleware([UserRole::ADMIN]));

    $group->delete('/{id}', MesaController::class . ":deleteOne")->add(new AuthMiddleware([UserRole::ADMIN]));
})->add(new JsonMiddleware);

$app->group('/comida', function(RouteCollectorProxy $group){
    $group->get('[/]', ComidaController::class . ":getAll");

    $group->post('[/]', ComidaController::class . ":addOne")->add(new AuthMiddleware([UserRole::ADMIN]));

    $group->get('/{id}', ComidaController::class . ":getOne");

    $group->put('/{id}', ComidaController::class . ":updateOne")->add(new AuthMiddleware([UserRole::ADMIN]));

    $group->delete('/{id}', ComidaController::class . ":deleteOne")->add(new AuthMiddleware([UserRole::ADMIN]));
})->add(new JsonMiddleware);

$app->post('/pedido[/]', PedidoController::class . ":addOne");
*/

$app->addBodyParsingMiddleware();
$app->run();





// $app->group('/users', function (RouteCollectorProxy $group) {
//     $group->get('[/]', UserController::class . ":getAll"); //->add(new AuthMiddleware([UserRole::ADMIN]));
//     $group->post('[/]', UserController::class . ":addOne");
//     $group->delete('/{id}', UserController::class . ":deleteOne");
// });

// $app->group('/auth', function (RouteCollectorProxy $group) {
//     $group->post('[/]', LoginController::class . ":login");
//     $group->get('[/]', LoginController::class . ":getRole"); //->add(new AuthMiddleware([UserRole::ADMIN]));
// });
