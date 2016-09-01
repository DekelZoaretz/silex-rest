<?php

use Silex\Application;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Carbon\Carbon;
use App\Provider\Token;
use App\Provider\Log;

//Set to the wanted timezone http://php.net/manual/en/timezones.php
$timezone = 'Europe/London';

date_default_timezone_set($timezone);

define("ROOT_PATH", __DIR__ . "/..");

//handling CORS preflight request
$app->before(function (Request $request) {
    if ($request->getMethod() === "OPTIONS") {
        $response = new Response();
        $response->headers->set("Access-Control-Allow-Origin","*");
        $response->headers->set("Access-Control-Allow-Methods","GET,POST,PUT,DELETE,OPTIONS");
        $response->headers->set("Access-Control-Allow-Headers","Origin, X-Requested-With, Content-Type, Accept, Authorization, Store, If-Modified-Since, token, properties");
        $response->headers->set("Access-Control-Allow-Credentials","true");
        $response->setStatusCode(200);
        return $response->send();
    }
}, Application::EARLY_EVENT);

//handling CORS responses with right headers
$app->after(function (Request $request, Response $response) {
    $response->headers->set("Access-Control-Allow-Origin","*");
    $response->headers->set("Access-Control-Allow-Methods","GET,POST,PUT,DELETE,OPTIONS");
    $response->headers->set("Access-Control-Allow-Headers","Origin, X-Requested-With, Content-Type, Accept, Authorization, Store, If-Modified-Since, token, properties");
    $response->headers->set("Access-Control-Allow-Credentials","true");
});

//accepting JSON
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

ErrorHandler::register();
//  ExceptionHandler::register($app['debug']);

$app->register(new ServiceControllerServiceProvider());

$app->register(new DoctrineServiceProvider(), array(
    "db.options" => $app["db.options"]
));

$app->register(new HttpCacheServiceProvider(), array("http_cache.cache_dir" => ROOT_PATH . "/storage/cache",));

$app->register(new MonologServiceProvider(), array(
    "monolog.logfile" => ROOT_PATH . "/storage/logs/" . Carbon::now($timezone)->format("Y-m-d") . ".log",
    "monolog.level" => $app["log.level"],
    "monolog.name" => $app['log.name'],
));

$app['log'] = $app->share(function () use ($app) {
    return new Log($app);
});


$app['token'] = $app->share(function () use ($app) {
    return new Token($app['log'],$app['token.client.key'], $app['token.admin.key']);
});

$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

//load services
$servicesLoader = new App\ServicesLoader($app);
$servicesLoader->bindServicesIntoContainer();

//load routes
$routesLoader = new App\RoutesLoader($app);
$routesLoader->bindRoutesToControllers();

$app->error(function (\Exception $e, $code) use ($app) {
    $app['log']->error($e->getMessage() . ' - '. print_r($e->getTraceAsString(), true));
    $errorSchema = new \App\Schema\BaseSchema();
    return $errorSchema->error(2,'error');
});

return $app;