<?php
class Error_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('error');
        $this->view->load('error');

        $this->load_header('Error');
        $this->view->show();
        $this->load_footer();
    }
}
