<?php
/**
 * User: marcin
 * Date: 28/02/13
 * Time: 08:55
 * File name: JqueryTabs.php
 */
class JqueryTabs
{
    static public function jQueryTabHeading($idOfMainElement = 'tabs')
    {
        echo "<br/><div id='".$idOfMainElement."'>";
    }

    static public function generateJqueryTab($arrayOfTabHeaders) {
        echo "<ul>";
        foreach ($arrayOfTabHeaders as $arrElement => $arrHrefText) {
            echo "<li><a href='#".$arrElement."'>".$arrHrefText."</a></li>";
        }
        echo "</ul>";

    }

    static public function jQueryTabFooter()
    {
        echo "</div><br/>";
    }

}
