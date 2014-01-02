<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(array(
	'Abstaff\Models' => $config->application->modelsDir,
	'Abstaff\Controllers' => $config->application->controllersDir,
	'Abstaff\Forms' => $config->application->formsDir,
	'Abstaff\Plugins' => $config->application->pluginsDir,
	'Abstaff' => $config->application->libraryDir
));

$loader->register();
