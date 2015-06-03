<?php
/**
 * User: marcin
 * Date: 01/03/13
 * Time: 20:39
 * File name: ModelQuestionsAnswers.php
 */
include_once "Classes/QuestionsDAO.php";
include_once "Classes/CourseAnswersDAO.php";
include_once "Classes/AssignmentQuestionDAO.php";
include_once "Classes/CoursesDAO.php";
include_once "RequireOnceFile.php";
class ModelQuestionsAnswers
{
    private $question;
    private $answer;
    private $assignment;
    private $result;
    private $course;


    private $numberOfQuestionsForAssignment;


    public function __construct()
    {
        $this->question = new QuestionsDAO();
        $this->answer = new CourseAnswersDAO();
        $this->assignment = new AssignmentQuestionDAO();
        $this->result = new UserResultsDAO();
        $this->course = new CoursesDAO();
    }

    public function __destruct()
    {

    }

    public function getAllIdsOfQuestionsForParticularCourseId($id)
    {
        return $this->question->getAllQuestionsForParticularCourseId($id);
    }

    public function getAllIdsOfAssignmentsForAparticularCourseId($idOfTheCourse)
    {
        return $this->assignment->getAllAssignmentsForParticularCourseId($idOfTheCourse);
    }

    public function getOneQuestionForParticulatCourseId($idOfTheCourse)
    {
        return $this->getOneQuestionForParticulatCourseId($idOfTheCourse);
    }

    /*
     * Id is the id of the question itself
     */
    public function returnTableWithAllQuestions($id)
    {
        $questions = array();
        $questions[] = $this->question->getQuestionInformationByItsId($id)->getIdOfQuestion();
        $questions[] = "<a href='' title=''>" . $this->question->getQuestionInformationByItsId($id)->getQuestionString() . "</a>";
        switch ($this->question->getQuestionInformationByItsId($id)->getTypeOfTheQuestion()) {
            case 1:
                $questions[] = "<a href='' title=''>Likert</a>";
                break;
            case 2:
                $questions[] = "<a href='' title=''>Multiple choice</a>";
                break;
            case 3:
                $questions[] = "<a href='' title=''>One choice</a>";
                break;
            case 4:
                $questions[] = "<a href='' title=''>True/False</a>";
                break;
        }
        //$questions[] = "<a href='' title=''>" . $this->question->getQuestionInformationByItsId($id)->getTypeOfTheQuestion() . "</a>";

        $questions[] = "<a href='index.php?direction=removeQuestionFromTheSet&id=" . $id . "' title='Click here in order to delete course and all content related to the course'>X</a>";
        return $questions;
    }

    public function returnTableWithAllQuestionsForAssignment($id)
    {
        $questions = array();
        $questions[] = "<a href='' title=''>" . $this->question->getQuestionInformationByItsId($id)->getQuestionString() . "</a>";
        /*
        switch ($this->question->getQuestionInformationByItsId($id)->getTypeOfTheQuestion()) {
            case 1:
                $questions[] = "<a href='' title='Likert scale'>Likert</a>";
                break;
            case 2:
                $questions[] = "<a href='' title='Multiple choice'>Multiple choice</a>";
                break;
            case 3:
                $questions[] = "<a href='' title='One choice'>One choice</a>";
                break;
            case 4:
                $questions[] = "<a href='' title='True/false'>True/False</a>";
                break;
        }
        */
        //$questions[] = "<a href='' title=''>" . $this->question->getQuestionInformationByItsId($id)->getTypeOfTheQuestion() . "</a>";


        return $questions;
    }

    public function returnTableWithAllQuestionsForAssignmentInTheFormType($id)
    {
        $questions = array();
        $questions[] = "<label>" . $this->question->getQuestionInformationByItsId($id)->getQuestionString() . "</label>";
        return $questions;
    }

