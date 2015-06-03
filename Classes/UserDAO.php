<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 10:22
 * File name: UserDAO.php
 */
include_once "UserDBTable.php";
include_once "Classes/Connect.php";
class UserDAO extends Connect
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getUserData($username, $pass)
    {
        $query = "select * from members where `username` = '" . $username . "' and `password` = '" . $pass . "' ";
        $res = $this->connection->query($query);
        if ($res->num_rows === 1) {
            $userData = $res->fetch_object("UserDBTable");
//   echo "USER DOES EXISTS<br/>";
        } else {
            $userData = new UserDBTable();

        }
        return $userData;
    }

    public function getUserDataById($id)
    {

        $query = "select * from members where `members`.`id` = '" . $id . "' ";
        $res = $this->connection->query($query);
        if ($res) {
            $userData = $res->fetch_object("UserDBTable");
        } else {
            $userData = new UserDBTable();

        }
        return $userData;
    }

    public function registerPerson($personObject)
    {
        $query = "INSERT INTO `tutorialez`.`members` (`id`,`first_name`, `last_name`, `email`, `username`, `password`, `date_signed`, `role`) VALUES (null,'" . $personObject->getPersonName() . "', '" . $personObject->getPersonSurname() . "', '" . $personObject->getPersonEmail() . "', '" . $personObject->getPersonLogin() . "', '" . $personObject->getPersonPass() . "',NOW(), '3')";
        $res = $this->connection->query($query);
        //echo $query;
    }

    public function getUsername($username) {
        $query = "SELECT members.username FROM tutorialez.members join tutorialez.roles on members.role = roles.idOfRole where members.username = '".$username."'";
        $res = $this->connection->query($query);
        // If row will be equal to 1, means that there is such row in database
        if ($res->num_rows === 1) {
            return false;
        } else {
            return true;
        }
    }



    public function getAllIds(){
        $allIds = array();
        $query = "SELECT members.id FROM ".$this->dbName.".members;";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function getRoleLiteral() {
        $query = "select roles.role from roles join members on members.role = roles.idOfRole";
        $res = $this->connection->query($query);
    }

    public function deleteUser($id) {
        $query = "delete from members where id = " . $id;
        $res = $this->connection->query($query);
    }


    public function editUser ($userToEdit) {

     $query = "UPDATE `".$this->dbName."`.`members` SET `first_name`='".$userToEdit->getFirstName()."', `last_name`='".$userToEdit->getSurname()."',
      `email`='".$userToEdit->getEmail()."', `role`='".$userToEdit->getRole()."' WHERE `id`='".$userToEdit->getUserId()."';
";

        $this->connection->query($query);
     }

}
