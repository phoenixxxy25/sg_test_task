<?php

include 'core/router.php';
include ('/config.php'); 
include (SITE_PATH . DS . 'core' . DS . 'core.php'); 

error_reporting (E_ALL); 
session_start();

$router = new Router();
$router->setPath (SITE_PATH . 'app'.DS.'controllers');
$router->start();
