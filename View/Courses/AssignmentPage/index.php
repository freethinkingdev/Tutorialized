<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Assignment');
include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {

    $assignment = new ModelQuestionsAnswers();
    //fixme:nie pamietam skad sie to wzielo
    //  $idOfTheCourse = $_SESSION[''];
    $idOfTheAssignment = $_GET['assId'];
    echo "<h2>Page for <em>".ucfirst($assignment->getAssignmentInformationByItsId($idOfTheAssignment)->getNameOfTheAssignment()) . "</em> assignment.</h2>";
    echo "<form id='assignmentForm' method='post' action='index.php?direction=showAssignmentResults' class='assignmentQuestionsForm'>";
    echo "<input type='hidden' name = 'assignmentId' value='".$idOfTheAssignment."' />";
    $fieldssetnum = 1;
    foreach($assignment->getAllQuestionsForParticularAssignmentId($idOfTheAssignment) as $qId) {
        //Show question
        //echo $fieldssetnum;
        echo "<fieldset id='".$fieldssetnum."'>";
        echo "<legend><b>".$assignment->getQuestionInformationByQuestionId($qId)->getQuestionString()."</b></legend><br/>";
        echo "<input type='hidden' name='questionsIds[]' value='".$assignment->getQuestionInformationByQuestionId($qId)->getIdOfQuestion()."' />";
        //Get ids of answers for given question
        foreach($assignment->getAllIdsOfAnswersForGivenQuestionId($qId) as $answerId) {
            $typeOfQuestion = $assignment->getQuestionInformationByQuestionId($qId)->getTypeOfTheQuestion();
            $idOfQuestion = $assignment->getQuestionInformationByQuestionId($qId)->getIdOfQuestion();
            $answerString = $assignment->getAnswerInformationByItsId($answerId)->getAnswerString();
            $innerAnswerId = $assignment->getAnswerInformationByItsId($answerId)->getId();
            //Decide, what is the type of question so the output could be formatted
            switch ($typeOfQuestion) {
                case 2:
                    // multiple choice - CHECKBOXES
                    echo "<input type='checkbox' id='checkbox".$innerAnswerId ."' name='checkbox".$idOfQuestion."[]' value='".$innerAnswerId."'/><label for='checkbox".$innerAnswerId ."'>".$answerString."</label><br/>";
                    break;
                case 1:
                case 3:
                case 4:
                    // likert, one choice, true/false - RADIO BUTTONS
                    echo "<input id='radio".$innerAnswerId."' value='".$innerAnswerId."' type='radio' name='radio".$idOfQuestion."' value='".$innerAnswerId."'/><label for='radio".$innerAnswerId."'>".$answerString."</label><br/>";
                    break;
            }//end of switch
        }//end of foreach
        echo "</fieldset>";
        $fieldssetnum++;

        //echo "<hr/>";
    }//end foreach
    echo "</br><input type='submit' value='Submit' class='button_login' />";
    echo "</form>";
    goBackOneUrl();
} else {
}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
