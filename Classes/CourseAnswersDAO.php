<?php
/**
 * User: marcin
 * Date: 01/03/13
 * Time: 20:24
 * File name: CourseAnswersDAO.php
 */
include_once "CourseAnswersDBTable.php";
include_once "Classes/Connect.php";
class CourseAnswersDAO extends Connect
{
    
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    public function getAnswerInformationByItsId($id)
    {
        $query = "SELECT * FROM ".$this->dbName.".courseanswers where id = " . (int)$id;
        $res = $this->connection->query($query);
        if ($res) {
            $answerData = $res->fetch_object("CourseAnswersDBTable");
        } else {
            $answerData = new CourseAnswersDBTable();

        }
        return $answerData;
    }

    public function getAllAnswersIdsByTheQuestionIdTheyAreAnswersFor($idOfTheQuestion)
    {
        $query = "SELECT * FROM courseanswers where answerForTheQuestionNumber = " . $idOfTheQuestion;
        $res = $this->connection->query($query);
        if ($res) {
            $assignmentData = $res->fetch_object("CourseAnswersDBTable");
        } else {
            $assignmentData = new CourseAnswersDBTable();

        }
        return $assignmentData;
    }


    public function addAnswersToDB($answersObj)
    {
        if ($answersObj->getAnswer1String() != null) {
            $query1 = "INSERT INTO `".$this->dbName."`.`courseanswers` (`answerString`, `answerForTheQuestionNumber`, `isItValid`) VALUES ('" . $answersObj->getAnswer1String() . "', '" . $answersObj->getAnswersAreForTheQuestionID() . "', '" . $answersObj->getIsAnswer1Valid() . "')";
            $this->connection->query($query1);
        }


        if ($answersObj->getAnswer2String() != null) {
            $query2 = "INSERT INTO `".$this->dbName."`.`courseanswers` (`answerString`, `answerForTheQuestionNumber`, `isItValid`) VALUES ('" . $answersObj->getAnswer2String() . "', '" . $answersObj->getAnswersAreForTheQuestionID() . "', '" . $answersObj->getIsAnswer2Valid() . "')";
            $this->connection->query($query2);
        }

        if ($answersObj->getAnswer3String() != null) {
            $query3 = "INSERT INTO `".$this->dbName."`.`courseanswers` (`answerString`, `answerForTheQuestionNumber`, `isItValid`) VALUES ('" . $answersObj->getAnswer3String() . "', '" . $answersObj->getAnswersAreForTheQuestionID() . "', '" . $answersObj->getIsAnswer3Valid() . "')";
            $this->connection->query($query3);
        }

        if ($answersObj->getAnswer4String() != null) {
            $query4 = "INSERT INTO `".$this->dbName."`.`courseanswers` (`answerString`, `answerForTheQuestionNumber`, `isItValid`) VALUES ('" . $answersObj->getAnswer4String() . "', '" . $answersObj->getAnswersAreForTheQuestionID() . "', '" . $answersObj->getIsAnswer4Valid() . "')";
            $this->connection->query($query4);
        }
        if ($answersObj->getAnswer5String() != null) {
            $query5 = "INSERT INTO `".$this->dbName."`.`courseanswers` (`answerString`, `answerForTheQuestionNumber`, `isItValid`) VALUES ('" . $answersObj->getAnswer5String() . "', '" . $answersObj->getAnswersAreForTheQuestionID() . "', '" . $answersObj->getIsAnswer5Valid() . "')";
            $this->connection->query($query5);
        }
        if ($answersObj->getAnswer6String() != null) {
            $query6 = "INSERT INTO `".$this->dbName."`.`courseanswers` (`answerString`, `answerForTheQuestionNumber`, `isItValid`) VALUES ('" . $answersObj->getAnswer6String() . "', '" . $answersObj->getAnswersAreForTheQuestionID() . "', '" . $answersObj->getIsAnswer6Valid() . "')";
            $this->connection->query($query6);
        }

    }

    public function returnTotalNumberOfColumns($tableName)
    {
        $query = "SELECT count(*) FROM information_schema.`COLUMNS` C WHERE table_name = '" . $tableName . "' AND TABLE_SCHEMA = '".$this->dbName."'";
        $res = $this->connection->query($query);

    }

