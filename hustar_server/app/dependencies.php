<?php

// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

/* mike's
// Register component on container
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/templates/');
};
*/

//Register component on container
$container['view'] = function($container){
	$settings = $container->get('settings');
    $view = new \Slim\Views\PhpRenderer(__DIR__ . '/templates/');

	 return $view;
};


// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    
    //없데이트 이후 Twig_Extension_Debug() 사라짐
    //$view->addExtension(new Twig_Extension_Debug());

    return $view;
};


// Flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// PDO database library 
$container['db'] = function ($c) {
    $db = $c['settings']['dbSettings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
        
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};


// doctrine EntityManager
$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );
    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

//-----------------------------------------------------------------------------
// Model factories
// -----------------------------------------------------------------------------
$container['webModel'] = function ($container) {
    $settings = $container->get('settings');
    $webModel = new App\Model\WebModel($container->get('db'));
	
    return $webModel;
};

$container['backendModel'] = function ($container) {
    $settings = $container->get('settings');
    $backendModel = new App\Model\BackendModel($container->get('db'));
	
    return $backendModel;
};

$container['userManagementModel'] = function ($container) {
    $settings = $container->get('settings');
    $userManagementModel = new App\Model\UserManagementModel($container->get('db'));
	
    return $userManagementModel;
};

$container['deviceManagementModel'] = function ($container) {
    $settings = $container->get('settings');
    $deviceManagementModel = new App\Model\DeviceManagementModel($container->get('db'));
	
    return $deviceManagementModel;
};

$container['adminModel'] = function ($container) {
    $settings = $container->get('settings');
    $adminModel = new App\Model\AdminModel($container->get('db'));
	
    return $adminModel;
};


// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------

$container['App\Controller\HomeController'] = function ($c) {
    return new App\Controller\HomeController($c);
};

//Web controller
$container['App\Controller\WebController'] = function ($container) {
	$logger = $container->get('logger');
	$webModel = $container->get('webModel');
	$view = $container->get('view');

    return new App\Controller\WebController($logger, $webModel, $view);
};

//Backend controller
$container['App\Controller\BackendController'] = function ($container) {
	$logger = $container->get('logger');
	$backendModel = $container->get('backendModel');
	$view = $container->get('view');

    return new App\Controller\BackendController($logger, $backendModel, $view);
};

//UserManagement controller
$container['App\Controller\UserManagementController'] = function ($container) {
	$logger = $container->get('logger');
	$userManagementModel = $container->get('userManagementModel');
	$view = $container->get('view');

    return new App\Controller\UserManagementController($logger, $userManagementModel, $view);
};

//DeviceManagement Controller
$container['App\Controller\DeviceManagementController'] = function ($container) {
	$logger = $container->get('logger');
    $deviceManagementModel = $container->get('deviceManagementModel');
    $view = $container->get('view');    
    
    return new App\Controller\DeviceManagementController($logger, $deviceManagementModel, $view);
};

//Admin Controller
$container['App\Controller\AdminController'] = function ($container) {
	$logger = $container->get('logger');
    $adminModel = $container->get('adminModel');
    $view = $container->get('view');    
    
    return new App\Controller\AdminController($logger, $adminModel, $view);
};