<?php

class IndexController extends ControllerBase
{

    public function initialize()
    {
        if (!$this->session->has('user')) {
            return $this->response->redirect('login');
        } else {
            $this->user = $this->session->get('user');
        }
    }

    public function indexAction()
    {
        $this->view->folders  = $this->user->folders;
    }

}

