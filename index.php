<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require('classes/App.php');
require('classes/Controller.php');
require('classes/Model.php');
require('model/User.php');
require('model/Education.php');
require('model/Topic.php');
require('controller/User.php');
require('controller/Education.php');
require('controller/Topic.php');


$app = new App($_GET);
$controller = $app->createController();
if ($controller) {
    $controller->executeAction();
}
