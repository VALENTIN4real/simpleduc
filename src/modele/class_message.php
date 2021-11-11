<?php
class Message{    
    private $db;
    private $getMessages;

    public function __construct($db){        
        $this->db = $db;
        $this->getMessages = $db->prepare("SELECT * FROM Message WHERE destinataire=:destinataire");
    }

    public function getMessages($destinataire){        
        $this->getMessages->execute(array(':destinataire'=>$destinataire));        
        if ($this->getMessages->errorCode()!=0){             
            print_r($this->getMessages->errorInfo());          
        }        
        return $this->getMessages->fetchAll();    
    }
}

?>