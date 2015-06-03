<?php
/**
 * User: marcin
 * Date: 02/03/13
 * Time: 09:04
 * File name: GenerateAssignment.php
 */
include_once("Model/ModelQuestionsAnswers.php");
include_once("RequireOnceFile.php");

class GenerateAssignment
{
    private $question;

    public function __construct() {
        $this->question = new ModelQuestionsAnswers();
    }
    public function generateAssignmentHeader()
    {
        echo "<form>";
    }

    public function generateQuestionnaire($arrayOfQuestionsIdsToIncludeInQuestionnaire)
    {
        foreach ($arrayOfQuestionsIdsToIncludeInQuestionnaire as $questionID) {
            echo "Question: " . $this->question->getQuestionInformationByQuestionId($questionID)->getQuestionString() ."<br/>";
        }

    }

    public function generateOneQuestionForTheCourseOfId($idOfTheCourse) {

    }

    public function generateQuizz()
    {

    }

    public function generateAssignmentFooter()
    {
        echo "</form>";
    }

}
