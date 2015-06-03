<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Marcin
 * Date: 15/10/2012
 * Time: 20:09
 * To change this template use File | Settings | File Templates.
 */
class Table
{

 public function addTableHeader($arrayOfElementsToAdd, $nameOfTheTableClass = "", $tableLargeHeaderText)
 {
     echo "<p class='anyTableLabel'>".$tableLargeHeaderText."</p>";
  echo "<table id='$nameOfTheTableClass' class='".$nameOfTheTableClass."'><tr>";
  foreach ($arrayOfElementsToAdd as $argument) {
   echo "<th>" . $argument . "</th>";
  }
  echo "</tr>";
 }

 public function addRowData($arrayOfElementsToAdd)
 {
  echo "<tr>";
  foreach ($arrayOfElementsToAdd as $argument) {
   echo "<td>" . $argument . "</td>";
  }
  echo "</tr>";
 }

 public function closeTable()
 {
  echo "</table><br/>";
 }

}
