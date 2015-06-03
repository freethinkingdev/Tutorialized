<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Edit user');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {

    $user = new ModelMainStarting();

    $idOfUserToEdit = $_GET['id'];

    echo "<h2>Edit user</h2>";
    echo "<form method='post' action='index.php?direction=editExsistingUser'><fieldset><legend>Edit user data</legend>";
    echo "<input id='idOfUser' name='idOfUser' type='hidden' value='".$idOfUserToEdit."' />";
    echo "Name: <input title='User first name' id='userName' name='userName'  required type='text' value='" . $user->showUserFirstName($idOfUserToEdit) . "'/><br/>";
    echo "Surname: <input title='User last name' id='userSurname' name='userSurname'  required type='text' value='" . $user->showUserLastName($idOfUserToEdit) . "'/><br/>";
    echo "Email: <input title='User email address' id='userEmail' name='userEmail'  required type='text' value='" . $user->showUSerEmail($idOfUserToEdit) . "'/><br/>";
    $role = '';
    echo "Role: <select id='userRole' name='userRole' required>";
    switch($user->showUserRole($idOfUserToEdit)){
        case 1:
            echo "<option value='1'>Admin</option>";
            echo "<option value='2'>Author</option>";
            echo "<option value='3'>User</option>";
            break;
        case 2:
            echo "<option value='2'>Author</option>";
            echo "<option value='1'>Admin</option>";
            echo "<option value='3'>User</option>";
            break;
        case 3:
            echo "<option value='3'>User</option>";
            echo "<option value='1'>Admin</option>";
            echo "<option value='2'>Author</option>";
            break;
    }

    echo "</select>";
    //echo "Role: <input title='1 = Admin, 2 = Author, 3 = User' id='userRole' name='userRole' required type='text' value='" . $user->showUserRole($idOfUserToEdit) . "'/><br/>";
    echo "<input class='button_login' type='submit' value='Edit user'/>";
    echo "</fieldset></form></br>";

    goBackOneUrl();

} else {

}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");
