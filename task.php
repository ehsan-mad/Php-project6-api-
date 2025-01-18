<?php

use api\TaskApi\Router;
use api\TaskApi\Task;
use config\Database;
header("content-type: application/json");

require './vendor/autoload.php';
require_once "config/Database.php";
require_once 'api/TaskApi/Task.php';
require_once 'api/TaskApi/Router.php';

$db     = new Database();
$conn   = $db->getConnection();
$task   = new Task($conn);
$router = new Router($task);
$router->handleRequest();
$conn->close();
