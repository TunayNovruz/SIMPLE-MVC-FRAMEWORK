<?php
use core\app;
use core\view;
require_once '../core/config.php';
require_once '../core/app.php';
app::init();
$route = app::route(urldecode($_SERVER['REQUEST_URI']));
view::render($route);
?>