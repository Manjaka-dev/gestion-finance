<?php

use app\controllers\ApiExampleController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */
$router->get('/', function() use ($app) {
	$app->render('welcome', [ 'message' => 'You are gonna do great things!' ]);
});

$router->get('/hello-world/@name', function($name) {
	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
});

$router->group('/api', function() use ($router, $app) {
	$Api_Example_Controller = new ApiExampleController($app);
	$router->get('/users', [ $Api_Example_Controller, 'getUsers' ]);
	$router->get('/users/@id:[0-9]', [ $Api_Example_Controller, 'getUser' ]);
	$router->post('/users/@id:[0-9]', [ $Api_Example_Controller, 'updateUser' ]);
});

$router->group('/employe', function() use ($router, $app) {
	$Employe_Controller = new EmployeController();
	$router->get('/login', [ $Employe_Controller, 'getFormulaireLogin']);
	$router->post('/login', [ $Employe_Controller, 'login' ]);
});

$router->get('/loginEmp', function() use ($app) {
	$app->render('loginEmp');
});