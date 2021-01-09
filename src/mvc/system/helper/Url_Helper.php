<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

function createUrl($controller = 'index', $action = 'index', $page = null, $bookID = null): string
{
    if (isset($page)) {
        return 'http://localhost/mvc/?c=' . $controller . '&a=' . $action . '&page=' . $page;
    }

    if (isset($bookID)) {
        return 'http://localhost/mvc/?c=' . $controller . '&a=' . $action . '&bookID=' . $bookID;
    }

    return 'http://localhost/mvc/?c=' . $controller . '&a=' . $action;
}

function redirect($controller = 'index', $action = 'index') {
    $url = 'Location: ' . createUrl($controller, $action);
    header($url);
    exit();
}