    public function getCorrectAnswerForQuestionId($idOfTheQuestion)
    {
        $query = "SELECT * FROM ".$this->dbName.".coursequestions join courseanswers on coursequestions.idOfQuestion = courseanswers.answerForTheQuestionNumber where coursequestions.idOfQuestion = " . $idOfTheQuestion . " and courseanswers.isItValid = 1";
        $res = $this->connection->query($query);
        if ($res) {
            $assignmentData = $res->fetch_object("CourseAnswersDBTable");
        } else {
            $assignmentData = new CourseAnswersDBTable();

        }
        return $assignmentData;
    }

    public function getAllIdsOfCorrectAnswersForGivenQuestionId($idOfTheQuestion)
    {
        $allIds = array();
        //$query = "SELECT * FROM tutorialez.coursequestions join courseanswers on coursequestions.idOfQuestion = courseanswers.answerForTheQuestionNumber where coursequestions.idOfQuestion = ".$idOfTheQuestion." and courseanswers.isItValid = 1";
        $query = "SELECT id FROM ".$this->dbName.".courseanswers where answerForTheQuestionNumber = {$idOfTheQuestion} and courseanswers.isItValid = 1";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function findIdOfTheQuestionGivenAnswerIdIsFor($idOfAnswer)
    {
        $allIds = array();
        $query = "SELECT answerForTheQuestionNumber FROM ".$this->dbName.".courseanswers where id = " . $idOfAnswer;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds[0];

    }

    public function findIdOfTheQuestionGivenAnswerStringIsFor($answerString)
    {
        $allIds = array();
        $query = "SELECT answerForTheQuestionNumber from courseanswers where answerString like '" . $answerString . "'";
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds[0];

    }

    public function checkIfThEAnswerIdIsValidForGivenQuestion($answerId, $questionId)
    {
        $isItValid = array();
        $query = "SELECT courseanswers.isItValid FROM ".$this->dbName.".courseanswers where id = " . $answerId . " and answerForTheQuestionNumber = " . $questionId;

        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $isItValid[] = $row[0];
        }
        return @$isItValid[0];
    }

    public function insertUserAnswerForAssignmentInDB($answerObject)
    {
        $query = "INSERT INTO `".$this->dbName."`.`userans` (`idOfUser`, `idOfAssignment`, `idOfQuestion`, `validAnswerId`, `userAnswerId`, `isUserAnswerValid`)
VALUES ('" . $answerObject->getIdOfUser() . "', '" . $answerObject->getIdOfAssignment() . "', '" . $answerObject->getIdOfQuestion() . "', '" . $answerObject->getValidAnswerId() . "', '" . $answerObject->getUserAnswerId() . "', '" . $answerObject->getIsUserAnswerValid() . "')";
        $this->connection->query($query);
    }

    public function updateUserAnswerTableProvidingIdofRow($rowId, $answerId, $valid)
    {

        $query = "UPDATE `".$this->dbName."`.`userans` SET `userAnswerId`='" . $answerId . "', `isUserAnswerValid`='" . $valid . "' WHERE `id`='" . $rowId . "'";

        $this->connection->query($query);

    }

    public function returnTableWithIdsForGivenQuestionsIDfromUserAnswerTable($questionId, $assignmentId, $userId)
    {
        $allIds = array();
        //$query = "select * from userans where idOfQuestion = ".$questionId." and idOfAssignment = ".$assignmentId;
        $query = "select * from userans where idOfQuestion = " . $questionId . " and idOfAssignment = " . $assignmentId . " and idOfUser = " . $userId;
        $res = $this->connection->query($query);
        while ($row = $res->fetch_row()) {
            $allIds[] = $row[0];
        }
        return $allIds;
    }

    public function updateAnswerRowInDBbyAddingIdOfCorrectAnswer($id)
    {
        br();
        echo $query = "UPDATE `".$this->dbName."`.`userans` SET `validAnswerId`='" . $id . "' WHERE `id`='1'";

        $this->connection->query($query);
    }


}
