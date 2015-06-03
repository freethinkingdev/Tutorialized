<?php

    session_start();
    require_once("RequireOnceFile.php");
    Page::addHtmlMetadataOfHtml("Css/css.css");
    Page::addHeaderToThePage('Learn');
    include_once "View/Shared/commonMenuV.php";
if (isUserLoggedIn()) {

    Page::addMainBodyToThePage("<div class='main_content'>");

    JqueryTabs::jQueryTabHeading();
    JqueryTabs::generateJqueryTab(array("adobeEdge" => "Adobe Edge", "jQuery" => "JQuery Tab"));
    Page::addMainBodyToThePage("<div id='adobeEdge'><p>hello</p></div>");
    Page::addMainBodyToThePage("<div id='jQuery'><p>this is jquery tab</p></div>");
    JqueryTabs::jQueryTabFooter();

    Page::addMainBodyToThePage("</div>");

}


Page::addClearBothDiv();
Page::addFooterToThePage("");

?>