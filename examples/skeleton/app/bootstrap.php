<?php

/*use Nette::Environment;*/
/*use Nette::Application::Route;*/

/**
 * Load Nette
 */
define('LIBS_DIR', APP_DIR . '/../libs');

// this should be removed
if (!is_dir(LIBS_DIR . '/Nette')) {
	die("Extract Nette Framework to library directory '" . realpath(LIBS_DIR) . "'.");
}

require_once LIBS_DIR . '/Nette/loader.php';



/**
 * Setup Nette::Debug
 */
if (Environment::getName() === Environment::DEVELOPMENT) {
	/*Nette::*/Debug::enable(E_ALL | E_STRICT);
}



/**
 * Configure application
 */
Environment::loadConfig();



/**
 * Enable RobotLoader (universal autoloader).
 */
$robot = new /*Nette::Loaders::*/RobotLoader();
$robot->addDirectory(Environment::getVariable('appDir'));
$robot->addDirectory(Environment::getVariable('libsDir'));
$robot->register();



/**
 * Setup router
 */
$application = Environment::getApplication();

$router = $application->getRouter();

$router[] = new Route('index.php', array(
	'presenter' => 'Default',
	'view' => 'default',
), Route::ONE_WAY);

$router[] = new Route('<presenter>/<view>/<id>', array(
	'presenter' => 'Default',
	'view' => 'default',
	'id' => NULL,
));



/**
 * Run!
 */
$application->run();