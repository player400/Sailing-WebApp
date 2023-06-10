<?php
require_once '../routing.php';
require_once '../controller.php';
require_once '../dispatcher.php';

session_start();


$url = $_GET['action'];
$response = new Dispatcher($routing[$url]);
$response->respond();

?>