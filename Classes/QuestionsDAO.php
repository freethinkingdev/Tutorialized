<?php
    /**
     * User: marcin
     * Date: 01/03/13
     * Time: 20:27
     * File name: QuestionsDAO.php
     * FIXME: Trzeba popracowac nad plikiem aby mial wszystkie metody
     */
    include_once "QuestionsDBTable.php";
    include_once "Classes/Connect.php";
class QuestionsDAO extends Connect
{
    private $question;

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getQuestionInformationByItsId($id)
    {
        $query = "select * from coursequestions where coursequestions.idOfQuestion = '" . $id . "' ";
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("QuestionsDBTable");
        } else {
            $courseData = new QuestionsDBTable();

        }
        return $courseData;
    }
    public function getQuestionInformationByItsString($questionsString)
    {
        $query = "select * from coursequestions where coursequestions.questionString like '%".$questionsString."%'";
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("QuestionsDBTable");
        } else {
            $courseData = new QuestionsDBTable();

        }
        return $courseData;
    }

    public function getQuestionInformationByItsIdAndTheCourseIdQuestionIsIntendedFor($id, $idOfTheCourse)
    {
        $query = "select * from coursequestions where idOfQuestion = " . $id . " and questionForTheCourseNumber = " . $idOfTheCourse;
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("QuestionsDBTable");
        } else {
            $courseData = new QuestionsDBTable();

        }
        return $courseData;
    }

    public function getAllQuestionIds()
    {

    }

    public function getAllQuestionsForParticularCourseId($id)
    {
        $allIds = array();
        $query = "select * from coursequestions where coursequestions.questionForTheCourseNumber = " . $id;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }



    public function getOneQuestionFromDBWhichIsForTheCourseId($idOfTheCourse)
    {
        $query = "select * from coursequestions where questionForTheCourseNumber =" . $idOfTheCourse;
        $res = $this->connection->query($query);
        if ($res) {
            $courseData = $res->fetch_object("QuestionsDBTable");
        } else {
            $courseData = new QuestionsDBTable();

        }
        return $courseData;
    }

    public function addNewQuestionToDatabase($questionObj) {
         $query = "INSERT INTO `".$this->dbName."`.`coursequestions` (`questionString`, `questionForTheCourseNumber`, `typeOfTheQuestion`) VALUES ('".$questionObj->getQuestionString()."', '".$questionObj->getQuestionIsForTheCourseID()."', '" . $questionObj->getQuestionType() ."')";
        $this->connection->query($query);
    }

    public function returnLastIdForQuestionsForGivenCourseId($courseId) {
        $query = "select * from coursequestions where questionForTheCourseNumber = ".$courseId." order by idOfQuestion desc limit 1";
        $lastId = array();
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $lastId[] = $row[0];
        }
        return $lastId;

    }

    public function insertQuestionAssignmentToDB ($questionAssignmentObject) {

        //echo 'question dao <br/>';
          $query = "INSERT INTO `".$this->dbName."`.`assignmentsquestion` (`nameOfTheAssignment`, `forTheCourseNumber`, `typeOfTheAssignment`, `isItPublic`, `q1`)
                  VALUES
                  ('".$questionAssignmentObject->getAssignmentName()."',
                   '".$questionAssignmentObject->getAssignmentForTheCourse()."',
                    '".$questionAssignmentObject->getAssignmentType()."',
                     '".$questionAssignmentObject->getAssignmentPublicAccess()."',
                      '".$questionAssignmentObject->getQuestionId()."')";
        $this->connection->query($query);
     }

       /*
        * this is function where i add a questionnaire to db with up to 10 questions
        */
    public function insertQuestionnaireAssignmentToDB($questionnaireAssignmentObject) {
        $query = "INSERT INTO `".$this->dbName."`.`assignmentsquestion` (`nameOfTheAssignment`, `forTheCourseNumber`, `typeOfTheAssignment`, `isItPublic`) VALUES ('".$questionnaireAssignmentObject->getAssignmentName()."', '".$questionnaireAssignmentObject->getAssignmentForTheCourse()."', '".$questionnaireAssignmentObject->getAssignmentType()."', '".$questionnaireAssignmentObject->getAssignmentPublicAccess()."')";
        $this->connection->query($query);
        $questionColumnInDB = 1;
        foreach ($questionnaireAssignmentObject->getArrayOfQuestionsIds() as $val) {
            $addingQuestions = "UPDATE `tutorialez`.`assignmentsquestion` SET `q$questionColumnInDB`='".$val."' WHERE `forTheCourseNumber`='".$questionnaireAssignmentObject->getAssignmentForTheCourse()."' and nameOfTheAssignment = '".$questionnaireAssignmentObject->getAssignmentName()."'";
            $questionColumnInDB++;
            $this->connection->query($addingQuestions);
        }
    }


    public function removeQuestionFromDB ($id) {
        //fixme: przed usunieciem pytania nalezy sprawdzic czy jest w quizie
        $query = "DELETE FROM `".$this->dbName."`.`coursequestions` WHERE `idOfQuestion`='".$id."'";
        $this->connection->query($query);
        $query2 = "DELETE FROM `".$this->dbName."`.`courseanswers` WHERE `answerForTheQuestionNumber`=".$id;
        $this->connection->query($query2);
     }
    public function returnAllIdsOfAllPossibleAnswersForGivenQuestionId($questionId) {
        $query = "SELECT id FROM ".$this->dbName.".courseanswers where answerForTheQuestionNumber = ".$questionId;
        $answerIDS = array();
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $answerIDS[] = $row[0];
        }
        return $answerIDS;
    }



}
