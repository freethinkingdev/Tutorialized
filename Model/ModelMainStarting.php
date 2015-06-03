<?php

/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 11:51
 * File name: ModelMainStarting.phpStartin.php
 */
include_once "Classes/UserDAO.php";
include_once "Classes/GeneralData.php";
include_once "RequireOnceFile.php";

class ModelMainStarting
{

    private $user;
    private $id;
    private $role;
    private $data;


    function __construct()
    {
        $this->user = new UserDAO();
        $this->data = new GeneralData();

    }

    function __destruct()
    {

    }

    public function returnUserLogin($username, $pass)
    {

        if ($username == $this->user->getUserData($username, $pass)->getUsername() and $pass == $this->user->getUserData($username, $pass)->getPassword()) {
            $this->id = $this->user->getUserData($username, $pass)->getId();
            $this->role = $this->user->getUserData($username, $pass)->getRole();

            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
		return $this->role;
    }

    public function showUserFirstName($id)
    {
        return $this->user->getUserDataById($id)->getFirstName();
    }

    public function showUserLastName($id)
    {
        return $this->user->getUserDataById($id)->getLastName();
    }

    public function showUSerEmail($id)
    {
        return $this->user->getUserDataById($id)->getEmail();
    }

    public function showUserLogin($id)
    {
        return $this->user->getUserDataById($id)->getUsername();
    }

    public function showUserRole($id)
    {
        return $this->user->getUserDataById($id)->getRole();
    }

    public function getRoleById($roleId) {
        return $this->data->getRoleById($roleId);
    }




    /*fixme confirming user data*/
    public function confirmUserData($personalDetails)
    {
        //echo $personalDetails->getPersonLogin();

        if (!$this->user->getUsername($personalDetails->getPersonLogin())) {
            //Above returned a valid row, which means such username exist already
            echo "Username exists already. Please go back and choose another username";
            goBackOneUrl();
        } else {
            //Username does not exists in the database, therefore user is allowed to continue
            $this->user->registerPerson($personalDetails);
        }


    }

    public function getAllIds()
    {
        return $this->user->getAllIds();
    }

    public function returnArrayOfAllUsers($id)
    {
        $arrayOfUsers = array();
        $arrayOfUsers[] = $this->user->getUserDataById($id)->getUsername();
        $arrayOfUsers[] = $this->user->getUserDataById($id)->getFirstName();
        $arrayOfUsers[] = $this->user->getUserDataById($id)->getLastName();
        $arrayOfUsers[] = $this->user->getUserDataById($id)->getEmail();

        switch ($this->user->getUserDataById($id)->getRole()) {
            case 1:
                // Code for the case
                $arrayOfUsers[] = 'Admin';
                break;
            case 2:
                // Code for the case
                $arrayOfUsers[] = 'Author';
                break;
            case 3:
                // Code for the case
                $arrayOfUsers[] = 'User';
                break;

            default:
                // Default action
                break;
        }
        //$arrayOfUsers[] = "<span title='1 Admin, 2 Author, 3 User'>" . $this->user->getUserDataById($id)->getRole() . "</span>";
        $arrayOfUsers[] = "<a title='' href='index.php?direction=userToEdit&id=" . $this->user->getUserDataById($id)->getId() . "'>Edit user</a>";
        $arrayOfUsers[] = "<a title='Click the X in order to delete the record. No warning before delete.' href='index.php?direction=itemToDelete&id=" . $this->user->getUserDataById($id)->getId() . "'>X</a>";
        return $arrayOfUsers;

    }

    public function deleteUserWithParticularID($id)
    {
        $this->user->deleteUser($id);
    }

    public function editExistingUser () {


        $userToEdit = new UserClass();
        $userToEdit->setEmail($_POST['userEmail']);
        $userToEdit->setFirstName($_POST['userName']);
        $userToEdit->setSurname($_POST['userSurname']);
        $userToEdit->setRole($_POST['userRole']);
        $userToEdit->setUserId($_POST['idOfUser']);

        $this->user->editUser($userToEdit);
     }
}
