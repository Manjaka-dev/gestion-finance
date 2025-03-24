<?php

use app\controllers\ApiExampleController;
use flight\Engine;
use flight\net\Router;
use app\controllers\EmployeController;

/** 
 * @var Router $router 
 * @var Engine $app
 */



$router->group('/employe', function() use ($router, $app) {
	$Employe_Controller = new EmployeController();
	$router->get('/', [ $Employe_Controller, 'getFormulaireLogin']);
	$router->post('/doLogin', [ $Employe_Controller, 'login' ]);
	$router->get('/accueil', [ $Employe_Controller, 'getAccueil']);

});