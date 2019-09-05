<?php

class LoginController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->request->isPost()) {
            // Get the values from the form
            $username = strtolower($this->request->getPost("username"));
            $password = $this->request->getPost("password");
           
            // See if a user with that username exists
            $user = User::findFirst([
                'conditions' => 'username = :username:',
                'bind'       => ['username'=> $username]
            ]);
            
            // Verify if the password is a match for the hash in the database
            if (!$this->security->checkToken()) {
                $this->flash->error("An error occured while attempting to log in.");

            } else if (!($user && $this->security->checkHash($password, $user->password))) {
                $this->flash->error("Username and password do not match.");

            } else {
                // The user is authenticated send them to the homepage
                $this->session->set('user', $user);
                return $this->response->redirect('');
            }
        }
    }

}