    public function returnTableWithAllQuestionAssignments($id)
    {
        $assignments = array();
        $assignments[] = "<a href='index.php?direction=singleAssignmentPage&assId=" . $this->assignment->getAssignmentInformationByItsId($id)->getId() . "' title=''>" . $this->assignment->getAssignmentInformationByItsId($id)->getNameOfTheAssignment() . "</a>";
        switch ($this->assignment->getAssignmentInformationByItsId($id)->getTypeOfTheAssignment()) {
            case 1:
                // Code for the case
                $assignments[] = '<span title="A question is a single query">Question</span>';
                break;
            case 2:
                // Code for the case
                $assignments[] = '<span title="A quiz is a collection of three or more queries">Quiz</span>';
                break;
            case 3:
                // Code for the case
                $assignments[] = '<span title="A questionnaire comprises four or more queries">Questionnaire</span>';
                break;

            default:
                // Default action
                break;
        }
        if (!isUser()) {
            switch ($this->assignment->getAssignmentInformationByItsId($id)->getIsItPublic()) {
                case 'yes':
                    $assignments[] = "Yes";
                    break;
                case 'no':
                    $assignments[] = "No";
                    break;
            }
            $assignments[] = "<a href='index.php?direction=editAssignmentOptions&id=" . $id . "' title='Click here in order to delete course and all content related to the course'>Edit</a>";
            $assignments[] = "<a href='index.php?direction=removeAssignmentWithGivenId&id=" . $id . "' title='Click here in order to delete course and all content related to the course'>X</a> | <a href='index.php?direction=exportCourseAsXML&id=" . $id . "' title='Click here to export assignment as XML'>Export</a>";
        }
        return $assignments;
    }

    /*
     * Return the array of all ids of questions for provided course id
     */
    public function returnAllQuestionsByTheCourseId($id)
    {
        return $this->question->getAllQuestionsForParticularCourseId($id);
    }

    /*
     * Once the id of the question is provided, user is able to access different properties from DTO of question table
     */
    public function getQuestionInformationByQuestionId($id)
    {
        return $this->question->getQuestionInformationByItsId($id);
    }

    public function getAnswerInformationByItsId($id)
    {
        return $this->answer->getAnswerInformationByItsId($id);
    }

    /*
     * Method adding new question to the course of given id
     * I am creating new question object and set its properties from post. I look up
     * last id of the question for the course and then creating answer object, which i hook up
     * to the last id, which is the question object just created.
     */
    public function addNewQuestionForTheCourse()
    {

        if (isset($_POST['courseId'])) {
            $questionType = '';
            switch ($_POST['questionType']) {
                case "one choice only":
                    $questionType = 3;
                    break;
                case "true/False":
                    $questionType = 4;
                    break;
                case "likert":
                    $questionType = 1;
                    break;
                case "multiple choice":
                    $questionType = 2;
                    break;

            }
            $questionText = $_POST['questionText'];
            $answer1 = $_POST['possibleAnswer1'];
            $answer2 = $_POST['possibleAnswer2'];
            $answer3 = $_POST['possibleAnswer3'];
            $answer4 = $_POST['possibleAnswer4'];
            $answer5 = $_POST['possibleAnswer5'];
            $answer6 = $_POST['possibleAnswer6'];
            $idOfTheCourse = $_POST['courseId'];
            $validAnswers = $_POST['valid'];

            $questionObj = new Question();
            $questionObj->setQuestionType($questionType);
            $questionObj->setQuestionIsForTheCourseID($idOfTheCourse);
            $questionObj->setQuestionString($questionText);

            /*
             * Passing question object
             */
            $this->question->addNewQuestionToDatabase($questionObj);
            $idOfTheLastQuestionForCourse = $this->question->returnLastIdForQuestionsForGivenCourseId($idOfTheCourse)[0];

            $answers = new Answer();
            $answers->setAnswer1String($answer1);
            $answers->setAnswer2String($answer2);
            $answers->setAnswer3String($answer3);
            $answers->setAnswer4String($answer4);
            $answers->setAnswer5String($answer5);
            $answers->setAnswer6String($answer6);

            $answers->setAnswersAreForTheQuestionID($idOfTheLastQuestionForCourse);

            foreach ($validAnswers as $val) {
                //echo $val . "<br/>";
                switch ($val) {
                    case 'answer1':
                        $answers->setIsAnswer1Valid('1');
                        break;
                    case 'answer2':
                        $answers->setIsAnswer2Valid('1');
                        break;
                    case 'answer3':
                        $answers->setIsAnswer3Valid('1');
                        break;
                    case 'answer4':
                        $answers->setIsAnswer4Valid('1');
                        break;
                    case 'answer5':
                        $answers->setIsAnswer5Valid('1');
                        break;
                    case 'answer6':
                        $answers->setIsAnswer6Valid('1');
                        break;
                }
            }
            /*
             * Passing answer object
             */
            $this->answer->addAnswersToDB($answers);

        } else {
            echo "Didn't received values";
        }
    }

