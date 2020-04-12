<?php


class MessageChat
{
    private $ID;
    private $Auteur;
    private $Message;
    private $Date;

    /**
     * MessageChat constructor.
     * @param $ID
     * @param $Auteur
     * @param $Message
     * @param $Date
     */
    public function __construct($ID, $Auteur, $Message, $Date)
    {
        $this->ID = $ID;
        $this->Auteur = $Auteur;
        $this->Message = $Message;
        $this->Date = $Date;
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

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->Auteur;
    }

    /**
     * @param mixed $Auteur
     */
    public function setAuteur($Auteur): void
    {
        $this->Auteur = $Auteur;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->Message;
    }

    /**
     * @param mixed $Message
     */
    public function setMessage($Message): void
    {
        $this->Message = $Message;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->Date;
    }

    /**
     * @param mixed $Date
     */
    public function setDate($Date): void
    {
        $this->Date = $Date;
    }




}