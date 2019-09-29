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

    /**
     * Add a new folder for the logged in user
     *
     * @return void
     */
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

    /**
     * Form to rename the given folder
     *
     * @return void
     */
    public function renameAction()
    {
        // Get the folder being referenced if it belongs to the user
        $folder_id = $this->dispatcher->getParam("id");
        $folder = Folder::findFirst([
            'conditions' => 'user_id = :user_id: AND id = :folder_id:',
            'bind'       => [
                'user_id'     => $this->user->id,
                'folder_id' => $folder_id
            ]
        ]);

        // If the folder exists and the form has been posted rename the folder
        if ($this->request->isPost() && $this->security->checkToken()) {
            $folder->name = $this->request->getPost('folder_name');
            $folder->save();
            return $this->response->redirect('');
        } elseif ($folder !== false) {
            $this->view->folder_name = $folder->name;
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
        // Get the folder being referenced if it belongs to the user
        $folder_id = $this->dispatcher->getParam("id");
        $folder = Folder::findFirst([
            'conditions' => 'user_id = :user_id: AND id = :folder_id:',
            'bind'       => [
                'user_id'     => $this->user->id,
                'folder_id' => $folder_id
            ]
        ]);

        if ($this->request->isPost() && $this->security->checkToken()) {
            $folder->delete();
            return $this->response->redirect('');
        } elseif ($folder !== false) {
            $this->view->folder_name = $folder->name;
        } else {
            $this->flash->error("No folder was found");
            return $this->response->redirect('');
        }
    }

}

