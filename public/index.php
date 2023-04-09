<?php



require __DIR__ . '/../vendor/autoload.php';



use Dupot\StaticManagementFramework\Application;
use Dupot\StaticManagementFramework\Http\Request;
use Dupot\StaticManagementFramework\Http\Response;
use Dupot\StaticManagementFramework\Setup\ConfigManager;
use Dupot\StaticManagementFramework\Setup\RouteManager;

try {
    session_start();

    define('ROOT_PATH', __DIR__ . '/../');


    $debug = true;

    $request = new Request([
        Request::SOURCE_GET => $_GET,
        Request::SOURCE_POST => $_POST,
        Request::SOURCE_SESSION => $_SESSION,
        Request::SOURCE_SERVER => $_SERVER
    ]);

    $routeManager = new RouteManager();
    $routeManager->loadConfigFromJson(__DIR__ . '/../src/conf/routing.json');

    $config = new ConfigManager();
    $config->loadConfigFromIni(__DIR__ . '/../src/conf/path.ini');

    $config->setSectionParam('path', 'root', ROOT_PATH);


    $application = new Application([
        Application::CONFIG_MANAGER => $config,
        Application::ROUTE_MANAGER => $routeManager,
        Application::REQUEST => $request,
        Application::RESPONSE => new Response()
    ]);
    $application->run();
} catch (Exception $e) {

    if ($debug) {
        print_r($e, true);
    }
}
