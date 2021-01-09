<?php
class Search_Controller extends Base_Controller {
    function indexAction() {
        $this->helper->load('url');
        $this->model->load('book');
        $this->model->load('pagination');
        $this->view->load('search');

        $this->load_header('Search result');
        $this->view->show();
        $this->load_footer();
    }
}
