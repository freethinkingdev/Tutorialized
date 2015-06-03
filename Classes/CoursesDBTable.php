<?php
/**
 * User: marcin
 * Date: 28/02/13
 * Time: 09:48
 * File name: CoursesDBTable.php
 */
class CoursesDBTable
{
    private $idOfTheCourse;
    private $nameOfTheCourse;
    private $descriptionOfTheCourse;

    public function setDescriptionOfTheCourse($descriptionOfTheCourse)
    {
        $this->descriptionOfTheCourse = $descriptionOfTheCourse;
    }

    public function getDescriptionOfTheCourse()
    {
        return $this->descriptionOfTheCourse;
    }

    public function setIdOfTheCourse($idOfTheCourse)
    {
        $this->idOfTheCourse = $idOfTheCourse;
    }

    public function getIdOfTheCourse()
    {
        return $this->idOfTheCourse;
    }

    public function setNameOfTheCourse($nameOfTheCourse)
    {
        $this->nameOfTheCourse = $nameOfTheCourse;
    }

    public function getNameOfTheCourse()
    {
        return $this->nameOfTheCourse;
    }


}
