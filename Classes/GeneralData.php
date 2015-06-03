<?php
/**
 * User: marcin
 * Date: 22/03/13
 * Time: 16:58
 * File name: GeneralData.php
 */
include_once "UserDBTable.php";
include_once "Classes/Connect.php";

class GeneralData extends Connect
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getRoleById($id) {

    }
}
