<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Add new question');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {
    $course = new ModelCourses();
    /*
     * We need id of the course, so we would know, to which course question has to be attached
     */
    $idOfTheCourse = $_GET['id'];
    /*FIXME: POPRAWIC ORAZ ULEPSZYC KOD*/
    echo "You are adding question to the <span class='makeItBold'>".$course->returnCourseInfoById($idOfTheCourse)->getNameOfTheCourse()."</span> course<br/>";

    Form::startForm('post','index.php?direction=addNewQuestionForTheCourse','addQuestionForm', 'Add question for the course');

    Form::addSelectInput('Type of the question','questionType',array('Multiple choice', 'One choice only', 'True/False', 'Likert'));
    Form::addFormInput('text','questionText','Provide question text below');
    echo "<button>Add answer</button>";

    Form::addFormInput('text','possibleAnswer1','Write first possible answer below');
    Form::addCheckBoxInput('valid[]', 'Is it valid answer?','answer1');

    Form::addFormInput('text','possibleAnswer2','Write second possible answer below');
    Form::addCheckBoxInput('valid[]', 'Is it valid answer?','answer2');

    Form::addFormInput('text','possibleAnswer3','Write third possible answer below', null,'');
    Form::addCheckBoxInput('valid[]', 'Is it valid answer?','answer3');
    
    Form::addFormInput('text','possibleAnswer4','Write third possible answer below', null,'');
    Form::addCheckBoxInput('valid[]', 'Is it valid answer?','answer4');
    
    Form::addFormInput('text','possibleAnswer5','Write third possible answer below', null,'');
    Form::addCheckBoxInput('valid[]', 'Is it valid answer?','answer5');
    
    Form::addFormInput('text','possibleAnswer6','Write third possible answer below', null,'');
    Form::addCheckBoxInput('valid[]', 'Is it valid answer?','answer6');

    Form::addHiddenFieldToTheForm('courseId', $course->returnCourseInfoById($idOfTheCourse)->getIdOfTheCourse());
    Form::addResetButton();
    Form::addSubmitButton('Add question', 'button_login');

} else {

}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");
