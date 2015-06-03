<?php
/**
 * User: Marcin
 * Date: 24/03/2013
 * Time: 11:56
 * File name: help.php
 */

$path = $_SERVER['HTTP_REFERER'];

$helpPAge = '';
if (strpos($path, 'coursePage') !== false) {
    $helpPAge = 'coursePage';
} else if (strpos($path, 'courses') !== false) {
    $helpPAge = 'courses';
} else if (strpos($path, 'addNewAssignmentToTheCourse')) {
    $helpPAge = 'addNewAssignmentToTheCourse';
} else if (strpos($path, 'addQuestionForTheCourse')) {
    $helpPAge = 'addQuestionForTheCourse';
} else if (strpos($path, 'addContentToTheCourse')) {
    $helpPAge = 'addContentToTheCourse';
} else if (strpos($path, 'ShowAllUsers')) {
    $helpPAge = 'ShowAllUsers';
} else if (strpos($path, 'showAssignmentUserResults')) {
    $helpPAge = 'showAssignmentUserResults';
}

switch ($helpPAge) {
    case 'coursePage':
        showCoursePageHelp();
        break;

    case 'courses':
        showCoursesHelp();
        break;

    case 'addNewAssignmentToTheCourse':
        showNewAssignmentHelp();
        break;

    case 'addQuestionForTheCourse':
        showNewQuestionHelp();
        break;

    case 'addContentToTheCourse':
        showNewContentpHelp();
        break;

    case 'ShowAllUsers':
        showResgisteredUsersHelp();
        break;
    case 'showAssignmentUserResults':
        showUserResultsHelp();
        break;

    default:
        showGeneralHelp();
        break;

}
?>

<?php
function showCoursePageHelp()
{
    ?>
<h2>Course page section</h2>
<p>Nice! <br/>I see you are keen to learn something new. Great! Below you will find course content and assignments. If you
    are lucky,
    and have appropriate privileges, you will also see the list of questions. In addition, you will be able to add or
    remove either content or questions.</p>
    <br/>
    <br/>
        <strong>Important! If you can delete assignment from the list, please be advised that this could result
        in removing results for given assignment. If you would like to remove the assignment, make it private. You will still be able to access
        results for given assignment.</strong>
<?php
}

?>

<?php
function showCoursesHelp()
{
    ?>
<h2>Learn section</h2>
<p>Below, you will see the list of all available courses. You can click one, and browse content. You can also take an
    assignment.
    Whatever you do, you can always go back to home page simply by clicking home page link.</p>
<?php
}

?>

<?php
function showNewContentpHelp()
{
    ?>
<h2>Add new content help</h2>
    <p>There is not much to add, apart from...
    Pick the file you would like to by clicking browse or the input space provided. You will be prompt to pick a file to upload.
        And <em>voila!</em>
    </p>
<?php
}

?>

<?php
function showNewQuestionHelp()
{
    ?>
<h2>Add new question help</h2>
    <p>In order to create assignments, questions have to be added first. Variety of different question types can be added:
    <ul>
    <li>Multiple choice</li>
    <li>One choice only</li>
    <li>True / False</li>
    <li>Likert</li>
    Each of this type of question has its own limitations. Please, provide questions text first. Then, add possible answers.
    Please, tick the box under 'Is it valid answer?' to indicate that the provided answer is the correct one.
    </ul></p>
<?php
}

?>


<?php
function showNewAssignmentHelp()
{
    ?>
<h2>Add new assignment help</h2>
<p>Below you can add 3 different assignments.
    <ul>
    <li>Questionnaire</li>
    <li>Quiz</li>
    <li>Question</li>
    </ul>

    Each type of assignment has its own constraints. Remember to pick apropriate number of questions. If trying to add more, you will be notified.
<br/><br/><strong>Important! If you will not see questions for particular assignment, you have to add some questions, in the 'questions' section.</strong>
</p>
<?php
}

?>


<?php
function showGeneralHelp()
{
    ?>
<h2>This is general help section</h2>
<p>'Tutorialized' is a system, where you can add courses of your interest to the list. You can add variety of content to
    the
    courses. You can also create assignments to check users knowledge.</p>
<?php
}

?>

<?php
function showResgisteredUsersHelp()
{
    ?>
<h2>Registered users section</h2>
<p>You should be able to see the list of all registered users below.</p>
What informations you can see:
<ul>
    <li>Users login</li>
    <li>Users first name</li>
    <li>Users last name</li>
    <li>Users email address</li>
    <li>Users role</li>
</ul>
<p>Under options, you can click 'edit' link, which will take you to particular users settings. You can change there all
    above informations.
    You can also remove users from the database by clicking X link.</p>
<?php
}

?>


<?php
function showUserResultsHelp()
{
    ?>
<h2>User assignment results</h2>
    <p>On this screen you have access to the results of particular user. You can access textual data and
    when you scroll down, you will be able to see some charts.</p>
<?php
}

?>