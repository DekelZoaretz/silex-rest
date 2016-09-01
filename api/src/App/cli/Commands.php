<?php

use App\Cli\Task\ClearLogs;

$config = new \Doctrine\DBAL\Configuration();

$dbOptions = array_get($app,'db.options',array());
$dbInstanceConnection = \Doctrine\DBAL\DriverManager::getConnection($dbOptions, $config);


$appCli->add(new ClearLogs($dbInstanceConnection));
