<?php

define('ROOT', realpath($_SERVER['DOCUMENT_ROOT']));

if (!empty($_SERVER["IS_DEV"]) && $_SERVER["IS_DEV"] == "true") {
    error_reporting(E_ALL);
}

// Composer autoload
require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/framework/models/Utility.php';

use \plateau\models\utility;
use \League\CommonMark\CommonMarkConverter;

//get all the files in framework/exceptions
Utility::include_all_files_in_directory(
    ROOT . "/framework/exceptions"
);

//get all the files in framework/models
Utility::include_all_files_in_directory(
    ROOT . "/framework/models"
);

//include all of the controller functions
Utility::include_all_files_in_directory(
    ROOT . '/application/controllers'
);

require ROOT . '/application/settings.php';

// Start slim
$app = new \Slim\Slim(
    array(
        'view'              => new \Slim\Views\Twig(),
        'pages.path'        => ROOT . '/application/content/pages',
        'templates.path' 	=> ROOT . '/application/templates',
        'md'                => new CommonMarkConverter()
    )
);

$twig = $app->view()->getEnvironment();

foreach($plateau_settings as $key => $value) {
    $twig->addGlobal($key, $value);
}

require ROOT . '/application/routes.php';


$app->run();
?>
