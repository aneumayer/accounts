<?php

class IndexController extends ControllerBase
{

    public function initialize()
    {
        if (!$this->session->has('user')) {
            return $this->response->redirect('login');
        }
    }

    public function indexAction()
    {
        if ($this->session->has('fullname')) {
            $auth = $this->session->get('auth');
            $this->view->fullname = $auth['fullname'];
        }
    }

}

