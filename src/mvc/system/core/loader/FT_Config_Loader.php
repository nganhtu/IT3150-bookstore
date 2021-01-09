<?php

class FT_Config_Loader {
    protected $config = array();

    public function load($config): bool
    {
        if (file_exists(PATH_APPLICATION . '/config/' . $config . '.php')) {
            $config = include_once PATH_APPLICATION . '/config/' . $config . '.php';
            if (!empty($config)) {
                foreach ($config as $key => $item) {
                    $this->config[$key] = $item;
                }
            }
            return true;
        }
        return false;
    }

    public function item($key, $default_val = ''): string {
        return isset($this->config[$key]) ? $this->config[$key] : $default_val;
    }

    public function set_item($key, $val) {
        $this->config[$key] = $val;
    }
}
