<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 12:44
 * File name: index.php
 */
session_start();
require_once("RequireOnceFile.php");

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("This is the help page. Make use of it... :D");
include_once "View/Shared/commonMenuV.php";



Page::addMainBodyToThePage("<div class='main_content'>");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("
Help

");
goBackOneUrl();
Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");
