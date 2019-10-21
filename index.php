<?php

// register vendor directories
require __DIR__ . '/vendor/autoload.php';

// reference the RouteAction class
include_once 'app/RouteAction.php';

// Create instance of the SLIM app
$app = new \Slim\App;

// Need container to register my own classes
$container = $app->getContainer();
// Register RouteAction class with Slim
$container['RouteAction'] = function($c) {     
    return new RouteAction();
};

// Create the REST based route for the default URI
$app->get('/', \RouteAction::class.":index");
// Create the REST based route for a resource URI
$app->get('/data', \RouteAction::class.":getData");
$app->get('/contacts', \RouteAction::class.":getContacts");
// start the app
$app->run();
