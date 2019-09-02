<?php

class UserController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function viewAction()
    {
        $users = User::find();
        $this->view->users = $users;
    }

    public function addAction()
    {
        if ($this->request->isPost()) {
            
            $user = new User();

            $user->first_name  = $this->request->getPost('first_name');
            $user->last_name   = $this->request->getPost('last_name');
            $user->username    = $this->request->getPost('username');
            $user->password    = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $user->date_created = new \Phalcon\Db\RawValue("now()");

            // var_dump($user);
            // $this->view->disable();
            
            if ($user->save() === false) {
                $this->view->status = [
                    "message" => "Error adding user",
                    "type"    => "danger"
                ];
            } else {
                $this->view->status = [
                    "message" => "User Added",
                    "type"    => "success"
                ];
            }
        }
    }

}

