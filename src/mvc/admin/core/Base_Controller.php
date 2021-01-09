<?php
if (!defined('PATH_SYSTEM')) die ('Bad requested!');

class Base_Controller extends FT_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function load_header($title) {
        $headerView = new FT_View_Loader();
        $headerView->load('header', array('title' => $title));
        $headerView->show();
    }

    public function load_footer() {
        $footerView = new FT_View_Loader();
        $footerView->load('footer');
        $footerView->show();
    }
    public function __destruct() {
    }
}
