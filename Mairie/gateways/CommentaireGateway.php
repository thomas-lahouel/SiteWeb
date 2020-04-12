<?php



class CommentaireGateway {

    private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function SelectionnerTousLesCommentaires($ArticleID) {
        $query='SELECT * from commentaire where ArticleID='.$ArticleID;
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        if(empty($result)){
            return NULL;
        }

        foreach ($result as $row){
            $Commentaire[]=new Commentaire($row['ID'],$row['ArticleID'],$row['Auteur'],$row['Commentaire'],$row['Date']);
        }
        return $Commentaire;
    }


    public function AjouterUnCommentaire($pseudo,$commentaire,$articleID){
        $query="INSERT INTO commentaire VALUES (NULL,:ArticleID,:Auteur,:Commentaire,NOW())";
        $this->con->executeQuery($query, array(':ArticleID'=> array($articleID,PDO::PARAM_INT),
            ':Auteur'=> array($pseudo,PDO::PARAM_STR),
            ':Commentaire'=> array($commentaire,PDO::PARAM_STR)));
        return $this->con->lastInsertId();
    }


    public function TrouverNombreDeMessages(){
        $query='SELECT count(*) as nbr from commentaire';
        $result = $this->con->prepare($query);
        $result->execute();

        $nbr = $result->fetchColumn();
        return $nbr;





    }









}
