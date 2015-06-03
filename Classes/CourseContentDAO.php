<?php
/**
 * User: marcin
 * Date: 28/02/13
 * Time: 15:22
 * File name: CourseContentDAO.php
 */
include_once "CourseContentDBTable.php";
include_once "Classes/Connect.php";

class CourseContentDAO extends Connect
{
    private $course;

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getAllIds()
    {
        $allIds = array();
        $query = "select ifOfCourseContent from coursecontent";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function getAllIdsWhichHaveContentForParticularCourseId($id)
    {
        $allIds = array();
        $query = "SELECT * FROM coursecontent where contentForTheCourseID = " . $id;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function getAllIdsWhichHaveSearchedContentContentForParticularCourseId($idOfTheCourse,$searchedfraze)
    {
        $allIds = array();
        //$query = "SELECT * FROM coursecontent where contentForTheCourseID = " . $id;
        $query = "SELECT ifOfCourseContent FROM tutorialez.coursecontent where nameOfTheContent like '%".$searchedfraze."%' and contentForTheCourseID = ".$idOfTheCourse;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function getCourseContentDataById($id)
    {
        $query = "select * from coursecontent where coursecontent.ifOfCourseContent = " . $id;
        $res = $this->connection->query($query);
        if ($res) {
            $courseContentData = $res->fetch_object("CourseContentDBTable");
        } else {
            $courseContentData = new CourseContentDBTable();

        }
        return $courseContentData;
    }

    public function getCourseContentDataByIdAndCourseId($id, $idOfTheCourse)
    {
        $query = "select * from coursecontent where coursecontent.ifOfCourseContent = " . $id . " and coursecontent.contentForTheCourseID = " . $idOfTheCourse;
        $res = $this->connection->query($query);
        if ($res) {
            $courseContentData = $res->fetch_object("CourseContentDBTable");
        } else {
            $courseContentData = new CourseContentDBTable();

        }
        return $courseContentData;
    }

    public function getSearchedContent($idOfTheCourse,$searchedFraze)
    {
        echo $query = "SELECT * FROM ".$this->dbName.".coursecontent where nameOfTheContent like '%".$searchedFraze."%' and contentForTheCourseID = ".$idOfTheCourse;
        $res = $this->connection->query($query);
        if ($res) {
            $courseContentData = $res->fetch_object("CourseContentDBTable");
        } else {
            $courseContentData = new CourseContentDBTable();

        }
        return $courseContentData;
    }

    public function removeContentFromDBbyId($id)
    {
        $query = "DELETE FROM coursecontent WHERE ifOfCourseContent =" . $id;
        $this->connection->query($query);
    }

    public function insertFileContentToDB($fName, $filePath, $idOfTheCourse)
    {
        $query = "INSERT INTO coursecontent (`nameOfTheContent`, `filePath`, `contentForTheCourseID`) VALUES ('" . $fName . "', '" . $filePath . "', '" . $idOfTheCourse . "')";
        $this->connection->query($query);
    }
/*
    public function searchForContentInDatabase($fraze, $coursecontent) {
        $sql = "SELECT * FROM tutorialez.coursecontent where nameOfTheContent like '%".$fraze."%' and contentForTheCourseID = ".$coursecontent;
        $idsArray = array();
        $res = $this->connection->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_row()) {
                $idsArray[] = $row[0];
            }
            echo "found some ";
            echo $numOfRows = $res->num_rows;
            $webData = $res->fetch_object("ContentDBTable");
        } else {
            echo "Sorry, no results. Try to type another set of characters.";
           echo '<script type="text/javascript">alert("No results found.");</script>';
            $webData = new ContentDBTable();
        }
        return array($webData, $idsArray);

    }*/



}
