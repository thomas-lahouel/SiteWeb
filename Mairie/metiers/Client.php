<?php


class Client {

    private $ID;
    private $Nom;
    private $Prenom;
    private $Sexe;
    private $NumeroTel;
    private $Email;
    private $Motdepasse;
    private $Question;
    private $Reponse;

    /**
     * Client constructor.
     * @param $ID
     * @param $Nom
     * @param $Prenom
     * @param $Sexe
     * @param $NumeroTel
     * @param $Email
     * @param $Motdepasse
     * @param $Question
     * @param $Reponse
     */
    public function __construct($ID, $Nom, $Prenom, $Sexe, $NumeroTel, $Email, $Motdepasse, $Question, $Reponse)
    {
        $this->ID = $ID;
        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
        $this->Sexe = $Sexe;
        $this->NumeroTel = $NumeroTel;
        $this->Email = $Email;
        $this->Motdepasse = $Motdepasse;
        $this->Question = $Question;
        $this->Reponse = $Reponse;
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
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * @param mixed $Nom
     */
    public function setNom($Nom): void
    {
        $this->Nom = $Nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * @param mixed $Prenom
     */
    public function setPrenom($Prenom): void
    {
        $this->Prenom = $Prenom;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->Sexe;
    }

    /**
     * @param mixed $Sexe
     */
    public function setSexe($Sexe): void
    {
        $this->Sexe = $Sexe;
    }

    /**
     * @return mixed
     */
    public function getNumeroTel()
    {
        return $this->NumeroTel;
    }

    /**
     * @param mixed $NumeroTel
     */
    public function setNumeroTel($NumeroTel): void
    {
        $this->NumeroTel = $NumeroTel;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @return mixed
     */
    public function getMotdepasse()
    {
        return $this->Motdepasse;
    }

    /**
     * @param mixed $Motdepasse
     */
    public function setMotdepasse($Motdepasse): void
    {
        $this->Motdepasse = $Motdepasse;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->Question;
    }

    /**
     * @param mixed $Question
     */
    public function setQuestion($Question): void
    {
        $this->Question = $Question;
    }

    /**
     * @return mixed
     */
    public function getReponse()
    {
        return $this->Reponse;
    }

    /**
     * @param mixed $Reponse
     */
    public function setReponse($Reponse): void
    {
        $this->Reponse = $Reponse;
    }




}
