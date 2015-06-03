<?php
/**
 * User: marcin
 * Date: 07/03/13
 * Time: 18:25
 * File name: UserAnswersTable.php
 */
class UserAnswersDBTable
{
    private $id;
    private $idOfUser;
    private $idOfQuestion;
    private $validAnswerId;
    private $userAnswerId;
    private $isUserAnswerValid;
    private $idOfAssignment;

    public function setIdOfAssignment($idOfAssignment)
    {
        $this->idOfAssignment = $idOfAssignment;
    }

    public function getIdOfAssignment()
    {
        return $this->idOfAssignment;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
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


}
