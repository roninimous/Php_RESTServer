<?php
// Record errors to log file
include_once 'loginfo.php';
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
$app->get('/bookings', \RouteAction::class.":getBookings");
//$app->get('/bookings/keyword', \RouteAction::class.":getBookings");
$app->get("/bookings/keyword/{keyword}", \RouteAction::class.":searchBookings");
$app->post('/bookings', \RouteAction::class.":addBooking");
$app->get('/bookings/{id}', \RouteAction::class.":getBooking");
$app->put('/bookings/{id}', \RouteAction::class.":updateBooking");
$app->delete('/bookings/{id}', \RouteAction::class.":deleteBooking");

$app->post('/accounts', \RouteAction::class.":addUser");
$app->post("/accounts/user", \RouteAction::class.":searchAccounts");
// start the app
$app->run();

$app->get('/profileSetting/{id}', \RouteAction::class.":getProfile");