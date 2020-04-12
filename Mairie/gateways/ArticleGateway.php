<?php


class ArticleGateway
{


    private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function AjouterArticle(string $titre,string $contenu){

        $query="INSERT INTO article VALUES (NULL,:Titre,:Contenu,NOW())";


        $this->con->executeQuery($query, array(':Titre'=> array($titre,PDO::PARAM_STR),
            ':Contenu'=> array($contenu,PDO::PARAM_STR)));


        return $this->con->lastInsertId();
    }



    public function FindByID($id) : Array{
        $query='SELECT * from article where ID='.$id;

        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        foreach ($result as $row) {
            $Article[]=new Article($row['ID'],$row['Titre'],$row['Contenu'],$row['Date']);

        }
        return $Article;
    }

    public function FindAll($depart,$articlesParPage) : Array {
        $query='SELECT * from article LIMIT '.$depart.','.$articlesParPage;

        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Article=[];



        foreach ($result as $row){
            $Article[]=new Article($row['ID'],$row['Titre'],$row['Contenu'],$row['Date']);
        }
        return $Article;
    }

    public function ArticlesTotals() : int {
        $query='SELECT count(*) from article';
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Nbr=[];

        foreach($result as $row){
            $Nbr=$row["count(*)"];
        }
        return $Nbr;


    }

    public function RechercherArticlesParDate($date) : Array {
        $date=$date->format('Y-m-d');
        $query="SELECT * from article where DATE='$date'";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        $Article=[];


        foreach ($result as $row){
            $Article[]=new Article($row['ID'],$row['Titre'],$row['Contenu'],$row['Date']);
        }
        return $Article;
    }


    public function SupprimerArticle($ID){
        $query='DELETE from article where ID='.$ID;
        $this->con->executeQuery($query);


    }

}

?>


