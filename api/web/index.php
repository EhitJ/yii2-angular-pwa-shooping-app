<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');
 header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    // header('Access-Control-Allow-Headers: X-PINGARUNER');
    // header('Access-Control-Max-Age: 1728000');
    // header("Content-Length: 0");
 header("Content-Type: text/plain");
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();
