<?php
namespace app\Controllers;

use Flight;
use flight\Engine;

class TestController 
{
    protected Engine $app;

    public function __construct($app) 
    {
        $this->app = $app;
    }

    public function selectionDept(){
        Flight::render('template', ['page' => 'choix_departement']);
    }
}
