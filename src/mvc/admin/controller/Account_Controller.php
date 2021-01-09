<?php
class Account_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('account');
        $this->view->load('account');

        $this->load_header('Manage your account');
        $this->view->show();
        $this->load_footer();
    }
}
