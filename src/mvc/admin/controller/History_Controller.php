<?php
class History_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('account');
        $this->model->load('book');
        $this->model->load('pagination');
        $this->view->load('history');

        $this->load_header('Purchase history');
        $this->view->show();
        $this->load_footer();
    }
}
