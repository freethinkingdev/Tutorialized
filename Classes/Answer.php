<?php
/**
 * User: marcin
 * Date: 02/03/13
 * Time: 14:24
 * File name: Answer.php
 */
class Answer
{
    private $answer1String;
    private $answer2String;
    private $answer3String;
    private $answer4String;
    private $answer5String;
    private $answer6String;
    private $isAnswer1Valid = 0;
    private $isAnswer2Valid= 0;
    private $isAnswer3Valid= 0;
    private $isAnswer4Valid= 0;
    private $isAnswer5Valid= 0;
    private $isAnswer6Valid= 0;
    private $answersAreForTheQuestionID;

    public function setIsAnswer4Valid($isAnswer4Valid)
    {
        $this->isAnswer4Valid = $isAnswer4Valid;
    }

    public function getIsAnswer4Valid()
    {
        return $this->isAnswer4Valid;
    }

    public function setIsAnswer5Valid($isAnswer5Valid)
    {
        $this->isAnswer5Valid = $isAnswer5Valid;
    }

    public function getIsAnswer5Valid()
    {
        return $this->isAnswer5Valid;
    }

    public function setIsAnswer6Valid($isAnswer6Valid)
    {
        $this->isAnswer6Valid = $isAnswer6Valid;
    }

    public function getIsAnswer6Valid()
    {
        return $this->isAnswer6Valid;
    }

    public function setAnswer4String($answer4String)
    {
        $this->answer4String = $answer4String;
    }

    public function getAnswer4String()
    {
        return $this->answer4String;
    }

    public function setAnswer5String($answer5String)
    {
        $this->answer5String = $answer5String;
    }

    public function getAnswer5String()
    {
        return $this->answer5String;
    }

    public function setAnswer6String($answer6String)
    {
        $this->answer6String = $answer6String;
    }

    public function getAnswer6String()
    {
        return $this->answer6String;
    }

    public function setAnswer1String($answer1String)
    {
        $this->answer1String = $answer1String;
    }

    public function getAnswer1String()
    {
        return $this->answer1String;
    }

    public function setAnswer2String($answer2String)
    {
        $this->answer2String = $answer2String;
    }

    public function getAnswer2String()
    {
        return $this->answer2String;
    }

    public function setAnswer3String($answer3String)
    {
        $this->answer3String = $answer3String;
    }

    public function getAnswer3String()
    {
        return $this->answer3String;
    }

    public function setAnswersAreForTheQuestionID($answersAreForTheQuestionID)
    {
        $this->answersAreForTheQuestionID = $answersAreForTheQuestionID;
    }

    public function getAnswersAreForTheQuestionID()
    {
        return $this->answersAreForTheQuestionID;
    }

    public function setIsAnswer1Valid($isAnswer1Valid)
    {
        $this->isAnswer1Valid = $isAnswer1Valid;
    }

    public function getIsAnswer1Valid()
    {
        return $this->isAnswer1Valid;
    }

    public function setIsAnswer2Valid($isAnswer2Valid)
    {
        $this->isAnswer2Valid = $isAnswer2Valid;
    }

    public function getIsAnswer2Valid()
    {
        return $this->isAnswer2Valid;
    }

    public function setIsAnswer3Valid($isAnswer3Valid)
    {
        $this->isAnswer3Valid = $isAnswer3Valid;
    }

    public function getIsAnswer3Valid()
    {
        return $this->isAnswer3Valid;
    }




}
