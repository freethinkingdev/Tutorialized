//<![CDATA[
$(document).ready(function() {
    jQuery("#tabs").tabs();
    $("form").validate();
    $('#searchContentForm').slideUp();
    $('.searchCourseContent').hover(function(){
        $(this).css({'cursor':'pointer'});
    }).click(function(){
            $('#searchContentForm').slideToggle();
        });


    /*Adding a datepicker to date input field. By adding date picker, i present some validation with javascript*/
    $("input[name='date_and_month']").datepicker({ dateFormat:'yy-mm-dd' });
    $("input[name='date_accessed']").datepicker({ dateFormat:'yy-mm-dd' });
    $("input[name='closingDate']").datepicker({ dateFormat:'yy-mm-dd' });


    /*This is javascript picker staff. When the user types in letter, a hint is being shown */
    var letters = ["A", "B", "C", "D", "E", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $("input[name='initial_of_author']").autocomplete({
        source:letters
    });


    $("table[id='table']").click(function () {

    });

    $('.addNewAssignmentFormQuestionnaire').on("click", "option", function (event) {
        if (4 <= $(this).siblings(":selected").length) {
            $(this).removeAttr("selected");
            alert("You can select only 4 options. Deselect one option so you could chose another one.");
        }
    });

    $('.addNewAssignmentFormQuiz').on("click", "option", function (event) {
        if (3 <= $(this).siblings(":selected").length) {
            $(this).removeAttr("selected");
            alert("You can select only 3 options. Deselect one option so you could chose another one.");
        }
    });

    $('#showhelp').click(function() {
        $('.helpDiv').css('overflow-y','scroll', 'overflow-x', 'none').slideToggle();
        $('.helpDiv').load('View/Shared/help.php');
    });

    $('#assignmentForm').multipage();







});


//]]