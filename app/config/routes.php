<?php

use app\controllers\ApiExampleController;
use app\Controllers\TestController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

 $test = new TestController($app);
 $router->get('/', [$test, 'selectionDept']);