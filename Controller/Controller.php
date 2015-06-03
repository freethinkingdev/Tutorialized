<?php

/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 11:49
 * File name: Controller.php
 */
include_once 'Model/ModelMainStarting.php';
include_once 'Model/ModelQuestionsAnswers.php';
include_once 'Model/ModelCourses.php';

class Controller
{

    private $model;
    private $courseModel;
    private $questionAnswerModel;


    function __construct()
    {
        $this->model = new ModelMainStarting();
        $this->courseModel = new ModelCourses();
        $this->questionAnswerModel = new ModelQuestionsAnswers();
    }

    function __destruct()
    {

    }

    public function defaultView()
    {
        include_once "./View/Home/index.php";
    }

    public function loginPage()
    {
        include_once "./View/Login/index.php";
    }

    /* Function which checks, whether user does exists and the provided password matches provided username. If it does, appropriate view is loaded, otherwise
      vies with try again is loaded. It is important to remember that the pass has to be treated with md5 function, which encode it */

    public function logMeIn()
    {
        if (isset($_POST['user_login']) and !empty($_POST['user_login']) and isset($_POST['user_password']) and !empty($_POST['user_password'])) {
            $login = $_POST['user_login'];
            $pass = md5($_POST['user_password']);
			$this->model->returnUserLogin($login,$pass);

            if ($this->model->returnUserLogin($login, $pass)) {
                /* This is where the session starts*/
                session_start();
                $_SESSION['id'] = $this->model->getId();
 				
                $_SESSION['role'] = $this->model->getRole();
                
                include_once "View/LoginSuccess/index.php";
            } else {
                include_once "View/LoginError/index.php";
            }
        } else {
            include_once "View/LoginError/index.php";
        }
    }

    /* Functions below show appropriate views in response to user interaction */

    public function helpMe()
    {
        include_once "./View/Help/index.php";
    }

    public function logout()
    {
        include_once "./View/Shared/logout.php";
    }

    public function register()
    {
        include_once "./View/Register/index.php";
    }

    public function registerMeForm()
    {
        if (
            isset($_POST['user_login']) and !empty($_POST['user_login'])
            and isset($_POST['user_name']) and !empty($_POST['user_name'])
            and isset($_POST['user_surname']) and !empty($_POST['user_surname'])
            and isset($_POST['user_email']) and !empty($_POST['user_email'])
            and isset($_POST['user_password']) and !empty($_POST['user_password'])
        ) {
            $login = $_POST['user_login'];
            $name = $_POST['user_name'];
            $surname = $_POST['user_surname'];
            $email = $_POST['user_email'];
            $pass = md5($_POST['user_password']);
            // Sending data to model to be checked
            $personalDetail = new PersonRegister($login, $name, $surname, $email, $pass);
            $this->model->confirmUserData($personalDetail);

        } else {
            // In the case user did not provided all required data. IE.
            echo 'Please, fill out all data';
            goBackOneUrl();
        }
        // fixme This has to be activated
        include_once("./View/RegisterConfirmation/index.php");
    }

    public function learnTests()
    {
        include_once("./View/LearnTests/index.php");

    }

    public function showAllUsers()
    {
        include_once("./View/ShowAllUsers/index.php");
    }


    public function itemToDelete()
    {
        $idToDelete = $_GET['id'];
        $this->model->deleteUserWithParticularID($idToDelete);
        $this->showAllUsers();
    }

    public function courses()
    {
        include_once("./View/Courses/ShowAllCourses/index.php");
    }

    public function addNewCourseToTheLibrary()
    {
        include_once("./View/Courses/AddNewCourse/index.php");
    }

    public function addNewCourseFromData()
    {

        $this->courseModel->addNewCourseToLibrary($_POST['courseName'], $_POST['txtarea']);
        $this->courses();
    }

    public function coursePage()
    {
        include_once("./View/Courses/CoursePage/index.php");
    }

