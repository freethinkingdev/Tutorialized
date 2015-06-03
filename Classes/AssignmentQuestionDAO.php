<?php
/**
 * User: Marcin
 * Date: 09/03/2013
 * Time: 13:08
 * File name: AssignmentQuestionDAO.php
 */
include_once "AssignmentQuestionDBTable.php";
include_once "ContentDBTable.php";
include_once "Classes/Connect.php";
class AssignmentQuestionDAO extends Connect
{
    
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getAllAssignmentsForParticularCourseId ($id) {
        $allIds = array();
        $query = '';
        if(!isUser()) {
            $query = "SELECT * FROM ".$this->dbName.".assignmentsquestion where forTheCourseNumber = " . $id;
        } else {
            $query = "SELECT * FROM ".$this->dbName.".assignmentsquestion where forTheCourseNumber = '".$id."' and isItPublic = 'yes'";
        }


        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function getAssignmentInformationByItsIdAndCourseId($idOfASsignment, $courseId)
    {
        $query = "SELECT * FROM ".$this->dbName.".assignmentsquestion where id = ".$idOfASsignment." and forTheCourseNumber = ".$courseId;
        $res = $this->connection->query($query);
        if ($res) {
            $assignmentData = $res->fetch_object("AssignmentQuestionDBTable");
        } else {
            $assignmentData = new AssignmentQuestionDBTable();

        }
        return $assignmentData;
    }

    public function getAssignmentInformationByItsId($idOfAssignment)
    {
        $query = "SELECT * FROM ".$this->dbName.".assignmentsquestion where id = ".$idOfAssignment ;

        $res = $this->connection->query($query);
        if ($res) {
            $assignmentData = $res->fetch_object("AssignmentQuestionDBTable");
        } else {
            $assignmentData = new AssignmentQuestionDBTable();

        }
        return $assignmentData;
    }


    /*
     * Returning all ids of possible questions for given assignment id
     */
    public function getAllQuestionsForGivenAssignmentId($idOfAssignment)
    {
        // Declaring array
        $allIds = array();
        // Query, which selects all POSSIBLE questions for given assingment. Some values might be NULL!!!
        $query = "SELECT q1,q2,q3,q4,q5,q6,q7,q8,q9,q10 FROM ".$this->dbName.".assignmentsquestion where id = " . $idOfAssignment;
        // Returning rows of data
        $res = $this->connection->query($query);

        while ($row = $res->fetch_row()) {
            $i = 0;
            foreach ($row as $val) {
                // For each row, which is NOT NULL, I add it to the array of ids for guven assignment
                if ($val != NULL) {
                    // number of index in an array is increased with the variable $i
                    $allIds[] = $row[$i];
                    $i++;
                }
            }


        }
        return $allIds;

    }



    public function returnAllIdsOfAnswersForGivenQuestionID ($questionId) {
        $allIds = array();
        $query = "SELECT id FROM ".$this->dbName.".courseanswers where answerForTheQuestionNumber =" . $questionId;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function editAssignmentDetails($assignmentid,$assignmnetName,$assignmentPublicity) {
        $query = "UPDATE `".$this->dbName."`.`assignmentsquestion` SET `nameOfTheAssignment`='".$assignmnetName."', `isItPublic`='".$assignmentPublicity."' WHERE `id`='".$assignmentid."'";
        $this->connection->query($query);

    }




}
