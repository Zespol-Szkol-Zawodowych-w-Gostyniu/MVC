<?php
require 'config/router.php';
require_once 'controller/controller.php';
require_once 'controller/mainController.php';


$request = $_SERVER['REQUEST_URI'];

$page=new mainController($request);
//$page->loadView($request);
?>
