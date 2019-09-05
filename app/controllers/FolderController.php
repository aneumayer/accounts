<?php

class FolderController extends \Phalcon\Mvc\Controller
{

    public function initialize()
    {
        if (!$this->session->has('user')) {
            return $this->response->redirect('login');
        } else {
            $this->user = $this->session->get('user');
        }
    }

    public function addAction()
    {
        if ($this->request->isPost()) {
            $folder_name = $this->request->getPost('folder_name');
            
            // See if a folder with that name already exists
            $folder = Folder::findFirst([
                'conditions' => 'user_id = :user_id: AND name = :folder_name:',
                'bind'       => [
                    'user_id'     => $this->user->id,
                    'folder_name' => $folder_name
                ]
            ]);
        
            // If there is no folder create it
            if ($folder === false && $this->security->checkToken()) {
                $folder = new Folder();
                $folder->user_id = $this->user->id;
                $folder->name    = $folder_name;
                $folder->date    = new \Phalcon\Db\RawValue("now()");
                $folder->save();
                return $this->response->redirect('');

            } else {
                $this->flash->error("A folder with this name already exists.");
            }
        }
    }

}

