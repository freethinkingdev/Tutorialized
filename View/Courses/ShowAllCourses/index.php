<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Learn');
include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {
    $newCourse = new ModelCourses();
    $coursesTable = new Table();
    if(!isUser()) {
        $coursesTable->addTableHeader(array("Course name", "Options"), "allCoursesTable", "All courses");
    } else {
        $coursesTable->addTableHeader(array("Course name"), "allCoursesTable", "All courses");
    }


    foreach ($newCourse->getAllCoursesAllIds() as $id) {

            $coursesTable->addRowData($newCourse->returnAllCoursesTable($id));
     }
    $coursesTable->closeTable();

    if(!isUser()) {
        echo "<a href='index.php?direction=addNewCourseToTheLibrary' title='Add new course'>Add new course to library</a>";
    }


} else {
    echo "nada";
}

Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");
