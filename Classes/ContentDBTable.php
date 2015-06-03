<?php
/**
 * User: marcin
 * Date: 26/03/13
 * Time: 21:12
 * File name: ContentDBTable.php
 */
class ContentDBTable
{
    private $ifOfCourseContent;
    private $nameOfTheContent;
    private $filePath;
    private $contentForTheCourseID;

    public function setContentForTheCourseID($contentForTheCourseID)
    {
        $this->contentForTheCourseID = $contentForTheCourseID;
    }

    public function getContentForTheCourseID()
    {
        return $this->contentForTheCourseID;
    }

    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getFilePath()
    {
        return $this->filePath;
    }

    public function setIfOfCourseContent($ifOfCourseContent)
    {
        $this->ifOfCourseContent = $ifOfCourseContent;
    }

    public function getIfOfCourseContent()
    {
        return $this->ifOfCourseContent;
    }

    public function setNameOfTheContent($nameOfTheContent)
    {
        $this->nameOfTheContent = $nameOfTheContent;
    }

    public function getNameOfTheContent()
    {
        return $this->nameOfTheContent;
    }

}
