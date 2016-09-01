<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__ . '/../config/dev.php';

require __DIR__ . '/../src/app.php';

require __DIR__.'/../src/App/helpers/global.php';

define('APP_PATH', __DIR__.'/..');

define('MEDIA_URL', $app['media.url']);
define('UPLOAD_FOLDER', 'uploads');
define('UPLOAD_PATH', __DIR__.'/../storage/'.UPLOAD_FOLDER);


$app['http_cache']->run();
