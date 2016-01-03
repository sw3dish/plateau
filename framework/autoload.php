<?php

define('ROOT', realpath($_SERVER['DOCUMENT_ROOT']));

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

// Start slim
$app = new \Slim\Slim(
    array(
        'view'              => new \Slim\Views\Twig(),
        'pages.path'        => ROOT . '/application/content/pages',
        'templates.path' 	=> ROOT . '/application/templates',
        'md'                => new CommonMarkConverter()
    )
);

require ROOT . '/application/routes.php';

$app->run();
?>
