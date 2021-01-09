<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

class FT_Controller {
    protected $view = null;

    protected $model = null;

    protected $library = null;

    protected $helper = null;

    protected $config = null;

    public function __construct() {
        require_once PATH_SYSTEM . '/core/loader/FT_Config_Loader.php';
        $this->config = new FT_Config_Loader();
        $this->config->load('config');

        require_once PATH_SYSTEM . '/core/loader/FT_Library_Loader.php';
        $this->library = new FT_Library_Loader();

        require_once PATH_SYSTEM . '/core/loader/FT_Helper_Loader.php';
        $this->helper = new FT_Helper_Loader();

        require_once PATH_SYSTEM . '/core/loader/FT_View_Loader.php';
        $this->view = new FT_View_Loader();

        require_once PATH_SYSTEM . '/core/loader/FT_Model_Loader.php';
        $this->model = new FT_Model_Loader();
    }
}
