<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

class FT_Library_Loader {
    public function load($library, $args = array()) {
        if (empty($this->{$library})) {
            $class = ucfirst($library) . '_Library';
            require_once(PATH_SYSTEM . '/library/' . $class . '.php');
            $this->{$library} = new $class($args);
        }
    }
}
