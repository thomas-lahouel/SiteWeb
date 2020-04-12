<?php


class Question
{
    private $ID;
    private $quest;

    /**
     * Question constructor.
     * @param $quest
     */
    public function __construct($ID, $quest)
    {
        $this->ID = $ID;
        $this->quest = $quest;
    }

    /**
     * @return mixed
     */
    public function getQuest()
    {
        return $this->quest;
    }

    /**
     * @param mixed $quest
     */
    public function setQuest($quest): void
    {
        $this->quest = $quest;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param mixed $ID
     */
    public function setID($ID): void
    {
        $this->ID = $ID;
    }
}