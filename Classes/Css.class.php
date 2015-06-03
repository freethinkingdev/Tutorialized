<?php
/**
 * User: Marcin
 * Date: 16/10/2012
 * Time: 15:04
 * File name: Css.php
 */
class Css
{
static public function addExternalCssToTheFile($cssToAdd) {
 echo "<!doctype html><head><meta charset='utf-8'>
 <link rel='stylesheet' type='text/css' href='".$cssToAdd."' />

 <script src='JavaScript/jquery-1.8.3.js'></script>
 <script src='JavaScript/jquery-1.8.2.js'></script>
 <script src='JavaScript/jquery-ui.js'></script>
 <script src='JavaScript/jquery.multipage.js'></script>
 <script src='JavaScript/jquery.numeric.js'></script>
 <script src='JavaScript/jquery.validate.js'></script>

 <link rel='stylesheet' type='text/css' href='Css/jquery.multipage.css'/>
 <link rel='stylesheet' type='text/css' href='Css/jquery-ui-1.9.1.custom.min.css'/>
 <link rel='stylesheet' type='text/css' href='Css/jquery-ui.css'/>



 "
 ;




}
}
