<?php
/**
 * User: marcin
 * Date: 12/02/13
 * Time: 22:48
 * File name: PersonRegister.php
 */
class PersonRegister
{
    private $personName;
    private $personSurname;
    private $personLogin;
    private $personEmail;
    private $personPass;

    public function getPersonEmail()
    {
        return $this->personEmail;
    }

    public function getPersonLogin()
    {
        return $this->personLogin;
    }

    public function getPersonName()
    {
        return $this->personName;
    }

    public function getPersonPass()
    {
        return $this->personPass;
    }

    public function getPersonSurname()
    {
        return $this->personSurname;
    }

    public function __construct($login, $name, $surname, $email, $pass) {
        $this->personName = $name;
        $this->personSurname = $surname;
        $this->personLogin = $login;
        $this->personEmail = $email;
        $this->personPass = $pass;
    }

}
