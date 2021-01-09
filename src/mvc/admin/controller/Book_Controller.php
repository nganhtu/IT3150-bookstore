<?php
class Book_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('book');
        $this->model->load('cart');
        $this->model->load('pagination');
        $this->view->load('book');

        $this->load_header('Books');
        $this->view->show();
        $this->load_footer();
    }
}
