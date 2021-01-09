<?php
define('PATH_SYSTEM',      __DIR__ . '/system');
define('PATH_APPLICATION', __DIR__ . '/admin' );

require (PATH_SYSTEM . '/config/config.php');

session_start();
// php.ini: session.gc_maxlifetime = 36000

include_once PATH_SYSTEM . '/core/FT_Common.php';
FT_load();
