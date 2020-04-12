<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Commentaire
 *
 * @author sofia
 */
class Commentaire {
    private $ID;
    private $ArticleID;
    private $Auteur;
    private $Commentaire;
    private $Date;


    function __construct($ID, $ArticleID, $Auteur, $Commentaire, $Date) {
        $this->ID = $ID;
        $this->ArticleID = $ArticleID;
        $this->Auteur = $Auteur;
        $this->Commentaire = $Commentaire;
        $this->Date = $Date;
    }

    function getID() {
        return $this->ID;
    }

    function getArticleID() {
        return $this->ArticleID;
    }

    function getAuteur() {
        return $this->Auteur;
    }

    function getCommentaire() {
        return $this->Commentaire;
    }

    function getDate() {
        return $this->Date;
    }

    function setID($ID): void {
        $this->ID = $ID;
    }

    function setArticleID($ArticleID): void {
        $this->ArticleID = $ArticleID;
    }

    function setAuteur($Auteur): void {
        $this->Auteur = $Auteur;
    }

    function setCommentaire($Commentaire): void {
        $this->Commentaire = $Commentaire;
    }

    function setDate($Date): void {
        $this->Date = $Date;
    }



}
