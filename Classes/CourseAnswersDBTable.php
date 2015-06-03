<?php
/**
 * User: marcin
 * Date: 01/03/13
 * Time: 20:24
 * File name: CourseAnswersDBTable.php
 */
class CourseAnswersDBTable
{
    private $id;
    private $answerString;
    private $answerForTheQuestionNumber;
    private $isItValid;

    public function setAnswerForTheQuestionNumber($answerForTheQuestionNumber)
    {
        $this->answerForTheQuestionNumber = $answerForTheQuestionNumber;
    }

    public function getAnswerForTheQuestionNumber()
    {
        return $this->answerForTheQuestionNumber;
    }

    public function setAnswerString($answerString)
    {
        $this->answerString = $answerString;
    }

    public function getAnswerString()
    {
        return $this->answerString;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIsItValid($isItValid)
    {
        $this->isItValid = $isItValid;
    }

    public function getIsItValid()
    {
        return $this->isItValid;
    }


}
