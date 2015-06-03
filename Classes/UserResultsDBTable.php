<?php
/**
 * User: Marcin
 * Date: 25/03/2013
 * Time: 07:37
 * File name: UserResultsDBTable.php
 */

class UserResultsDBTable
{
    private $id;
    private $idOfUser;
    private $idOfAssignment;
    private $idOfQuestion;
    private $validAnswerId;
    private $userAnswerId;
    private $isUserAnswerValid;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdOfAssignment($idOfAssignment)
    {
        $this->idOfAssignment = $idOfAssignment;
    }

    public function getIdOfAssignment()
    {
        return $this->idOfAssignment;
    }

    public function setIdOfQuestion($idOfQuestion)
    {
        $this->idOfQuestion = $idOfQuestion;
    }

    public function getIdOfQuestion()
    {
        return $this->idOfQuestion;
    }

    public function setIdOfUser($idOfUser)
    {
        $this->idOfUser = $idOfUser;
    }

    public function getIdOfUser()
    {
        return $this->idOfUser;
    }

    public function setIsUserAnswerValid($isUserAnswerValid)
    {
        $this->isUserAnswerValid = $isUserAnswerValid;
    }

    public function getIsUserAnswerValid()
    {
        return $this->isUserAnswerValid;
    }

    public function setUserAnswerId($userAnswerId)
    {
        $this->userAnswerId = $userAnswerId;
    }

    public function getUserAnswerId()
    {
        return $this->userAnswerId;
    }

    public function setValidAnswerId($validAnswerId)
    {
        $this->validAnswerId = $validAnswerId;
    }

    public function getValidAnswerId()
    {
        return $this->validAnswerId;
    }



    function __construct()
    {

    }

    function __destruct()
    {

    }
}
