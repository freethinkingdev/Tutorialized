<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Edit assignment details');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {
    $assignment = new ModelQuestionsAnswers();
    $id_assignment_to_edit = $_GET['id'];
    echo "<h2>You are about to edit '" . $assignment->getAssignmentInformationByItsId($id_assignment_to_edit)->getNameOfTheAssignment() . "' assignment.";

    Form::startForm('post','index.php?direction=editAssignmentForm','editassignment','Edit assignment');
    echo "<label for='assignmentname'>Assignment name:</label>";
    Form::addHiddenFieldToTheForm('assignmentid', $id_assignment_to_edit);
    echo "<input id='assignmentname'name='assignmentname' type='text' value='".$assignment->getAssignmentInformationByItsId($id_assignment_to_edit)->getNameOfTheAssignment()."'/>";
    echo "<label for='assignmentpublicity'>Is assignment public:</label>";
    echo "<select id='assignmentpublicity' name='assignmentpublicity'>";
    switch ($assignment->getAssignmentInformationByItsId($id_assignment_to_edit)->getIsItPublic()) {
        case 'yes':
            echo "<option value='yes'>Yes</option>";
            echo "<option value='no'>No</option>";
            break;

        case 'no':
            echo "<option value='no'>No</option>";
            echo "<option value='yes'>Yes</option>";
            break;

    }
    echo "</select>";
    Form::addResetButton();
    Form::addSubmitButton('Save','button_login');




} else {

}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");
