<?php
/**
 * User: Marcin
 * Date: 25/03/2013
 * Time: 07:39
 * File name: ModelUserResults.php
 */
include_once "RequireOnceFile.php";
include_once "Classes/UserResultsDAO.php";

class ModelUserResults
{
    private $results;

    function __construct()
    {
        $this->results = new UserResultsDAO();
    }

    function __destruct()
    {

    }

    public function returnAllDistinctIdsWhereUserAnsweredCorrectly($UserID){
        $this->results->returnAllQuestionsWhereUserAnsweredCorrectly($UserID);

    }

    public function retriveUserAnswerInformationByResultRowId($id){
        return $this->results->getInformationAboutResult($id);
    }

    public function getTheAnswerInformationByUserId($userId) {
        return $this->results->getAnswerInformationByUserId($userId);
    }

    public function getAllAnswerIdsForAGivenUserId($userid){
        return $this->results->getAllAnswerIdsForGivenUserId($userid);
    }
}
