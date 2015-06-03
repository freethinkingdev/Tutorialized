<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Add new assignment for the course');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {

    $course = new ModelCourses();
    $questions = new ModelQuestionsAnswers();
    $idOfTheCourse = $_GET['id'];
    echo "You are adding assignment for <span class='makeItBold'>" .$course->returnCourseInfoById($idOfTheCourse)->getNameOfTheCourse(). "</span> course.";


    JqueryTabs::jQueryTabHeading();
    JqueryTabs::generateJqueryTab(array("questionnaireTab" => "Questionnaire","quizTab" => "Quiz","questionTab" => "Question", "import"=>"Import" ));
    Page::addMainBodyToThePage("<div id='questionnaireTab'>");
            /*
             * This form is for the questionnaire **********************************************************************
             */
            Form::startForm('post','index.php?direction=addNewAssignmentFormData','addNewAssignmentFormQuestionnaire', 'Add Questionnaire');
            Form::addFormInput('text','assignmentName','Provide name for your assignment:');
            Form::addHiddenFieldToTheForm('assignmentType', 'questionnaire');
            Form::addHiddenFieldToTheForm('forTheCourse', $idOfTheCourse);
            Form::addSelectInput('Is it publicly accessible:', 'assignmentAccess', array('No', 'Yes'));
            //Form::addDate('closingDate', 'Indicate closing date:');
            echo "<label for='assignmentQuestions'>Pick questions:</label>";
            echo "<select required id='assignmentQuestions[]' name='assignmentQuestions[]' multiple>";
            foreach ($questions->returnAllQuestionsByTheCourseId($idOfTheCourse) as $idOFQuestion) {
                echo "<option value='".$questions->getQuestionInformationByQuestionId($idOFQuestion)->getIdOfQuestion()."'>".$questions->getQuestionInformationByQuestionId($idOFQuestion)->getQuestionString()."</option>";
            }
            echo "</select>";
            Form::addResetButton();
            Form::addSubmitButton('Add assignment', 'button_login');

    Page::addMainBodyToThePage("</div>");


    Page::addMainBodyToThePage("<div id='quizTab'>");
            /*
            * This form is for the quiz ********************************************************************************
            */
            Form::startForm('post','index.php?direction=addNewAssignmentFormData','addNewAssignmentFormQuiz', 'Add new Quiz');
            Form::addFormInput('text','assignmentName','Provide name for your assignment:');
            Form::addHiddenFieldToTheForm('assignmentType', 'quiz');
            Form::addHiddenFieldToTheForm('forTheCourse', $idOfTheCourse);
            Form::addSelectInput('Is it publicly accessible:', 'assignmentAccess', array('No', 'Yes'));
            //Form::addDate('closingDate', 'Indicate closing date:');
            echo "<label for='assignmentQuestions'>Pick questions:</label>";
            echo "<select required id='assignmentQuestions[]' name='assignmentQuestions[]' multiple>";
            foreach ($questions->returnAllQuestionsByTheCourseId($idOfTheCourse) as $idOFQuestion) {
                echo "<option value='".$questions->getQuestionInformationByQuestionId($idOFQuestion)->getIdOfQuestion()."'>".$questions->getQuestionInformationByQuestionId($idOFQuestion)->getQuestionString()."</option>";
            }
            echo "</select>";
            Form::addResetButton();
            Form::addSubmitButton('Add assignment', 'button_login');

    Page::addMainBodyToThePage("</div>");






    Page::addMainBodyToThePage("<div id='questionTab'>");
            /*
             * This form is for the question ***************************************************************************
             */
    Form::startForm('post', 'index.php?direction=addNewAssignmentFormData', 'addNewAssignmentForm', 'Add new Question');
    Form::addFormInput('text', 'assignmentName', 'Provide name for your assignment:');
    Form::addHiddenFieldToTheForm('assignmentType', 'question');
    Form::addHiddenFieldToTheForm('forTheCourse', $idOfTheCourse);
    Form::addSelectInput('Is it publicly accessible:', 'assignmentAccess', array('No', 'Yes'));
    //Form::addDate('closingDate', 'Indicate closing date:');
    echo "<label for='assignmentQuestions'>Pick questions:</label>";
    echo "<select required id='assignmentQuestions' name='assignmentQuestions'>";
    foreach ($questions->returnAllQuestionsByTheCourseId($idOfTheCourse) as $idOFQuestion) {
        echo "<option value='" . $questions->getQuestionInformationByQuestionId($idOFQuestion)->getIdOfQuestion() . "'>" . $questions->getQuestionInformationByQuestionId($idOFQuestion)->getQuestionString() . "</option>";
    }
    echo "</select>";
    Form::addResetButton();
    Form::addSubmitButton('Add assignment', 'button_login');
    Page::addMainBodyToThePage("</div>");


    Page::addMainBodyToThePage("<div id='import'>");
    /*
     * This form is for importing ***************************************************************************
     */
    Form::startForm("post","index.php?direction=addNewAssignmentFormData","importAssignment","Import assignment");
    Form::addSelectInput("Type of assignment:","assignmentTypeChoosenByUser",array("Questionnaire","Quiz","Question"));
    Form::addFileInputField("assignmentFileToImport","Select assignment file:","3000");
    Form::addHiddenFieldToTheForm("assignmentName","Import");
    Form::addHiddenFieldToTheForm("assignmentQuestions","sdf");
    Form::addHiddenFieldToTheForm('assignmentType', 'import');
    Form::addHiddenFieldToTheForm('forTheCourse', $idOfTheCourse);
    Form::addResetButton();
    Form::addSubmitButton("Import assignment","button_login");
    JqueryTabs::jQueryTabFooter();
    goBackOneUrl();

} else {

}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
