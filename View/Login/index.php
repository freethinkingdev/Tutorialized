<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 00:34
 * File name: index.php
 */
include_once "RequireOnceFile.php";

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("Please login");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");

Form::startForm("post", "index.php?direction=logMeIn", "login_form", "Login");
Form::addFormInput("text", "user_login", "Login: ");
Form::addFormInput("password", "user_password", "Password: ");
Form::addResetButton();
Form::addSubmitButton("Login", "button_login");

Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
