<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 13:07
 * File name: logout.php
 */
session_start();

include_once "RequireOnceFile.php";
session_destroy();
gotoHomePage();