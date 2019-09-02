<?php

class SignupController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->request->isPost()) {
            // Create a new user with the values from the form
            $user = new User();
            $user->first_name  = $this->request->getPost('first_name');
            $user->last_name   = $this->request->getPost('last_name');
            $user->username    = strtolower($this->request->getPost('username'));
            $user->password    = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $user->date_created = new \Phalcon\Db\RawValue("now()");
            // Save the new user to the database
            if ($user->save() === false) {
                $this->view->alert = [
                    "message" => "Error signing up.",
                    "type"    => "danger"
                ];
            } else {
                $this->view->alert = [
                    "message" => "You are signed up.",
                    "type"    => "success"
                ];
            }
        }
    }

}

