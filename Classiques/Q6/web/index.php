<?php // index.php

  if (file_exists("../vendor/autoload.php")) {
    require_once "../vendor/autoload.php";
  }

  use Util\Route;

  define("ENVIRONMENT", 'development');

  new Route();
?>
