<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Add new content for the course');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {
    $id = $_GET['id'];
    Form::startForm('post','index.php?direction=addNewContentForm&id='.$id,'addNewContentForm','Add new content');
    Form::addFileInputField('fileToUpload', 'Select file: ', 4194304);
    Form::addHiddenFieldToTheForm('idOfTheCourse', $id);
    Form::addResetButton();
    Form::addSubmitButton('Upload','button_login');
} else {

}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");
