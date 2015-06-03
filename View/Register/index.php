<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 00:34
 * File name: index.php
 */
include_once "RequireOnceFile.php";

Page::addHtmlMetadataOfHtml("Css/css.css");
Page::addHeaderToThePage("Please register");
include_once "View/Shared/commonMenuV.php";
Page::addMainBodyToThePage("<div class='main_content'>");

Form::startForm("post", "index.php?direction=registerMeForm", "register_form", "Register");
Form::addFormInput("text", "user_login", "Username: ");
Form::addFormInput("text", "user_name", "Name: ");
Form::addFormInput("text", "user_surname", "Surname: ");
Form::addFormInput("password", "user_password", "Password: ");
Form::addFormInput("text", "user_email", "Email: ");
Form::addResetButton();
Form::addSubmitButton("Register", "button_login");
Page::addMainBodyToThePage("</div>");
Page::addClearBothDiv();
Page::addFooterToThePage("");
