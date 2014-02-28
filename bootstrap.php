<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/autoload.php');
$config = require('config.php');

// Project class autoloader
$autoloader = new Autoloader();

// Doctrine configuration
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;
$klein = new \Klein\Klein();

$dbParams = array(
    'driver'   => $config['db_driver'],
    'user'     => $config['db_user'],
    'password' => $config['db_pass'],
    'dbname'   => $config['db_name'],
    'host'     => $config['db_host']
);

$db_config = Setup::createAnnotationMetadataConfiguration($config['model_paths'], $isDevMode);
$entityManager = EntityManager::create($dbParams, $db_config);

// Register entity manager for our app
$klein->app()->register('em', function() use ($entityManager) {
    return $entityManager;
});