    public function addNewAssignmentData()
    {
        //echo 'Add new assignment data - model<br/>';

        if (isset($_POST['assignmentName']) or isset($_POST['assignmentQuestions'])) {

            @$newAssignment = new AssignmentClass();
            @$newAssignment->setAssignmentName($_POST['assignmentName']);
            @$newAssignment->setAssignmentForTheCourse($_POST['forTheCourse']);
            @$newAssignment->setAssignmentPublicAccess($_POST['assignmentAccess']);
            @$newAssignment->setAssignmentType($_POST['assignmentType']);


            /*
             * Switch statement determines what type of a question is
             */
            switch ($_POST['assignmentType']) {

                /*******************************************************************************************************/
                case 'question':
                    // Code for the case
                    $newAssignment->setQuestionId($_POST['assignmentQuestions']);
                    $newAssignment->setAssignmentType('1');
                    $this->question->insertQuestionAssignmentToDB($newAssignment);
                    break;
                /*******************************************************************************************************/
                case 'questionnaire':
                    // Dla kwestionariusza musze policzyc ile jest pytan, a pozniej te pytania dodac do tabelki
                    // Mozliwe, ze uda mi sie to zrobic za pomoca perli foreach.

                    // Creating new array to hold ids of questions
                    $numberOfQQuestions = array();
                    foreach ($_POST['assignmentQuestions'] as $qid) {
                        array_push($numberOfQQuestions, $qid);
                    }
                    $newAssignment->setAssignmentType('3');
                    $newAssignment->setArrayOfQuestionsIds($numberOfQQuestions);
                    $this->question->insertQuestionnaireAssignmentToDB($newAssignment);

                    break;
                /*******************************************************************************************************/
                case 'quiz':
                    // Code for the case
                    $numberOfQQuestions = array();
                    foreach ($_POST['assignmentQuestions'] as $qid) {
                        array_push($numberOfQQuestions, $qid);
                    }
                    $newAssignment->setAssignmentType('2');
                    $newAssignment->setArrayOfQuestionsIds($numberOfQQuestions);
                    $this->question->insertQuestionnaireAssignmentToDB($newAssignment);
                    break;
                /*********************** Importing assignment from XML file **********************************/
                case 'import':
                    // Code for the case
                    //echo "You are trying to import assignment";
                    //dump($_FILES['assignmentFileToImport']);
                    // If uploaded file has been successfully copied
                    if (move_uploaded_file($_FILES['assignmentFileToImport']['tmp_name'], "vData/".$_FILES['assignmentFileToImport']['name'])) {
                        $assignmentType = ucfirst($_POST['assignmentTypeChoosenByUser']);
                        
                        $newImportQuestion = new Question();
                        $file = "vData/".$_FILES['assignmentFileToImport']['name'];
                        $f = simplexml_load_file($file);

                        $qTopic = $f->xpath('/questions/topic')[0];
                        $courseID = $_POST['forTheCourse'];
                        $questions = $f->xpath('/questions/question');

                        @$newAssignment->setAssignmentName($qTopic);
                        @$newAssignment->setAssignmentForTheCourse($courseID);
                        @$newAssignment->setAssignmentPublicAccess("no");
                        switch ($assignmentType) {
                            case "Questionnaire":
                                @$newAssignment->setAssignmentType('3');
                                break;
                            case "Question":
                                @$newAssignment->setAssignmentType('1');
                                break;
                            case "Quiz":
                                @$newAssignment->setAssignmentType('2');
                                break;
                        }

                        /*Loops which takes questions from xml file*/
                        $arrayOfQuestions = array();
                        foreach ($questions as $question) {

                            $qNumber = $question[@number];
                            $qType = $question->type;
                            $qString = $question->title;

                            $questionType = '';

                            //echo $qType . "<br/> " . $qString . " </br>";
                                switch ($qType) {
                                    case "OneChoice":
                                        $questionType = 3;
                                        break;
                                    case "TrueFalse":
                                        $questionType = 4;
                                        break;
                                    case "Likert":
                                        $questionType = 1;
                                        break;
                                    case "Multiple":
                                        $questionType = 2;
                                        break;
                                }
                            $newImportQuestion->setQuestionType($questionType);
                            $newImportQuestion->setQuestionString($qString);
                            $newImportQuestion->setQuestionIsForTheCourseID($courseID);
                            /*!!!!!!!!!!!!!!  This is where i add question to database !!!!!!!!!!!!!! */
                            $this->question->addNewQuestionToDatabase($newImportQuestion);
                            array_push($arrayOfQuestions, $this->question->getQuestionInformationByItsString($qString)->getIdOfQuestion());
                            $idOfTheLastQuestionForCourse = $this->question->returnLastIdForQuestionsForGivenCourseId($courseID)[0];
                            $answers = $f->xpath('/questions/question/answers[@set="'.$qNumber.'"]/answer');
                            //$correctAnswers = $f->xpath('/questions/question/answers[@set="'.$qNumber.'"]/answer[@value="true"]');
                            foreach ($answers as $answer) {
                                $aString = $answer;
                                $aValidity = $answer[@value];
                                $newImportAnswers = new Answer();
                                $newImportAnswers->setAnswersAreForTheQuestionID($idOfTheLastQuestionForCourse);
                                $newImportAnswers->setAnswer1String($aString);
                                switch($aValidity){
                                    case 'true':
                                        $newImportAnswers->setIsAnswer1Valid(1);
                                        break;
                                    case 'false':
                                        $newImportAnswers->setIsAnswer1Valid(0);
                                        break;
                                }
                                /*!!!!!!!!!!!!!! This is where i add answers for the questions to database !!!!!!!!!!!!!! */
                                 $this->answer->addAnswersToDB($newImportAnswers);
                                //echo "<b>" . $aString . "</b> is it valid answer: " . $aValidity . "</br>";
                            }
                        }
                        $newAssignment->setArrayOfQuestionsIds($arrayOfQuestions);
                        $this->question->insertQuestionnaireAssignmentToDB($newAssignment);


                    } else {
                        echo "Upload files";
                    }


                    break;

                default:
                    // Default action
                    break;
                /*******************************************************************************************************/
            }


            $this->numberOfQuestionsForAssignment = 0;
            foreach ($_POST['assignmentQuestions'] as $questionId) {
                //echo $questionId . "<br/>";

                $this->numberOfQuestionsForAssignment++;
            }

            //echo "Total number of questions: " . $this->numberOfQuestionsForAssignment;


        } else {
            echo 'You have to supply data';
        }

        $this->returnTotalNumberOfColumnsFromAtableName('members');
    }

