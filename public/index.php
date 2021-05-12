<?php
declare(strict_types=1);

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
// se inicia el contenedor
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Set up settings
// instancio la configuracion que es una funcion que recibe u parametro
$settings = require __DIR__ . '/../app/settings.php';
// se ejecuta y se le pasa el container builder para insertar la conf en el contenedor
$settings($containerBuilder);

// Set up dependencies
// se instania las dependencias que es un a funcion que recibe un parametro
$dependencies = require __DIR__ . '/../app/dependencies.php';
// se ejecuta la funcion y se pasa el contenedor 
$dependencies($containerBuilder);

// Set up repositories
// se instania los repositories que es un a funcion que recibe un parametro
$repositories = require __DIR__ . '/../app/repositories.php';
// se ejecuta la funcion y se pasa el contenedor 
$repositories($containerBuilder);

// Build PHP-DI Container instance
// se contruye el contenedor con todo lo que se le cargo 
$container = $containerBuilder->build();

// Instantiate the app
// se agrega el contenedor a la aplicacion 
AppFactory::setContainer($container);
//inicia aplicacion 
$app = AppFactory::create();
//se indica path de la aplicacion (ejemplo cuando esta en una subcarpeta de la raiz)
$app->setBasePath('/mp-slim');

$callableResolver = $app->getCallableResolver();

// Register middleware
// se instancia los middlewares reagistra los middlewares 
$middleware = require __DIR__ . '/../app/middleware.php';
//se le pasa la aplicacion para agregr estos middleware de forma global
$middleware($app);

// Register routes
//se registran los routers 
$routes = require __DIR__ . '/../app/routes.php';
// se ejecuta y se le envia la aplicacion para registrar los routes en ella
$routes($app);

//obtengo el objeto setting desde el con tenedor
/** @var SettingsInterface $settings */
$settings = $container->get(SettingsInterface::class);
//obtengo las variables desde el objeto configuracion 
$displayErrorDetails = $settings->get('displayErrorDetails');
$logError = $settings->get('logError');
$logErrorDetails = $settings->get('logErrorDetails');

// Create Request object from globals
$serverRequestCreator = ServerRequestCreatorFactory::create();
$request = $serverRequestCreator->createServerRequestFromGlobals();

// Create Error Handler
$responseFactory = $app->getResponseFactory();
$errorHandler = new HttpErrorHandler($callableResolver, $responseFactory);

// Create Shutdown Handler
$shutdownHandler = new ShutdownHandler($request, $errorHandler, $displayErrorDetails);
register_shutdown_function($shutdownHandler);

$app->addBodyParsingMiddleware();

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware($displayErrorDetails, $logError, $logErrorDetails);
$errorMiddleware->setDefaultErrorHandler($errorHandler);

// Run App & Emit Response
$response = $app->handle($request);
$responseEmitter = new ResponseEmitter();
$responseEmitter->emit($response);