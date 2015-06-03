<?php
/**
 * User: Marcin
 * Date: 09/03/2013
 * Time: 13:09
 * File name: AssignmentQuestionDBTable.php
 */
class AssignmentQuestionDBTable
{

private $id;
private $nameOfTheAssignment;
private $forTheCourseNumber;
private $typeOfTheAssignment;
private $isItPublic;
private $closingDate;
private $q1;

    public function setClosingDate($closingDate)
    {
        $this->closingDate = $closingDate;
    }

    public function getClosingDate()
    {
        return $this->closingDate;
    }

    public function setForTheCourseNumber($forTheCourseNumber)
    {
        $this->forTheCourseNumber = $forTheCourseNumber;
    }

    public function getForTheCourseNumber()
    {
        return $this->forTheCourseNumber;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIsItPublic($isItPublic)
    {
        $this->isItPublic = $isItPublic;
    }

    public function getIsItPublic()
    {
        return $this->isItPublic;
    }

    public function setNameOfTheAssignment($nameOfTheAssignment)
    {
        $this->nameOfTheAssignment = $nameOfTheAssignment;
    }

    public function getNameOfTheAssignment()
    {
        return $this->nameOfTheAssignment;
    }

    public function setQ1($q1)
    {
        $this->q1 = $q1;
    }

    public function getQ1()
    {
        return $this->q1;
    }

    public function setTypeOfTheAssignment($typeOfTheAssignment)
    {
        $this->typeOfTheAssignment = $typeOfTheAssignment;
    }

    public function getTypeOfTheAssignment()
    {
        return $this->typeOfTheAssignment;
    }

    function __construct()
    {

    }

    function __destruct()
    {

    }
}
