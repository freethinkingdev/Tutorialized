<?php

session_start();
require_once("RequireOnceFile.php");

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('All users registered in the system');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
if (isUserLoggedIn()) {
    $newUser = new ModelMainStarting();
    $role = $_SESSION['role'];

    $usersTable = new Table();
    $usersTable->addTableHeader(array('Login', 'First Name', 'Last Name', 'Email', 'Role', 'Options',"Delete user"), 'usersTable', 'Registered Users');

    foreach ($newUser->getAllIds() as $idValue) {
        $usersTable->addRowData($newUser->returnArrayOfAllUsers($idValue));
    }

    $usersTable->closeTable();
    goBackOneUrl();
} else {
    echo 'not logged in';
}
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");

