<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 10:28
 * File name: UserDBTable.php
 */
class UserDBTable
{

 private $id;
 private $first_name;
 private $last_name;
 private $email;
 private $username;
 private $password;
 private $date_signed;
 private $role;

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setDateSigned($date_signed)
    {
        $this->date_signed = $date_signed;
    }

    public function getDateSigned()
    {
        return $this->date_signed;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }


}