    public function returnTotalNumberOfColumnsFromAtableName($tableName)
    {
        $this->answer->returnTotalNumberOfColumns($tableName);

    }

    public function getAssignmentInformationByItsId($idOfAssignment)
    {
        return $this->assignment->getAssignmentInformationByItsId($idOfAssignment);
    }

    public function getAllQuestionsForParticularAssignmentId($idOfAssignment)
    {
        return $this->assignment->getAllQuestionsForGivenAssignmentId($idOfAssignment);
    }

    public function getAllIdsOfAnswersForGivenQuestionId($idOfQuestion)
    {
        return $this->assignment->returnAllIdsOfAnswersForGivenQuestionID($idOfQuestion);
    }
    public function getIdsOfAllCorrectAnswersForGivenQuestionID($questionID) {
        return $this->answer->getAllIdsOfCorrectAnswersForGivenQuestionId($questionID);
    }
    /*
     * Method removing question from database with a given id.
     */
    public function removeQuestionFromDatabaseWithGivenId($id)
    {
        $this->question->removeQuestionFromDB($id);
    }

    public function returnAllAsnwersForAParticularQuestionIde($questionId) {
        return $this->answer->getAllAnswersIdsByTheQuestionIdTheyAreAnswersFor($questionId);
    }
    public function retriveCorrectAnswerForGivenQuestionID($questionID) {
        return $this->answer->getCorrectAnswerForQuestionId($questionID);
    }

    public function getTheIdOfQuestionAnswerIdIsFor($idOfAnswer) {
        return $this->answer->findIdOfTheQuestionGivenAnswerIdIsFor($idOfAnswer);
    }

    public function getTheIdOfQuestionAnswerStringIsFor($answerString) {
        return $this->answer->findIdOfTheQuestionGivenAnswerStringIsFor($answerString);
    }

    public function checkIfGivenAnswerIdisValidForGivenQuestionId($answerId,$questionId) {
        return $this->answer->checkIfThEAnswerIdIsValidForGivenQuestion($answerId,$questionId);
    }

