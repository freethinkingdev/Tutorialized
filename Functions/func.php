<?php
/**
 * User: Marcin
 * Date: 19/10/2012
 * Time: 15:34
 * File name: func.php
 */
require_once("RequireOnceFile.php");


//Adding the js file to the page.
function addTheJsScript()
{
 Page::addMainBodyToThePage("<script type='text/javascript'>");
 include_once("JavaScript/jsFile.js");
 Page::addMainBodyToThePage("</script>");
}

// Function which places a back button and javascript to go back one page
function goBackOneUrl()
{
 echo "<br/><span class='floatright'><a href='javascript:history.back()'>BACK</a></span>";
}
function alert($message)
{
    echo "<script type='text/javascript'>alert(".$message.");</script>";
}


//Function which loads data browse page
function gotoDataBrowsePage()
{
 echo "<script type='text/javascript'>window.location = 'data_browse.php';</script> ";
}
//Function which redirects to index paga
function gotoHomePage()
{
 echo "<script type='text/javascript'>window.location = 'index.php';</script> ";
}


// Function check whether there is a session called id and is not empty.
function isUserLoggedIn()
{
 return (isset($_SESSION['id']) and !empty($_SESSION['id'])) ? true : false;
}

function isUser() {
    switch ($_SESSION['role']) {
        case 1:
        case 2:
            return false;
        break;
        case 3:
            return true;
        break;
    }
}


// This function runs when the user has failed validation
function userNotValidated()
{
 echo "There was a problem, please, repeat the process.";
 echo "<br/><a href='javascript:history.back(1)'>BACK</a>";
}


// Function, which displays what is the type of reference, the type is passed in argument
function noticeOfReference($arg)
{
 echo "<br/>Your chosen type of reference is a {$arg}. Please, verify that it is correct and then click below in order to add it to the database.<br/>";
}

// Function displaying error message
function displayFromErrorMessage()
{
 echo "<p class='error_message'>It seems that the form has not been filled correctly. Please provide data once more</p><br/>";
}


// Generate numbers and display them from 1900 up until current year
function generateNumbersFromNumberAtoAcurrentYear($fromNumber){
 $ar = array();
 for($fromNumber;$fromNumber<=date('Y');$fromNumber++) {

  array_push($ar,$fromNumber);
 }
 return $ar;
}

function generateNumbersFromNumberAtoAnumberB($fromNumber,$toNumber){
 $ar = array();
 for($fromNumber;$fromNumber<=$toNumber;$fromNumber++) {

  array_push($ar,$fromNumber);
 }
 return $ar;
}


/*
 *Function which returns user to the prevoius page
 */

function returnToLastPage() {
    $prevPage = $_SERVER['HTTP_REFERER'];
    header("Location:".$prevPage);
}

function goToAPage($link) {
    header("Location:".$link);
}

function br(){
    echo "<br/>";
}

function pre() {
    echo "<pre>";
}

function dump($obj){
    echo "<pre>";
    var_dump($obj);
    echo "</pre>";
}

function hr() {
    echo "<hr/>";
}