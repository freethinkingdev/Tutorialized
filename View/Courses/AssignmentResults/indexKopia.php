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
    if (isset($_POST['assignmentId'])) {
        $idOfAssignment = @$_POST['assignmentId'];
    }
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

    foreach ($questionIds as $k1 => $v1) {
        //question id
        $posAnsNumber = 0;
            foreach ($assignment->returnAllPossibleAnswersForGivenQuestionId($v1) as $ai) {
                    //echo $ai;
                    br();
                    $posAnsNumber++;
                    echo $posAnsNumber;
                }
/*Chce mies ponizzsza petle uruchomiana dokladnie tyle ile jest mozliwych odpowiedzi.*/
        foreach ($assignment->getIdsOfAllCorrectAnswersForGivenQuestionID($v1) as $k2 => $v2) {
            br();
                //For loop how many ids are there. The row in DB is created that many
                $answersObject->setIdOfUser($_SESSION['id']);
                $answersObject->setIdOfAssignment($idOfAssignment);
                $answersObject->setIdOfQuestion($v1);
                $answersObject->setValidAnswerId($v2);
                //$assignment->insertUserAnswerIntoDatabase($answersObject);

        }
    }
    //Total number of questions asked
    $totalQuestions = count($questionIds);
    foreach ($questionIds as $question) {
        //$question => this is id of question asked
        echo "<span class='assResultsQ'>Question: " . $assignment->getQuestionInformationByQuestionId($question)->getQuestionString() . "</span></br>";
        // Checking what type of a given question is and checking whether the answer is supplied
        switch ($assignment->getQuestionInformationByQuestionId($question)->getTypeOfTheQuestion()) {
            case 2: //multiple choice, CHECKBOXES
                //if checkboxes are filled
                if (isset($_POST["checkbox{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"])) {

                    //Array of good answers for given question
                    $goodAnswers = $assignment->getIdsOfAllCorrectAnswersForGivenQuestionID($question);
                    //for each checkbox;
                    $checkboxGroup = $_POST["checkbox{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"];
                    echo "<em>Answer given: </em>";
                    //Table of answers ids supplied by user = user answers
                    $uAnswers = array();
                    foreach ($checkboxGroup as $name => $value) {

                        $answersObject->setUserAnswerId($value);
                        //echo $answersObject->getUserAnswerId();
                        $uAnswers[] = $value;
                        $allAnswersIDs[] = $value;
                        $idOfAnswer = $assignment->getAnswerInformationByItsId($value)->getId();
                        //Displaying answer string, which has been indicated by user
                        echo $assignment->getAnswerInformationByItsId($value)->getAnswerString() . " ";

                        switch($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($value,$question)) {
                            case 1: $answersObject->setIsUserAnswerValid(1); break;
                            case 0: $answersObject->setIsUserAnswerValid(0); break;
                        }


                    }
                    $answersObject->setUserAnswerId($value);
                    br();
                    echo "<span class='correctAnswer'>Correct answer:</span>";

                    $totalPointForQuestion = 0;
                    foreach ($goodAnswers as $k1 => $v1) {
                        echo $assignment->getAnswerInformationByItsId($v1)->getAnswerString() . " ";
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
                    echo $res;
                    br();
                    echo "Total points possible for question: " . $totalPointForQuestion;
                    br();
                } /*End if*/ else { /* User didnt provided answers*/
                    echo "No answer supplied";
                    br();
                }
                foreach ($uAnswers as $k1) {
                    //echo $k1; //id of the answer
                    $answersObject->setUserAnswerId($k1);
                    //echo $answersObject->getUserAnswerId();
                    br();

                }


                $a = new MultipleIterator();
                $a->attachIterator(new ArrayIterator($uAnswers));
                $a->attachIterator(new ArrayIterator($assignment->returnAllIDsOfQuestionsFromUserAnswerTable($question, $idOfAssignment)));

                foreach ($a as $k1) {
                    //echo "Row id ".$k1[1] . " Answer id " . $k1[0];
                    br();
                    $assignment->updateUserAnswerProvidingRowId($k1[1], $k1[0]);
                    echo "<br/>";
                }

                break;
            case 1:
            case 3:
            case 4:
                // one choice, true/false, likert RADIO BUTTONS
                if (isset($_POST["radio{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"])) {
                    $value = $_POST["radio{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"];
                    $answersObject->setUserAnswerId($value);
                    switch($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($value,$question)) {
                        case 1: $answersObject->setIsUserAnswerValid(1); break;
                        case 0: $answersObject->setIsUserAnswerValid(0); break;
                    }
                    $assignment->updateUserAnswerProvidingRowId($assignment->returnAllIDsOfQuestionsFromUserAnswerTable($question, $idOfAssignment)[0],$value);
                    $valueOfRadioButtonWhichIsAnswerID = $_POST["radio{$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()}"];
                    $correctAnswer = $assignment->retriveCorrectAnswerForGivenQuestionID($question)->getId();
                    $providedAnswer = $assignment->getAnswerInformationByItsId($valueOfRadioButtonWhichIsAnswerID)->getId();
                    $allAnswersIDs[] = $providedAnswer;

                    if ($correctAnswer == $providedAnswer) {
                        echo "<span class='correctAnswer'><em>Answer given: " . $assignment->getAnswerInformationByItsId($valueOfRadioButtonWhichIsAnswerID)->getAnswerString() . "</em></span>";
                        $userGoodAnswersRadios++;
                    } else {
                        echo "<span class='wrongAnswer'><em>Answer given: " . $assignment->getAnswerInformationByItsId($valueOfRadioButtonWhichIsAnswerID)->getAnswerString() . "</em></span>";
                    }
                    $userAnswers[$assignment->getQuestionInformationByQuestionId($question)->getIdOfQuestion()] = $valueOfRadioButtonWhichIsAnswerID;
                    br();
                    echo "<span class='correctAnswer'>Correct answer: " . $assignment->retriveCorrectAnswerForGivenQuestionID($question)->getAnswerString() . "</span>";
                    br();

                    br();
                } else {
                    echo"No answer supplied";
                    br();
                }
                break;
        }
        //Data goes to DB here


    }
    hr();
    $totalPoints = $userGoodAnswersCheckboxes + $userGoodAnswersRadios;
    //Message with total points
    //echo "Your total points achieved: {$totalPoints}.\nTotal questions asked: " . count($questionIds);
    br();

    /* Putting answer in database*/


    $goodAn = 0;
    foreach ($questionIds as $id1) {

        foreach ($allAnswersIDs as $id2) {
            $validity = 0;
            $answersObject->setValidAnswerId(2);
            $answersObject->setUserAnswerId($id2);

                switch ($assignment->checkIfGivenAnswerIdisValidForGivenQuestionId($id2, $id1)) {
                    case 1:
                        $validity = 1;
                        $goodAn++;
                        break;
                    case 0:
                        $validity = 0;
                        break;
                }
            $answersObject->setIsUserAnswerValid($validity  );

        }
    }
    echo "Points ".$goodAn;

} else {
    //user is not logged in
}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
addTheJsScript();
Page::addFooterToThePage("");
