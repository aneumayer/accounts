<?php

class RegistrationController extends \Phalcon\Mvc\Controller
{

    public function loginAction()
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

            } elseif (!($user && $this->security->checkHash($password, $user->password))) {
                $this->flash->error("Username and password do not match.");

            } else {
                // The user is authenticated send them to the homepage
                $this->session->set('user', $user);
                return $this->response->redirect('');
            }
        }
    }

    public function signupAction()
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
            } elseif ($this->request->getPost('password') != $this->request->getPost('password2')) {
                $this->flash->error("Password fields do not match.");
            } elseif ($this->security->checkToken()) {
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

    public function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect('login');
    }
}