    public function insertUserAnswerIntoDatabase($answerObject) {
        $this->answer->insertUserAnswerForAssignmentInDB($answerObject);
    }
    public function updateUserAnswerProvidingRowId($rowId,$answerId,$valid) {
        $this->answer->updateUserAnswerTableProvidingIdofRow($rowId,$answerId,$valid);
    }
    public function returnAllIDsOfQuestionsFromUserAnswerTable($questionId, $assignmentId,$userID) {
        return $this->answer->returnTableWithIdsForGivenQuestionsIDfromUserAnswerTable($questionId,$assignmentId,$userID);
    }

    public function returnAllPossibleAnswersForGivenQuestionId($questionId) {
        return $this->question->returnAllIdsOfAllPossibleAnswersForGivenQuestionId($questionId);
    }
    
    public function updateCorrectAnswerId($id){
        $this->answer->updateAnswerRowInDBbyAddingIdOfCorrectAnswer($id);
    }

    public function editAssignmentInformation(){

        if (isset($_POST['assignmentid'])) {
            $assignmentid = mysql_real_escape_string($_POST['assignmentid']);
            $assignmentPublicity = mysql_real_escape_string($_POST['assignmentpublicity']);
            $assignmnetName = mysql_real_escape_string($_POST['assignmentname']);
            $this->assignment->editAssignmentDetails($assignmentid,$assignmnetName,$assignmentPublicity);
        }
    }

    public function getTotalNumberOfAssignments() {
        return $this->result->getTotalNumberOfAssignments();

    }

    public function getTotalNumberOfCorrectlyAnsweredQuestions() {
        return $this->result->getTotalNumberOfCorrectlyAnsweredQuestions();
    }

    public function getTotalNumberOfQuestions(){
        return $this->result->getTotalNumberOfQuestions();
    }

    public function getAllUserAnswersForGivenQuesitonId($questionId){
        return $this->result->getAllAnswersIdsForGivenQuestionId($questionId);
    }

    public function getAllUserAnswersForGivenQuesitonIdAndByUserId($questionId,$userId){
        return $this->result->getAllAnswersIdsForGivenQuestionIdAndUserId($questionId,$userId);
    }
    
    public function lookForcontentInAssignments($searchedFraze, $courseid) {

        return $this->assignment->searchForContentInDatabase($searchedFraze, $courseid)[1];
    }

    public function exportAssignmentAsXML($idOfAssignment) {
        /* getting assignment id*/
        $assignmentId = ((int)$idOfAssignment);
        /* getting total number of questions*/
        $totalquestions = $this->assignment->getAllQuestionsForGivenAssignmentId($assignmentId);
        /* creating xml header type and making browser download file*/
        header('Content-type: text/xml');
        //header('Content-disposition: attachment; filename="course.xml"');
        /*starting main xml tag and outputting all required tags*/
        echo "<questions>";
        $courseNumber =$this->assignment->getAssignmentInformationByItsId($assignmentId)->getForTheCourseNumber();
        echo "<topic>".$this->course->getCourseDataById($courseNumber)->getNameOfTheCourse()."</topic>";
        $answerSetNum = 0;
        $questionNumber = 0;
        foreach ($totalquestions as $k1) {
            $answerSetNum++;
            $questionNumber++;
            echo "<question number='".$questionNumber."'>";
            echo "<type>";
            switch ($this->question->getQuestionInformationByItsId($k1)->getTypeOfTheQuestion()) {
                case 1:
                    echo "Likert";
                    break;
                case 2:
                    echo "Multiple";
                    break;
                case 3:
                    echo "OneChoice";
                    break;
                case 4:
                    echo "TrueFalse";
                    break;
            }
            echo "</type>";
            echo "<title>" .$this->question->getQuestionInformationByItsId($k1)->getQuestionString() . "</title>";
            echo "<answers set='".$answerSetNum."'>";
            $answerNumber=0;
            $isanswerCorrect = 'false';
            foreach($this->question->returnAllIdsOfAllPossibleAnswersForGivenQuestionId($k1) as $k2) {
                $answerNumber++;
                if($this->answer->checkIfThEAnswerIdIsValidForGivenQuestion($k2,$k1)){$isanswerCorrect = 'true'; } else { $isanswerCorrect = 'false';}
                echo "<answer num='".$answerNumber."' value='".$isanswerCorrect."'>".$this->answer->getAnswerInformationByItsId($k2)->getAnswerString()."</answer>";
            }
            echo "</answers>";
            echo "</question>";
        }
        echo "</questions>";

    }



}
