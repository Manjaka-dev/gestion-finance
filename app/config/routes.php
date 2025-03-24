<?php

use app\controllers\ApiExampleController;
use app\Controllers\TestController;
use flight\Engine;
use flight\net\Router;
use app\controllers\EmployeController;

/** 
 * @var Router $router 
 * @var Engine $app
 */


 $test = new TestController($app);
 $router->get('/', [$test, 'selectionDept']);


$router->group('/employe', function() use ($router, $app) {
	$Employe_Controller = new EmployeController();
	$router->get('/', [ $Employe_Controller, 'getFormulaireLogin']);
	$router->post('/doLogin', [ $Employe_Controller, 'login' ]);
	$router->get('/accueil', [ $Employe_Controller, 'getAccueil']);
	$router->get('/logout', [ $Employe_Controller, 'logout' ]);
});
