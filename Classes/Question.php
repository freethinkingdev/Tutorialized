<?php
/**
 * User: marcin
 * Date: 02/03/13
 * Time: 14:13
 * File name: Question.php
 */
class Question
{
    private $questionString;
    private $questionIsForTheCourseID;
    private $questionType;

    public function setQuestionIsForTheCourseID($questionIsForTheCourseID)
    {
        $this->questionIsForTheCourseID = $questionIsForTheCourseID;
    }

    public function getQuestionIsForTheCourseID()
    {
        return $this->questionIsForTheCourseID;
    }

    public function setQuestionString($questionString)
    {
        $this->questionString = $questionString;
    }

    public function getQuestionString()
    {
        return $this->questionString;
    }

    public function setQuestionType($questionType)
    {
        $this->questionType = $questionType;
    }

    public function getQuestionType()
    {
        return $this->questionType;
    }

}
