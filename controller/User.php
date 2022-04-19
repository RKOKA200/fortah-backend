<?php 

class User extends Controller{
    
    protected function login(){
        $userModel = new UserModel();
        echo json_encode($userModel->login());
    }

    protected function addAdmin()
    {
        $userModel = new UserModel();
        echo json_encode($userModel->addAdmin());
    }

    protected function addUser()
    {
        $userModel = new UserModel();
        echo json_encode($userModel->addUser());
    }

    protected function getUser() {
        $userModel = new UserModel();
        echo json_encode($userModel->getUser());
    }
}
