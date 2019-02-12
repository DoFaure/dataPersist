<?php
namespace Util;

use Util\View;
use Configuration\Config;

class Route
{
    public function __construct(){

        $namespace = "Controller";
        $controller = "Controller";
        $method = "routeur";
        $class = $namespace."\\".$controller;

        if (! class_exists($class)) {
            echo "PB1 : ".$class."<br>";
            return $this->not_found();
        }

        if (! method_exists($class, $method)) {
            echo "PB2 : ".$class." ".$method."<br>";
            return $this->not_found();
        }

        $classInstance = new $class;

        call_user_func_array(array($classInstance, $method), $args=[]);
    }

    public function not_found()
    {
        $view = new View();
        return $view->render('404');
    }
}