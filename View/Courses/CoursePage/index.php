<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Course Page');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {
    if(isset($_GET['id'])) {
    $idOfTheCourse = $_GET['id'];
    $course = new ModelCourses();
    $question = new ModelQuestionsAnswers();
    $assignment = new ModelQuestionsAnswers();
    echo "<h2>" . $course->returnCourseInfoById($idOfTheCourse)->getNameOfTheCourse() . "</h2>";

    /*
     * This is where jquery tab starts
     */
    JqueryTabs::jQueryTabHeading();
    if(!isUser()){
        JqueryTabs::generateJqueryTab(array("content" => "Content", "questions" => "Questions", "assignments"=> "Assignments"));
    } else {
        JqueryTabs::generateJqueryTab(array("content" => "Content", "assignments"=> "Assignments"));
    }
    //echo $idOfTheCourse;
     $courseDirectory = "CourseData/" . $course->returnCourseInfoById($idOfTheCourse)->getNameOfTheCourse() . "/";
    $dirElements = count(scandir($courseDirectory));
    /*
     * Empty folder would have exactly 2 elements. If at least 1 file in folder, it goes to 3
     */
    Page::addMainBodyToThePage("<div id='content'>");
    /*
     * CONTENT FOR THE COURSE
     */
        $search = false;
    if(isset($_GET['searchcontent'])){
        $search = true;
        $searchedFraze = $_GET['searchcontent'];
        echo "You are looking for: " .$searchedFraze ;
    } else {
    }
    Page::addMainBodyToThePage("<h5 class='searchCourseContent'>Search content</h5>");

    Page::addMainBodyToThePage("<form method='post' action='index.php?direction=searchForContentInDatabase' id='searchContentForm'>");
    Page::addMainBodyToThePage("<input type='hidden' name='courseid' value='".$idOfTheCourse."'/>");
    Page::addMainBodyToThePage("<label for='searchcontent'>Search content:</label>");
    Page::addMainBodyToThePage("<input type='text' id='searchcontent' name='searchcontent' />");
    Page::addMainBodyToThePage("<input type='submit' value='SEARCH' class='button_login' />");
    Page::addMainBodyToThePage("</form>");

    $courseContentTable = new Table();
    if(!isUser()){
        $courseContentTable->addTableHeader(array("Name", "Options"), 'allCoursesTable', 'Course content');
    } else {
        $courseContentTable->addTableHeader(array("Name"), 'allCoursesTable', 'Course content');
    }


        if ($search) {
            //$course->returnAllCourseContentTableWhenSearched($idOfTheCourse, $searchedFraze);
            foreach ($course->getAllSearchedCourseContentIdsForGivenCourseIdAndSearchedFraze($idOfTheCourse,$searchedFraze) as $id) {
                //echo $id;
                $courseContentTable->addRowData($course->returnAllCourseContentTable($id, $idOfTheCourse));
            }
        } else {
            foreach ($course->getAllCourseContentIdsForGivenCourseId($idOfTheCourse) as $id) {
                $courseContentTable->addRowData($course->returnAllCourseContentTable($id, $idOfTheCourse));
            }
        }

    $courseContentTable->closeTable();

    if (!isUser()) {
        echo "<p><a href='index.php?direction=addContentToTheCourse&id=" . $idOfTheCourse . "'>Add content to the course</a></br>";

    }
    Page::addMainBodyToThePage("</div>");
    Page::addMainBodyToThePage("<div id='questions'>");
    /*
     * QUESTIONS FOR GIVEN COURSE
     */
    if (!isUser()) {

        $questions = new Table();
        $questions->addTableHeader(array('Id','Question','Type', 'Option '), 'allCoursesTable', 'Course questions');
        foreach ($question->getAllIdsOfQuestionsForParticularCourseId($idOfTheCourse) as $id) {
            //echo $id;
            $questions->addRowData($question->returnTableWithAllQuestions($id));
        }
        $questions->closeTable();

        echo "<a href='index.php?direction=addQuestionForTheCourse&id=" . $idOfTheCourse . "'>Add question for the course</a></p>";
    }
    Page::addMainBodyToThePage("</div>");
    Page::addMainBodyToThePage("<div id='assignments'>");
    /*
    * ASSIGNMENTS TABLE
    */

    $assignmentTable = new Table();


    if (!isUser()) {
        /* If a logged in person is admin or author   */
        $assignmentTable->addTableHeader(array("Assignment name","Type","Public","Edit" ,"Options"), 'allCoursesTable', 'Assignment for that course');
    } else {
        /* If a logged in person is normal user   */
        $assignmentTable->addTableHeader(array("Assignment name","Type"), 'allCoursesTable', 'Assignment for that course');
    }

    foreach ($assignment->getAllIdsOfAssignmentsForAparticularCourseId($idOfTheCourse) as $id) {
        /*
         * This is where the content is actually returned
         */
        $assignmentTable->addRowData($assignment->returnTableWithAllQuestionAssignments($id));
    }
    $assignmentTable->closeTable();

    //Adding new assignment
    if (!isUser()) {
        echo "<a href='index.php?direction=addNewAssignmentToTheCourse&id=" . $idOfTheCourse . "'>Add assignment for the course</a></p>";
    }


    Page::addMainBodyToThePage("</div>");
    }
    JqueryTabs::jQueryTabFooter();
    echo "<p><a href='index.php?direction=courses'>Back to course list</a></p>";
} else /*If user is not logged in*/ {

}
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
