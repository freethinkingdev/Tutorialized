<?php
/**
 * User: marcin
 * Date: 01/03/13
 * Time: 20:26
 * File name: QuestionsDBTable.php
 */
class QuestionsDBTable
{
    private $idOfQuestion;
    private $questionString;
    private $questionForTheCourseNumber;
    private $typeOfTheQuestion;

    public function setTypeOfTheQuestion($typeOfTheQuestion)
    {
        $this->typeOfTheQuestion = $typeOfTheQuestion;
    }

    public function getTypeOfTheQuestion()
    {
        return $this->typeOfTheQuestion;
    }



    public function setIdOfQuestion($idOfQuestion)
    {
        $this->idOfQuestion = $idOfQuestion;
    }

    public function getIdOfQuestion()
    {
        return $this->idOfQuestion;
    }

    public function setQuestionForTheCourseNumber($questionForTheCourseNumber)
    {
        $this->questionForTheCourseNumber = $questionForTheCourseNumber;
    }

    public function getQuestionForTheCourseNumber()
    {
        return $this->questionForTheCourseNumber;
    }

    public function setQuestionString($questionString)
    {
        $this->questionString = $questionString;
    }

    public function getQuestionString()
    {
        return $this->questionString;
    }

}
