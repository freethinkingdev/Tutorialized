<?php
/**
 * User: Marcin
 * Date: 25/03/2013
 * Time: 07:35
 * File name: UserResultsDAO.php
 */
include_once "UserResultsDBTable.php";
include_once "Classes/Connect.php";

class UserResultsDAO extends Connect
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function returnAllQuestionsWhereUserAnsweredCorrectly($userId){
        $query = "SELECT * FROM ".$this->dbName.".userans where isUserAnswerValid = 1 and idOfUser = ".$userId;

    }

    public function getInformationAboutResult($id){
        $query = "SELECT * FROM ".$this->dbName.".userans where id = " . $id;
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("UserResultsDBTable");
        } else {
            $courseData = new UserResultsDBTable();

        }
        return $courseData;
    }

    public function getTotalNumberOfAssignments() {
        $ids = array();
        $query = "SELECT distinct idOfAssignment FROM ".$this->dbName.".userans";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $ids[] = $row[0];
        }
        return $ids;
    }

    public function getTotalNumberOfCorrectlyAnsweredQuestions() {
        $ids = array();
        $query = "SELECT distinct idOfQuestion FROM ".$this->dbName.".userans where isUserAnswerValid = 1";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $ids[] = $row[0];
        }
        return $ids;
    }

    public function getTotalNumberOfQuestions() {
        $ids = array();
        $query = "SELECT distinct idOfQuestion FROM ".$this->dbName.".userans";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $ids[] = $row[0];
        }
        return $ids;
    }
    public function getAnswerInformationByUserId($userId) {
        $query = "SELECT * FROM ".$this->dbName.".userans where idOfUser = ".$userId;
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("UserResultsDBTable");
        } else {
            $courseData = new UserResultsDBTable();

        }
        return $courseData;
    }

    public function getAllAnswerIdsForGivenUserId($userid){
        $ids = array();
        $query = "SELECT id FROM ".$this->dbName.".userans where idOfUser = ".$userid;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $ids[] = $row[0];
        }
        return $ids;
    }

    public function getAllAnswersIdsForGivenQuestionId($questionId) {
        $ids = array();
        $query = "select userAnswerId from userans where userAnswerId not like 0 and idOfQuestion = ".$questionId;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $ids[] = $row[0];
        }
        return $ids;
    }
    public function getAllAnswersIdsForGivenQuestionIdAndUserId($questionId,$userId) {
        $ids = array();
        $query = "select userAnswerId from userans where userAnswerId not like 0 and idOfQuestion = ".$questionId." and idOfUser = ".$userId;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $ids[] = $row[0];
        }
        return $ids;
    }

}
