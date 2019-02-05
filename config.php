<?php

define('ROOT_PATH', __DIR__);
define('SPR', '/');
define('IMG_PATH','bootstrap' . SPR . 'img' . SPR);
define('INC', ROOT_PATH . SPR . 'bootstrap' . SPR . 'include' . SPR);

function __autoload($class_name) {

    if (file_exists(ROOT_PATH . '/control/' . $class_name . '.php')) {
        require_once ROOT_PATH . '/control/' . $class_name . '.php';
    } else if (file_exists(ROOT_PATH . '/model/' . $class_name . '.php')) {
        require_once ROOT_PATH . '/model/' . $class_name . '.php';
    } else if (file_exists(ROOT_PATH . '/view/presentes/' . $class_name . '.php')) {
        require_once ROOT_PATH . '/view/presentes/' . $class_name . '.php';
    } else {
        exit();
    }


    
}
