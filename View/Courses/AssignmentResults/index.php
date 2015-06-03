<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Assignment results');
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {

    $assignment = new ModelQuestionsAnswers();
    /*If assignment id has been generated*/
    if (isset($_POST['assignmentId'])) {
        $idOfAssignment = @$_POST['assignmentId'];
    }
    /*Creating the object of the answer*/
    $answersObject = new UserAnswersClass();


    //Table, which will containt all ids of answers supplied by user
    $allAnswersIDs = array();
    //Table, which will contain all ids from the questionnaire ex. 1,23,4,2,5
    $questionIds = array();
    //Variable, which will store number of good answers
    $userGoodAnswersRadios = 0;
    $userGoodAnswersCheckboxes = 0;
    if (isset($_POST['questionsIds'])) {
        foreach ($_POST['questionsIds'] as $qId) {
            $questionIds[] = $qId;
        }
    }

    $typeOfAssignment = $assignment->getAssignmentInformationByItsId($idOfAssignment)->getTypeOfTheAssignment();
    /*Checking to see whether user should receive feedback*/
    $receiveFeedback = true;
    if ($typeOfAssignment == 3) {
        /* User should not receive feedback*/
        $receiveFeedback = false;
    } else {
        /* User should receive feedback*/
        $receiveFeedback = true;
    }

    if($receiveFeedback) {
       // echo "feedback";
    } else {
        Page::addMainBodyToThePage("<h2>Thank You <br/>Questionnaire is now complete. This page will reload in 3 seconds.</h2><head><meta http-equiv='refresh' content='3; URL=index.php?direction=courses'></head>");
    }
    foreach ($questionIds as $k1 => $v1) {
        //question id
        foreach ($assignment->returnAllPossibleAnswersForGivenQuestionId($v1) as $ai) {
            if ($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($ai,$v1)) {
                //echo $ai . " is valid"; br();
                $answersObject->setValidAnswerId($ai);
                //$answersObject->setIsUserAnswerValid(1);
            } else {
                //echo $ai . " is wrong"; br();
                $answersObject->setValidAnswerId(NULL);
                //$answersObject->setIsUserAnswerValid(0);
            }

            $answersObject->setIdOfUser($_SESSION['id']);
            $answersObject->setIdOfAssignment($idOfAssignment);
            $answersObject->setIdOfQuestion($v1);

            /************************************* Inserting user answer to db *****************************************/
            $assignment->insertUserAnswerIntoDatabase($answersObject);
        }
    }
    //Total number of questions asked
    $totalQuestions = count($questionIds);
    foreach ($questionIds as $question) {
        //$question => this is id of question asked
        if($receiveFeedback)  echo "<span class='assResultsQ'>Question: " . $assignment->getQuestionInformationByQuestionId($question)->getQuestionString() . "</span></br>";
        // Checking what type of a given question is and checking whether the answer is supplied
        switch ($assignment->getQuestionInformationByQuestionId($question)->getTypeOfTheQuestion()) {
            case 2: //multiple choice, CHECKBOXES
                //if checkboxes are filled
                if (isset($_POST["checkbox{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"])) {

                    //Array of good answers for given question
                    $goodAnswers = $assignment->getIdsOfAllCorrectAnswersForGivenQuestionID($question);
                    //for each checkbox;
                    $checkboxGroup = $_POST["checkbox{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"];
                    if($receiveFeedback) echo "<em>Answer given: </em>";
                    //Table of answers ids supplied by user = user answers
                    $uAnswers = array();
                    foreach ($checkboxGroup as $name => $value) {

                        $answersObject->setUserAnswerId($value);
                        //echo $answersObject->getUserAnswerId();
                        $uAnswers[] = $value;
                        $allAnswersIDs[] = $value;
                        $idOfAnswer = $assignment->getAnswerInformationByItsId($value)->getId();
                        //Displaying answer string, which has been indicated by user
                        if($receiveFeedback) echo $assignment->getAnswerInformationByItsId($value)->getAnswerString() . " ";

                        switch ($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($value, $question)) {
                            case 1:
                                $answersObject->setIsUserAnswerValid(1);
                                break;
                            case 0:
                                $answersObject->setIsUserAnswerValid(0);
                                break;
                        }


                    }
                    $answersObject->setUserAnswerId($value);
                    br();
                    if($receiveFeedback)  echo "<span class='correctAnswer'>Correct answer:</span>";

                    $totalPointForQuestion = 0;
                    foreach ($goodAnswers as $k1 => $v1) {
                        if($receiveFeedback)  echo $assignment->getAnswerInformationByItsId($v1)->getAnswerString() . " ";
                        $totalPointForQuestion++;
                    }
                    br();
                    $a = @array_intersect($uAnswers, $goodAnswers);
                    //dump($a);
                    //Displaying message to the user with partial scores
                    $res = "You have correctly answered ";
                    switch (count($a)) {
                        case 1:
                            $res .= "1 part ";
                            $userGoodAnswersCheckboxes++;
                            break;
                        case 2:
                            $res .= "2 parts ";
                            $userGoodAnswersCheckboxes += 2;
                            break;
                        case 3:
                            $res .= "3 parts ";
                            $userGoodAnswersCheckboxes += 3;
                            break;
                        case 4:
                            $res .= "4 parts ";
                            $userGoodAnswersCheckboxes += 4;
                            break;
                        case 0:
                            $res .= "0 parts ";
                            break;
                    }
                    $res .= " out of {$totalPointForQuestion}";
                    if($receiveFeedback)  echo $res;
                    br();
                    if($receiveFeedback) echo "Total points possible for question: " . $totalPointForQuestion;
                    br();
                } /*End if*/ else { /* User didnt provided answers*/
                    echo "No answer supplied";
                    br();
                }
                foreach ($uAnswers as $k1) {
                    //echo $k1; //id of the answer
                    $answersObject->setUserAnswerId($k1);

                }

                $a = new MultipleIterator();
                $a->attachIterator(new ArrayIterator($uAnswers));
                /*This is where i got last ids*/
                $a->attachIterator(new ArrayIterator($assignment->returnAllIDsOfQuestionsFromUserAnswerTable($question, $idOfAssignment,$_SESSION['id'])));

                foreach ($a as $k1) {
                    $valid = 0;
                    if($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($k1[0],$question)) {
                        $valid = 1;
                    } else {
                        $valid = 0;
                    }
                    //Displaying row id of the question, answer id and whether given id is valid
                    //echo "Row id ".$k1[1] . " Answer id " . $k1[0] . " Valid: " .$valid;
                    //br();


                    /************************** This is where i update user answer *****************************/
                    $assignment->updateUserAnswerProvidingRowId($k1[1], $k1[0], $valid);

                }

                break;
            case 1:
            case 3:
            case 4:
                // one choice, true/false, likert RADIO BUTTONS
                if (isset($_POST["radio{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"])) {
                	
                    $value = $_POST["radio{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"];
                    $answersObject->setUserAnswerId($value);
                    $valid = 0;
                    switch ($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($value, $question)) {
                        case 1:
                            $valid = 1;
                            break;
                        case 0:
                            $valid = 0;
                            break;
                    }
                    
                    /************************* This is where i update user answer **************************************/
                    $assignment->updateUserAnswerProvidingRowId($assignment->returnAllIDsOfQuestionsFromUserAnswerTable($question, $idOfAssignment,$_SESSION['id'])[0], $value,$valid);

                    $valueOfRadioButtonWhichIsAnswerID = $_POST["radio{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"];
                    $correctAnswer = $assignment->retriveCorrectAnswerForGivenQuestionID($question)->getId();
                    $providedAnswer = $assignment->getAnswerInformationByItsId($valueOfRadioButtonWhichIsAnswerID)->getId();
                    $allAnswersIDs[] = $providedAnswer;

                    if ($correctAnswer == $providedAnswer) {
                        if($receiveFeedback)  echo "<span class='correctAnswer'><em>Answer given: " . $assignment->getAnswerInformationByItsId($valueOfRadioButtonWhichIsAnswerID)->getAnswerString() . "</em></span>";
                        $userGoodAnswersRadios++;
                    } else {
                        if($receiveFeedback)  echo "<span class='wrongAnswer'><em>Answer given: " . $assignment->getAnswerInformationByItsId($valueOfRadioButtonWhichIsAnswerID)->getAnswerString() . "</em></span>";
                    }
                    $userAnswers[$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()] = $valueOfRadioButtonWhichIsAnswerID;
                    br();
                    if($receiveFeedback)  echo "<span class='correctAnswer'>Correct answer: " . $assignment->retriveCorrectAnswerForGivenQuestionID($question)->getAnswerString() . "</span>";
                    br();

                    br();
                } else {
                    if($receiveFeedback)   echo"No answer supplied";
                    br();
                }
                break;
        }


    }
    hr();
    $totalPoints = $userGoodAnswersCheckboxes + $userGoodAnswersRadios;
    //Message with total points
    //echo "Your total points achieved: {$totalPoints}.\nTotal questions asked: " . count($questionIds);
    br();

    $goodAn = 0;
    foreach ($questionIds as $id1) {
        foreach ($allAnswersIDs as $id2) {       
            switch ($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($id2, $id1)) {
                case 1:          
                    $goodAn++;
                    break;
                case 0:
                    break;
            }        
        }
    }
    if($receiveFeedback) echo "Points " . $goodAn;

} else {
    //user is not logged in
}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
