<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        if ($this->session->has('fullname')) {
            $auth = $this->session->get('auth');
            $this->view->fullname = $auth['fullname'];
        }
    }

}

