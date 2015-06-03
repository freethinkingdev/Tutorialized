<?php
/**
 * User: Marcin
 * Date: 12/11/2012
 * Time: 18:54
 * File name: index.php
 */

Page::pointToAnotherPageAfterXseconds('2', 'index.php');
require_once("RequireOnceFile.php");
Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage('Register confirmation');
Page::addHTMLlink("index.php", "BACK TO HOME PAGE");
//include_once "View/Shared/commonMenuV.php";


Page::addMainBodyToThePage("<div class='registerConfirmationBox'>");
Page::addMainBodyToThePage("<div class='text_content'>");
Page::addMainBodyToThePage("<p>Thanks for registering</p>");

Page::addMainBodyToThePage("</div>");

Page::addMainBodyToThePage("</div>");


Page::addClearBothDiv();
Page::addFooterToThePage("");

