<?php
/**
 * User: Marcin
 * Date: 01/12/2012
 * Time: 23:09
 * File name: Connect.php
 */

class Connect
{
    protected $connection;
    public $dbName = "ha178pxv_tutorialized";
    public $databaseUser = "ha178pxv_tutoria";
    public $databasePassword = "aAFDfgp43";


    function __construct()
    {
//Please provide server type, login for the server, password and name of the database         
        if ($this->connection = @mysqli_connect("localhost", $this->databaseUser, $this->databasePassword, $this->dbName)) {
        } else {
            echo "DB error";
        }
    }

    function __destruct()
    {
        mysqli_close($this->connection);
    }
}
