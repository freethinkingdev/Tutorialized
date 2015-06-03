<?php
/**
 * User: marcin
 * Date: 28/02/13
 * Time: 09:55
 * File name: ModelCourses.php
 */
include_once "Classes/CoursesDAO.php";
include_once "Classes/CourseContentDAO.php";

include_once "RequireOnceFile.php";

class ModelCourses
{

    private $course;
    private $courseContent;

    function __construct()
    {
        $this->course = new CoursesDAO();
        $this->courseContent = new CourseContentDAO();

    }

    function __destruct()
    {

    }

    public function getAllCoursesAllIds()
    {
        return $this->course->getAllIds();
    }

    public function getAllCourseContentIds()
    {
        return $this->courseContent->getAllIds();
    }

    public function getAllCourseContentIdsForGivenCourseId($idOfTheCourse)
    {
        return $this->courseContent->getAllIdsWhichHaveContentForParticularCourseId($idOfTheCourse);
    }

    public function getAllSearchedCourseContentIdsForGivenCourseIdAndSearchedFraze($idOfTheCourse,$searchedfraze)
    {
        return $this->courseContent->getAllIdsWhichHaveSearchedContentContentForParticularCourseId($idOfTheCourse,$searchedfraze);
    }

    public function returnAllCoursesTable($id)
    {
        $courses = array();
        $courses[] = "<a href='index.php?direction=coursePage&id=" . $this->course->getAllCourseById($id)->getIdOfTheCourse() . "' title='" . $this->course->getAllCourseById($id)->getDescriptionOfTheCourse() . "'>" . $this->course->getCourseDataById($id)->getNameOfTheCourse() . "</a>";
        if(!isUser()) {
            $courses[] = "<a href='index.php?direction=deleteCourse&id= " . $this->course->getCourseDataById($id)->getIdOfTheCourse() . "' title='Click here in order to delete course and all content related to the course'>X</a>";
        }

        return $courses;
    }

    public function returnAllCourseContentTable($id, $courseId)
    {

        $courseContent = array();
        $courseContent[] = "<a href='" . $this->courseContent->getCourseContentDataByIdAndCourseId($id, $courseId)->getFilePath() . "'>" . $this->courseContent->getCourseContentDataByIdAndCourseId($id, $courseId)->getNameOfTheContent() . "</a>";
        if(!isUser()) {
        $courseContent[] = "<a href='index.php?direction=deleteContentElement&id= " . $this->courseContent->getCourseContentDataByIdAndCourseId($id, $courseId)->getIfOfCourseContent() . "' title='Click here to remove this content'>X<a> | <a title='Click here in order to edit content' href=''>Edit </a>";
        }
        return $courseContent;
    }

    public function returnAllCourseContentTableWhenSearched($idOfTheCourse,$searchedFraze)
    {

        $courseContent = array();
        $courseContent[] = "<a href='" . $this->courseContent->getSearchedContent($idOfTheCourse,$searchedFraze)->getFilePath() . "'>" . $this->courseContent->getSearchedContent($idOfTheCourse,$searchedFraze)->getNameOfTheContent() . "</a>";
        if(!isUser()) {
            $courseContent[] = "<a href='index.php?direction=deleteContentElement&id= " . $this->courseContent->getSearchedContent($idOfTheCourse,$searchedFraze)->getIfOfCourseContent() . "' title='Click here to remove this content'>X<a> | <a title='Click here in order to edit content' href=''>Edit </a>";
        }
        return $courseContent;
    }

    public function returnCourseInfoById($id)
    {
        return $this->course->getAllCourseById($id);
    }

    public function addNewCourseToLibrary($courseName, $courseDescription)
    {
        if ($courseName != '' and $courseDescription != '') {
            $this->course->insertNewCourseToTheDB($courseName, $courseDescription);

            mkdir("CourseData/" . $courseName);

        } else {
            echo 'Cannot insert empty values';
        }

    }

    public function deleteCourseFromDatabase($id)
    {
        $nameOfTheCourse = $this->course->getCourseDataById($id)->getNameOfTheCourse();
        /*The glob() function searches for all the pathnames matching pattern according to the rules used by the libc glob() function, which is similar to the rules used by common shells. */
        $filesToRemove = glob("CourseData/" . $nameOfTheCourse . "/*");

        foreach ($filesToRemove as $fileToDelete) {
            if (is_file($fileToDelete)) {
                unlink($fileToDelete);
            }
        }
        rmdir("CourseData/" . $nameOfTheCourse);

        $this->course->deleteCourseFromDB($id);

    }

    /*
     * Method responsible for passing content data to CourseContentDAO to be placed inside db. File itself is copied to a location,
     * which has been created when new course has been created
     */
    public function addNewContentForTheCourse($file, $idOfTheCourse)
    {
        if ($_FILES['fileToUpload']['size'] > 0) {
            $fSize = $file['size'];
            $fType = $file['type'];
            $fName = $file['name'];
            $fTempName = $file['tmp_name'];

            if (move_uploaded_file($fTempName, './CourseData/' . $this->course->getAllCourseById($idOfTheCourse)->getNameOfTheCourse() . "/" . $fName)) {
                alert("You have uploaded your file");
            } else {
                alert("Something went wrong");
            }
            $filePathOnHardDrive = "CourseData/" . $this->course->getCourseDataById($idOfTheCourse)->getNameOfTheCourse() . "/" . $file['name'];

            $this->courseContent->insertFileContentToDB($fName, $filePathOnHardDrive, $idOfTheCourse);

        } else {

            switch ($file['error']) {
                case 1:
                    echo 'File is too big. Change php.ini config';
                    break;
                case 2:
                    echo 'MAX_FILE_SIZE do not allow to send bigger files';
                    break;
                case 3:
                    echo 'File has been uploaded only partially and most likely is corrupted';
                    break;
                case 4:
                    echo 'No file uploaded';
                    break;
            }
            echo '<br/>Sorry, you have to select a file in order upload it';
            goBackOneUrl();
        }
    }


    public function deleteCourseContentFromDiskAndDatabase($idOfContentToRemove)
    {
        //echo $idOfContentToRemove;
        unlink($this->courseContent->getCourseContentDataById($idOfContentToRemove)->getFilePath());
        $this->courseContent->removeContentFromDBbyId($idOfContentToRemove);
        returnToLastPage();
    }

    public function deleteAssignmentWithGivenId () {
      $idOfTheCourseToRemove = $_GET['id'];

      $this->course->removeAssignmentWithAGivenId($idOfTheCourseToRemove);

     }

    public function selectDistinctAssignmentsIdsWhereUserCorrectlyAnswered(){

    }
/*
    public function lookForcontentInAssignments($searchedFraze, $courseid) {

        return $this->courseContent->searchForContentInDatabase($searchedFraze, $courseid)[1];
    }*/



}
