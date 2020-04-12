<?php


class QuestionsGateway
{
    private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function selectAllQuestions(){
        $query='SELECT * FROM question';
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        foreach ($result as $row){
            $tabDeQuestions[]= new Question($row['ID'], $row['choix']);
        }
        return $tabDeQuestions;
    }
}