    public function goToCoursePageByItsId($id)
    {
        echo "<meta http-equiv=\"refresh\" content=\"0.01; url=index.php?direction=coursePage&id=" . $id . "\">";
    }

    public function deleteCourse()
    {
        $this->courseModel->deleteCourseFromDatabase($_GET['id']);
        $this->courses();
    }

    public function addContentToTheCourse()
    {
        include_once("./View/Courses/AddnewContentForTheCourse/index.php");

    }

    public function addNewContentForm()
    {

        $id = $_GET['id'];
        $this->courseModel->addNewContentForTheCourse($_FILES['fileToUpload'], $id);
        $this->goToCoursePageByItsId($id);


    }

    public function deleteContentElement()
    {
        $idOfContentToRemove = $_GET['id'];
        $this->courseModel->deleteCourseContentFromDiskAndDatabase($idOfContentToRemove);
        goToAPage($_SERVER['HTTP_REFERER']);
    }

    public function addQuestionForTheCourse()
    {
        include_once("./View/Courses/AddNewQuestionToTheCourse/index.php");
    }

    public function addNewAssignmentToTheCourse()
    {
        include_once("./View/Courses/AddNewAssignmentForTheCourse/index.php");
    }

    public function addNewQuestionForTheCourse()
    {
        $this->questionAnswerModel->addNewQuestionForTheCourse();
        //fixme: uncomment that
        $this->courses();
    }

    /*Adding new assignment */
    public function addNewAssignmentFormData()
    {
        $this->questionAnswerModel->addNewAssignmentData();
        //$this->courses();
        //$this->goToCoursePageByItsId($_POST['forTheCourse']);
    }

    public function singleAssignmentPage()
    {
        include_once("./View/Courses/AssignmentPage/index.php");
    }

    public function userToEdit()
    {
        include_once("./View/Users/EditUserPage/index.php");
    }

    public function editExsistingUser()
    {
        $this->model->editExistingUser();
        $this->showAllUsers();
    }

    public function removeAssignmentWithGivenId($idOfAssignmentToRemove)
    {
        $this->courseModel->deleteAssignmentWithGivenId($idOfAssignmentToRemove);
        returnToLastPage();
    }

    public function removeQuestionFromTheSet()
    {
        $idOfTheQuestion = $_GET['id'];
        $this->questionAnswerModel->removeQuestionFromDatabaseWithGivenId($idOfTheQuestion);
        goToAPage($_SERVER['HTTP_REFERER']);
    }

    public function showAssignmentResults() {
        include_once("./View/Courses/AssignmentResults/index.php");
    }

    public function editAssignmentOptions(){
        include_once("./View/Courses/EditAssignmentOptions/index.php");
    }

    public function editAssignmentForm() {
        $this->questionAnswerModel->editAssignmentInformation();
        $this->courses();
    }

    public function showAssignmentUserResults() {
        include_once("./View/Users/UserAssignmentReults/index.php");
    }

    public function searchForContentInDatabase() {
        if (isset($_POST['searchcontent'])) {
            $courseid = $_POST['courseid'];
            $searchedFraze = $_POST['searchcontent'];
            //$this->courseModel->lookForcontentInAssignments($searchedFraze,$courseid);
            echo "<meta http-equiv=\"refresh\" content=\"0.01; url=index.php?direction=coursePage&id=" . $courseid . "&searchcontent=".$searchedFraze."\">";
            //include_once("./View/Courses/CoursePage/index.php?direction=coursePage&id=" . $courseid . "&searchcontent=".$searchedFraze."");
        }

        
    }

    public function exportCourseAsXML() {
        if(isset($_GET['id'])) {
            $idOfAssignment = $_GET['id'];
            //echo $idOfAssignment . " to jest assignemt";
            $this->questionAnswerModel->exportAssignmentAsXML($idOfAssignment);
        }
    }
}
