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
            if ($user == false) {
                $this->flash->error("Username and password do not match.");

            } else if ($this->security->checkToken() && $this->security->checkHash($password, $user->password)) {
                // The user is authenticated send them to the homepage
                $fullname = $user->first_name . " " . $user->last_name;
                $this->session->set('fullname', $fullname);
                $this->session->set('user', $user);
                return $this->response->redirect('');

            } else {
                $this->flash->error("An error occured while attempting to log in.");
            }
        }
    }

}

