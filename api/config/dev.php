<?php
ini_set('display_errors', 1);
$app['debug'] = true;
$app['media.url']= 'http://url-to-project/media/';
$app['log.db'] = true;
$app['log.file'] = true;
$app['log.name'] = 'Dev.silex';
$app['log.level'] = Monolog\Logger::DEBUG;
$app['db.options'] = array(
    "driver" => "pdo_mysql",
    "user" => "root",
    "password" => "root",
    "dbname" => "database_name"
);
