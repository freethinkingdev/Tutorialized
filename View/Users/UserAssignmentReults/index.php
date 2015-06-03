<?php
session_start();
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Assignment Results');
include_once "View/Shared/commonMenuV.php";

Page::addMainBodyToThePage("<div class='main_content'>");
Page::addMainBodyToThePage("<div class='text_content'>");
if (isUserLoggedIn()) {

    $assignments = new ModelMainStarting();
    $qa = new ModelQuestionsAnswers();
    $result = new ModelUserResults();
    $course = new ModelCourses();

    $usersIds = $assignments->getAllIds();
    $totalNumberOfAssignments = count($qa->getTotalNumberOfAssignments());
    $totalNumberOfCorrectlyAnsweredQuestions = count($qa->getTotalNumberOfCorrectlyAnsweredQuestions());
    $totalQuestions = count($qa->getTotalNumberOfQuestions());
    Page::addMainBodyToThePage("<h2>Assignment results</h2>");
    Page::addMainBodyToThePage("<h3><span class='searchUserHeading'>Search results by user</span></h3>");
    Page::addMainBodyToThePage("<h3><span class='searchAssignmentHeading'>Search results by assignment</span></h3>");

    echo "<form method='post' action='' id='userresults'>";
    echo "<legend>Registered users:</legend>";
    echo "<label for='username'>Pick a user</label>";
    echo "<select name='username'>";
    $uGoodAnswers = 0;
    $uBadAnswers = 0;
    foreach ($usersIds as $id) {
        echo "<option value='".$id."'>".$assignments->showUserFirstName($id). " " .$assignments->showUserLastName($id)."</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Search'/></form><br/>";

    echo "<form method='post' action='' id='assignmentsearch'>";
    echo "<legend>Pick assignment:</legend>";
    echo "<label for='username'>Pick a user</label>";
    echo "<select name='username'>";
    $uGoodAnswers = 0;
    $uBadAnswers = 0;
    foreach ($usersIds as $id) {
        echo "<option value='".$id."'>".$assignments->showUserFirstName($id). " " .$assignments->showUserLastName($id)."</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Search'/></form><br/>";



    if (isset($_POST['username'])) {
        //Page has received  the id of the user, and therefore can perform search for particular user id results

        $userId = $_POST['username'];
        $userFirstName = $assignments->showUserFirstName($userId);
        $userLastName = $assignments->showUserLastName($userId);
        $arrayOfAllAnswerIdsForGivenUserId = $result->getAllAnswerIdsForAGivenUserId($userId);
        Page::addMainBodyToThePage("<h2 class='textCenter'>You are browsing " . $userFirstName . " " . $userLastName . " results.</h2>");

        $arrayOfQuestions = array();
        $arrayOfAssignmentsIds = array();
        foreach ($arrayOfAllAnswerIdsForGivenUserId as $v1) {
            $idofanswer = (int)$result->retriveUserAnswerInformationByResultRowId($v1)->getValidAnswerId();
            $idOfQuestion = $result->retriveUserAnswerInformationByResultRowId($v1)->getIdOfQuestion();
            $idOfUserAnswer = $result->retriveUserAnswerInformationByResultRowId($v1)->getUserAnswerId();
            $arrayOfQuestions[$idOfQuestion] = $qa->getQuestionInformationByQuestionId($idOfQuestion)->getQuestionString();
            $arrayOfAssignmentsIds[] = $result->retriveUserAnswerInformationByResultRowId($v1)->getIdOfAssignment();
        }
        $uGoodAnswers = 0;
        $uBadAnswers = 0;
        //Checking if there are any questions, meaning there are results
        if (empty($arrayOfQuestions)) {
            Page::addMainBodyToThePage("<h3>There are no results for that user. Choose another user please.</h3>");
        } else {
                Page::addMainBodyToThePage("<h2>User took following assignmnents</h2>");
            Page::addMainBodyToThePage("<ul>");
            foreach (array_unique($arrayOfAssignmentsIds) as $k3) {
                Page::addMainBodyToThePage("<li>".$qa->getAssignmentInformationByItsId($k3)->getNameOfTheAssignment()."</li>");
                br();
            }
            Page::addMainBodyToThePage("</ul>");

            foreach ($arrayOfQuestions as $k1=>$v1) {
                Page::addMainBodyToThePage("<h3><span class='resultsquestions'>".$qa->getQuestionInformationByQuestionId($k1)->getQuestionString()."</span></h3><div>");
                Page::addMainBodyToThePage("<div>");
                foreach ($qa->getIdsOfAllCorrectAnswersForGivenQuestionID($k1) as $id) {
                    Page::addMainBodyToThePage("<p class='correctAnswer'>Correct answer: ". $qa->getAnswerInformationByItsId($id)->getAnswerString()."</p>");
                }
                foreach ($qa->getAllUserAnswersForGivenQuesitonIdAndByUserId($k1,$userId) as $k2) {
                    if ($qa->checkIfGivenAnswerIdisValidForGivenQuestionId($k2,$k1)) {
                        $uGoodAnswers++;
                        Page::addMainBodyToThePage("<p class='correctUserAnswer textIndent3pro'>User answered: ". $qa->getAnswerInformationByItsId($k2)->getAnswerString()."</p>");
                    } else {
                        $uBadAnswers++;
                        Page::addMainBodyToThePage("<p class='wrongAnswer textIndent3pro'>User answered: ". $qa->getAnswerInformationByItsId($k2)->getAnswerString()."</p>");
                    }
                }
                Page::addMainBodyToThePage("</div>");
            }
            Page::addMainBodyToThePage("<div id='czart'></div>");
        }

    } else {
        //There is no form received therefore a general stuff is shown

            hr();
            Page::addMainBodyToThePage("<h3>General statistics</h3>");
            Page::addMainBodyToThePage("Total number of assignments: " . $totalNumberOfAssignments);
            br();
            Page::addMainBodyToThePage("Total questions: ".$totalQuestions);
            br();
            Page::addMainBodyToThePage("Total number of correctly answered questions: ".$totalNumberOfCorrectlyAnsweredQuestions);

    }

} else {
    // User is not logged in
    Page::addMainBodyToThePage("You have to log in in order to view this content");

}
$chartOptions = "{'title':'Overall ratio of good and bad answers',
                   'width':500,'height':300,
                   'legend':'left',
                   'chartArea.width':500
                   }";
$chartAddRows = "[['Good answers', {$uGoodAnswers}],['Bad answers', {$uBadAnswers}]]";

Page::addMainBodyToThePage("<script src='https://www.google.com/jsapi'></script>");
Page::addMainBodyToThePage("<script>

// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Answers');
    data.addColumn('number', 'Number');
    data.addRows(");
echo $chartAddRows;
Page::addMainBodyToThePage(");

    //Set chart options
    var options = ");
    echo $chartOptions;
Page::addMainBodyToThePage(";

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('czart'));
    chart.draw(data, options);
}

$(document).ready (function(){
$('#userresults').slideUp('slow');
$('#assignmentsearch').slideUp('slow');


    $('.searchUserHeading').hover(function(){
        $(this).css('cursor','pointer');
    }).click(function(){
        $('#userresults').slideToggle();
    });

    $('.searchAssignmentHeading').hover(function(){
        $(this).css('cursor','pointer');
    }).click(function(){
        $('#assignmentsearch').slideToggle();
    });

});

</script>");
Page::addMainBodyToThePage("</div>");
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
