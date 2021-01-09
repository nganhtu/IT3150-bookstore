<?php
class Item_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('book');
        $this->model->load('cart');
        $this->view->load('item');

        $this->load_header('Item details');
        $this->view->show();
        $this->load_footer();
    }
}
