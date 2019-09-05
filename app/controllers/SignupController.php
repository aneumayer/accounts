<?php

class SignupController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->request->isPost()) {
            // Get the data from the form
            $first_name = $this->request->getPost('first_name');
            $last_name  = $this->request->getPost('last_name');
            $username   = strtolower($this->request->getPost('username'));
            $password   = $this->security->hash($this->request->getPost('password'));
            
            // Check if the username is already in use
            $user = User::findFirst([
                'conditions' => 'username = :username:',
                'bind'       => ['username'=> $username]
            ]);
            
            if ($user) {
                $this->flash->error("Username is already in use.");
            
            } else if ($this->request->getPost('password') != $this->request->getPost('password2')) {
                $this->flash->error("Password fields do not match.");
            
            } else if ($this->security->checkToken()) {
                // Create a new user with the values from the form
                $user = new User();
                $user->first_name  = $first_name;
                $user->last_name   = $last_name;
                $user->username    = $username;
                $user->password    = $password;
                $user->date_created = new \Phalcon\Db\RawValue("now()");
                
                // Save the new user to the database
                if ($user->save() === false) {
                    $this->flash->error("Error signing up.");
                
                } else {
                    // The user is authenticated send them to the homepage
                    $this->session->set('user', $user);
                    return $this->response->redirect('');
                }
            }
            
        }
    }

}

