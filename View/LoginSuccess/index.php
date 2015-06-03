<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 12:39
 * File name: index.php
 */
@session_start();
//include_once "Model/ModelUser.php";
require_once("RequireOnceFile.php");

$id = $_SESSION['id'];
$userRole = $_SESSION['role'];

switch ($_SESSION['role']) {
    case 1:
        // Code for the case
        $userRole = 'Admin';
        break;
    case 2:
        // Code for the case
        $userRole = 'Author';
        break;
    case 3:
        // Code for the case
        $userRole = 'User';
        break;

    default:
        // Default action
        break;
}
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("Well done! You are logged in");

include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");
if (isUserLoggedIn()) {
    //$nUser = new ModelUser();
    $nUser = new ModelMainStarting();    
    $nameOfTheUser = $nUser->showUserFirstName($id);
    echo "<p>Hi " . $nameOfTheUser . ". <br/>It is nice to see you come back :) <br/>You role is: ".$userRole." &nbsp;</p>";
} else {
    echo "You have to log in in order to see that page.";
}
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
