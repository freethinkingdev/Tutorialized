<?php
/**
 * User: Marcin
 * Date: 16/10/2012
 * Time: 13:36
 * File name: Form.php
 */
class Form
{
    static public function startForm($method = "post", $action = "", $formName = "myForm", $formTitle = "")
    {
        echo "<form enctype='multipart/form-data' class='" . $formName . "' name='" . $formName . "' method='" . $method . "' action='" . $action . "'><fieldset><legend>{$formTitle}</legend>";
    }

    static public function addFormInput($inputType, $inputName, $labelForTheField = "", $class = "", $required = 'required')
    {
        echo "<label for='" . $inputName . "'>" . $labelForTheField . "</label>";
        echo "<input ".$required." title='Please, fill all information in.' type='" . $inputType . "' name='" . $inputName . "' class='" . $class . "'/>";
        echo "<br/>";
    }

    static public function addURL($inputName, $labelForTheField = "")
    {
        echo "<label for='" . $inputName . "'>" . $labelForTheField . "</label>";
        echo "<input placeholder='url of website' required title='Type in ULR like http://www.WEBSITE.XXX' type='url' name='" . $inputName . "' id='" . $inputName . "'/>";
        echo "<br/>";
    }

    static public function addDateInput($inputType, $inputName, $labelForTheField = "")
    {
        echo "<label for='" . $inputName . "'>" . $labelForTheField . "</label>";
        echo "<input  required title='Here is the place, where you can type in required information' type='" . $inputType . "' name='" . $inputName . "' id='" . $inputName . "'/>";
        echo "<br/>";
    }

    static public function addNumberInput($inputName, $labelForTheField = "", $minValue, $maxValue)
    {
        echo "<label for='" . $inputName . "'>" . $labelForTheField . "</label>";
        echo "<input required title='Here is the place, where you can type in numerical information' type='number' min='" . $minValue . "' max='" . $maxValue . "' name='" . $inputName . "' id='" . $inputName . "'/>";
        echo "<br/>";
    }

    static public function addSelectInput($labelName, $nameOfTheField, $arrayOfSelectItems, $isItMultipleselect = '')
    {
        echo "<label for='" . $nameOfTheField . "'>" . $labelName . "</label>";
        echo "<br/><select name='" . $nameOfTheField . "' ".$isItMultipleselect.">";
        foreach ($arrayOfSelectItems as $arg) {
            echo " <option value='" . lcfirst($arg) . "'>" . $arg . "</option>";
        }

        echo "</select><br/>";
    }

    static public function addSelectInputWithTwoForeachLoops($foreachFirsElement,$foreachResult,$selectVisibleText){
        echo "<select multiple>";
        foreach ($foreachFirsElement as $foreachResult) {
            echo "<option>".$selectVisibleText."</option>";
        }
        echo "</select>";
    }


    static public function addSubmitButton($valueForSbmittButton, $nameOfTheButton)
    {
        echo "<input required title='Click this button to continue' class='".$nameOfTheButton."' name='" . $nameOfTheButton . "' type='submit' value='" . $valueForSbmittButton . "'>";
        echo "</fieldset></form><br/>";
    }

    static public function addResetButton()
    {
        echo "<br/><input class='resetButton' title='Click here if you would like to clear the above form' type='reset'>";
    }

    static public function addTextArea($label_textarea)
    {
        echo "<label for='txtarea'>" . $label_textarea . "</label>";
        echo '<textarea title="Provide some additional information" required name="txtarea" rows="4" cols="20">';
        echo "</textarea>";
    }
    static public function addTextAreaWithAname($label_textarea, $nameForTextArea)
    {
        echo "<label name='".$nameForTextArea."' id='".$nameForTextArea."' for='txtarea'>" . $label_textarea . "</label><br/>";
        echo '<textarea title="Provide some additional information" required name="txtarea" rows="4" cols="20">';
        echo "</textarea>";
    }

    static public function addDate($inputName, $labelForTheField = "")
    {
        echo "<label for='" . $inputName . "'>" . $labelForTheField . "</label>";
        echo "<input required title='Here is the place, where you can type in numerical information' type='date' name='" . $inputName . "' id='" . $inputName . "'/>";
        echo "<br/>";
    }

    static public function addFileInputField($inputName, $labelForTheField,$maxFileSize) {
        echo "<input type='hidden' name='MAX_FILE_SIZE' value='".$maxFileSize."'>";
        echo "<label for='" . $inputName . "'>" . $labelForTheField . "</label>";
        echo "<input required title='Select file' type='file' name='" . $inputName . "' id='" . $inputName . "'/>";
        echo "<br/>";
    }

    static public function addCheckBoxInput($inputName, $labelForTheField = "", $valueForCheckBox)
    {
        echo "<label for='" . $inputName . "'>" . $labelForTheField . "</label>";
        echo "<input type='checkbox' name='".$inputName."' id='".$inputName."' value='".$valueForCheckBox."'/>";
        echo "<br/>";
    }

    static public function addHiddenFieldToTheForm($nameOfTheField, $valueOfTheField) {
        echo "<input type='hidden' value='".$valueOfTheField."' name='".$nameOfTheField."' />";
    }

}
