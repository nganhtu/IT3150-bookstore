<?php
class Login_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('account');
        $this->view->load('login');

        $this->load_header('Log in or Sign up');
        $this->view->show();
        $this->load_footer();
    }
}
