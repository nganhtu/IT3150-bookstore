<?php
class Cart_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('book');
        $this->model->load('cart');
        $this->model->load('account');
        $this->model->load('pagination');
        $this->view->load('cart');

        $this->load_header('Your Cart');
        $this->view->show();
        $this->load_footer();
    }
}