<?php
class FT_Session_Loader {
    public function load($session) {
        require_once(PATH_SYSTEM . '/session/' . $session . '.php');
    }
}
