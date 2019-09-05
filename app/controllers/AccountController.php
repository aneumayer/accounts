<?php

class AccountController extends \Phalcon\Mvc\Controller
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

    }

}

