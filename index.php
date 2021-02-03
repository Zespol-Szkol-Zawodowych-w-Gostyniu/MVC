<?php
require 'config/router.php';
require_once 'controller/controller.php';
require_once 'controller/mainController.php';
require_once 'view/view.php';

$request = $_SERVER['REQUEST_URI'];
//echo $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'];
$page=new mainController($request);

?>
