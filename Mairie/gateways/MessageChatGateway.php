<?php


class MessageChatGateway
{
    private $con;
    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function SelectionnerTousLesMessages() {
        $query='SELECT * from messagechat';
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        if(empty($result)){
            return NULL;
        }

        foreach ($result as $row){
            $MessageChat[]=new MessageChat($row['ID'],$row['Auteur'],$row['Message'],$row['Date']);
        }
        return $MessageChat;
    }


    public function AjouterUnMessage($pseudo,$message){
        $query="INSERT INTO messagechat VALUES (NULL,:Auteur,:Message,NOW())";
        $this->con->executeQuery($query, array(':Auteur'=> array($pseudo,PDO::PARAM_STR),
            ':Message'=> array($message,PDO::PARAM_STR)));
    }

}