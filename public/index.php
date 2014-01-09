<?php

error_reporting(-1);

try {

	/**
	 * Read the configuration
	 */
	$config = include __DIR__ . "/../app/config/config.php";

	/**
	 * Read auto-loader
	 */
	include __DIR__ . "/../app/config/loader.php";

	/**
	 * Read services
	 */
	include __DIR__ . "/../app/config/services.php";
	
	/**
	 * Main logger file
	 */
	$di->set('logger', function() {
		return new \Phalcon\Logger\Adapter\File(__DIR__.'/../var/logs/'.date('Y-m-d').'.log');
	}, true);
	
	/**
	 * Error handler
	 */
	set_error_handler(function($errno, $errstr, $errfile, $errline) use ($di)
	{
		if (!(error_reporting() & $errno)) {
			return;
		}

		$di->getFlash()->error($errstr);
		$di->getLogger()->log($errstr.' '.$errfile.':'.$errline, Phalcon\Logger::ERROR);

		return true;
	});

	/**
	 * Handle the request
	 */
	$application = new \Phalcon\Mvc\Application($di);
	
	echo $application->handle()->getContent();

} catch (\Exception $e) {
	echo $e->getMessage();
} 