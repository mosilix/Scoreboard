<?php
$path = trim( $_SERVER['REQUEST_URI'], '/' );
$path = parse_url($path, PHP_URL_PATH);


$routes = [
  '' => 'views/index.php',
  'login' => 'views/login.php',
  'board' => 'views/board.php',
  'scoreupdate' => 'views/score_update.php'
];

if (array_key_exists($path, $routes) ) {
  require $routes[$path];
}else {
  require 'views/404.php';
}



