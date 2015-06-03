<?php
/**
 * User: Marcin
 * Date: 14/11/2012
 * Time: 11:45
 * File name: index.php
 */

include_once "Controller/Controller.php";

$newController = new Controller();


if (isset($_GET['direction']) and !empty($_GET['direction'])) {
    $newController->{$_GET['direction']}();


} else {
    $newController->defaultView();
}



