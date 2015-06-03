<?php
/**
 * User: Marcin
 * Date: 09/03/2013
 * Time: 10:32
 * File name: AssignmentClass.php
 */
class AssignmentClass
{
    private $assignmentName;
    private $assignmentType;
    private $assignmentPublicAccess;
    private $assignmentQuestions;
    private $questionId;
    private $assignmentClosingDate;
    private $assignmentForTheCourse;
    private $arrayOfQuestionsIds = array();

    public function setArrayOfQuestionsIds($arrayOfQuestionsIds)
    {
        $this->arrayOfQuestionsIds = $arrayOfQuestionsIds;
    }

    public function getArrayOfQuestionsIds()
    {
        return $this->arrayOfQuestionsIds;
    }



    public function setAssignmentForTheCourse($assignmentForTheCourse)
    {
        $this->assignmentForTheCourse = $assignmentForTheCourse;
    }

    public function getAssignmentForTheCourse()
    {
        return $this->assignmentForTheCourse;
    }



    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }

    public function getQuestionId()
    {
        return $this->questionId;
    }


    public function setAssignmentClosingDate($assignmentClosingDate)
    {
        $this->assignmentClosingDate = $assignmentClosingDate;
    }

    public function getAssignmentClosingDate()
    {
        return $this->assignmentClosingDate;
    }



    public function setAssignmentName($assignmentName)
    {
        $this->assignmentName = $assignmentName;
    }

    public function getAssignmentName()
    {
        return $this->assignmentName;
    }

    public function setAssignmentPublicAccess($assignmentPublicAccess)
    {
        $this->assignmentPublicAccess = $assignmentPublicAccess;
    }

    public function getAssignmentPublicAccess()
    {
        return $this->assignmentPublicAccess;
    }

    public function setAssignmentQuestions($assignmentQuestion)
    {
        $this->assignmentQuestions = $assignmentQuestion;
    }

    public function getAssignmentQuestions()
    {
        return $this->assignmentQuestions;
    }

    public function setAssignmentType($assignmentType)
    {
        $this->assignmentType = $assignmentType;
    }

    public function getAssignmentType()
    {
        return $this->assignmentType;
    }




    function __construct()
    {

    }

    function __destruct()
    {

    }
}
