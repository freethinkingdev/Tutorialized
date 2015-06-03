<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Add new course to the library');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {

    $addCourseForm = new Form();
    $addCourseForm->startForm('post','index.php?direction=addNewCourseFromData','addCourseForm','Add new course');

    $addCourseForm->addFormInput('text','courseName','Course name: ');
    $addCourseForm->addTextArea('Course description');

    $addCourseForm->addResetButton();
    $addCourseForm->addSubmitButton('Add', 'button_login');

} else {
    echo "Sorry, you have to be logged in to add new course";
}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");
