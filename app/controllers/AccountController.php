<?php

class AccountController extends \Phalcon\Mvc\Controller
{
    private $user = null;
    private $folder = null;

    public function initialize()
    {
        if (!$this->session->has('user')) {
            return $this->response->redirect('login');
        } else {
            $this->user = $this->session->get('user');
        }
    }

    /**
     * Add a new folder for the logged in user
     *
     * @return void
     */
    public function addAction()
    {
    }

    /**
     * Form to delete the given folder
     *
     * @return void
     */
    public function viewAction()
    {
    }

    /**
     * Form to rename the given folder
     *
     * @return void
     */
    public function editAction()
    {
    }

    /**
     * Form to delete the given folder
     *
     * @return void
     */
    public function deleteAction()
    {
    }
}

