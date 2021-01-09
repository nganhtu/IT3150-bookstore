<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

function FT_load() {
    $config = include_once PATH_APPLICATION . '/config/init.php';

    $controller = empty($_GET['c']) ? $config['default_controller'] : $_GET['c'];
    $action     = empty($_GET['a']) ? $config['default_action']     : $_GET['a'];

    $controller = ucfirst(strtolower($controller)) . '_Controller';
    $action     =         strtolower($action)      . 'Action';

    if (!file_exists(PATH_APPLICATION . '/controller/' . $controller . '.php')) {
        $controller = ucfirst(strtolower($config['404_controller'])) . '_Controller';
    }

    include_once PATH_SYSTEM . '/core/FT_Controller.php';

    if (file_exists(PATH_APPLICATION . '/core/Base_Controller.php')) {
        include_once PATH_APPLICATION . '/core/Base_Controller.php';
    }

    require_once PATH_APPLICATION . '/controller/' . $controller . '.php';

    if (!class_exists($controller)) {
        die ('Không tìm thấy controller');
    }

    $controllerObject = new $controller();

    if (!method_exists($controllerObject, $action)) {
        $action = strtolower($config['404_action']) . 'Action';
    }

    $controllerObject->{$action}();
}
