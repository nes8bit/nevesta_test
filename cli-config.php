<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use TestCase\Locator;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';
$entityManager = Locator::getService('EntityManager');

return ConsoleRunner::createHelperSet($entityManager);
