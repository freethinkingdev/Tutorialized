<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 13:35
 * File name: commonMenuV.php
 */
include_once "RequireOnceFile.php";
@session_start();

if (isUserLoggedIn()) {
    // User is logged in
    if ($_SESSION['role'] == 1) {
        // This is menu for the admin
        Page::addNavigationToThePage(array("Home"=>"index.php","Logout" => "index.php?direction=logout","Registered users"=>"index.php?direction=ShowAllUsers","Learn"=>"index.php?direction=courses","Results"=>"index.php?direction=showAssignmentUserResults","Help"=>"index.php?direction=helpMe"));
    } else if ($_SESSION['role'] == 2) {
        // This is menu for author
        Page::addNavigationToThePage(array("Home"=>"index.php","Logout" => "index.php?direction=logout","Learn"=>"index.php?direction=courses","Results"=>"index.php?direction=showAssignmentUserResults","Help"=>"index.php?direction=helpMe"));
    } else {
        // This is menu for user
        Page::addNavigationToThePage(array("Home"=>"index.php","Logout" => "index.php?direction=logout","Learn"=>"index.php?direction=courses","Help"=>"index.php?direction=helpMe"));
    }


} else {
    //If user is not logged in
    Page::addNavigationToThePage(array("Home" => "index.php", "Login" => "index.php?direction=loginPage","Register"=>"index.php?direction=register","Help"=>"index.php?direction=helpMe"));
}