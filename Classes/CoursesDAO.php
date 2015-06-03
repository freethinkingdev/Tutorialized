<?php
/**
 * User: marcin
 * Date: 28/02/13
 * Time: 09:47
 * File name: CoursesDAO.php
 */
include_once "CoursesDBTable.php";
include_once "Classes/Connect.php";
class CoursesDAO extends Connect
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

    public function getAllCourseById($id) {
        $query = "select * from courses where idOfTheCourse = " . $id;
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("CoursesDBTable");
        } else {
            $courseData = new CoursesDBTable();

        }
        return $courseData;
    }

    public function getCourseDataById($id)
    {

        $query = "select * from courses where `courses`.`idOfTheCourse` = '" . $id . "' ";
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("CoursesDBTable");
        } else {
            $courseData = new CoursesDBTable();

        }
        return $courseData;
    }

    public function getAllIds(){
        $allIds = array();
        $query = "select idOfTheCourse from courses";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function insertFileContentToDB($fName,$filePath,$idOfTheCourse) {
        $query = "INSERT INTO coursecontent (`nameOfTheContent`, `filePath`, `contentForTheCourseID`) VALUES ('".$fName."', '".$filePath."', '".$idOfTheCourse."')";
        $this->connection->query($query);
    }


    public function insertNewCourseToTheDB($courseName,$courseDescription) {
        $query = "INSERT INTO courses (`nameOfTheCourse`, `descriptionOfTheCourse`) VALUES ('".$courseName."', '".$courseDescription."');";
        $this->connection->query($query);
    }
    public function deleteCourseFromDB($id) {
        $query = "DELETE FROM courses WHERE `idOfTheCourse`='".$id."'";
        $this->connection->query($query);
    }

       public function removeAssignmentWithAGivenId ($idOfAssignment) {
         $query = "DELETE FROM `".$this->dbName."`.`assignmentsquestion` WHERE `id`='".$idOfAssignment."'";
         $this->connection->query($query);


        }
}
