<?php

class FolderController extends \Phalcon\Mvc\Controller
{

    private $user = null;
    private $folder = null;

    public function initialize()
    {
        if (!$this->session->has('user')) {
            return $this->response->redirect('login');
        }
        // Get the current logged in user
        $this->user = $this->session->get('user');
        // Get the folder being referenced if it belongs to the user
        $this->folder = Folder::findFirst([
            'conditions' => 'user_id = :user_id: AND id = :folder_id:',
            'bind'       => [
                'user_id'   => $this->user->id,
                'folder_id' => $this->dispatcher->getParam("folder_id")
            ]
        ]);
    }

    /**
     * Add a new folder for the logged in user
     *
     * @return void
     */
    public function addAction()
    {
        $folder_name = $this->request->getPost('folder_name');
        if ($this->request->isPost()) {
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

    /**
     * Form to delete the given folder
     *
     * @return void
     */
    public function viewAction()
    {
        if ($this->folder !== false) {
            $this->view->folder_name = $this->folder->name;
        }
        $this->view->folder = $this->folder;
        $this->view->accounts = $this->folder->accounts;
    }

    /**
     * Form to rename the given folder
     *
     * @return void
     */
    public function editAction()
    {
        // If the folder exists and the form has been posted rename the folder
        if ($this->request->isPost() && $this->security->checkToken()) {
            $this->folder->name = $this->request->getPost('folder_name');
            $this->folder->save();
            return $this->response->redirect('');
        } elseif ($this->folder !== false) {
            $this->view->folder_name = $this->folder->name;
        } else {
            $this->flash->error("No folder was found");
            return $this->response->redirect('');
        }
    }

    /**
     * Form to delete the given folder
     *
     * @return void
     */
    public function deleteAction()
    {
        if ($this->request->isPost() && $this->security->checkToken()) {
            $this->folder->delete();
            return $this->response->redirect('');
        } elseif ($this->folder !== false) {
            $this->view->folder_name = $this->folder->name;
        } else {
            $this->flash->error("No folder was found");
            return $this->response->redirect('');
        }
    }
}
