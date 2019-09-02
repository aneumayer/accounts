<?php

class LogoutController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->session->destroy();
        return $this->response->redirect('login');
    }

}

