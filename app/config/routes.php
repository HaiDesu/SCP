<?php

$router = new Phalcon\Mvc\Router();

$router->add('/login', array(
	'controller' => 'session',
	'action' => 'index'
));

$router->add('/logout', array(
	'controller' => 'session',
	'action' => 'logout'
));

$router->add('/register', array(
	'controller' => 'session',
	'action' => 'register'
));

$router->add('/confirm/{code}/{email}', array(
	'controller' => 'user_control',
	'action' => 'confirmEmail'
));

$router->add('/reset-password/{code}/{email}', array(
	'controller' => 'user_control',
	'action' => 'resetPassword'
));

return $router;