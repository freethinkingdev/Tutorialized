<?php
/**
 * User: Marcin
 * Date: 09/03/2013
 * Time: 19:28
 * File name: UserClass.php
 */
class UserClass
{
    private $firstName;
    private $surname;
    private $email;
    private $role;
    private $userId;
    private $userLogin;

    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;
    }

    public function getUserLogin()
    {
        return $this->userLogin;
    }



    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }



    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getSurname()
    {
        return $this->surname;
    }


    function __construct()
    {

    }

    function __destruct()
    {

    }
}
