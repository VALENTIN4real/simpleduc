<?php
class Message{    
    private $db;
    private $getMessages;
    private $send;

    public function __construct($db){        
        $this->db = $db;
        $this->getMessages = $db->prepare("SELECT * FROM Message WHERE destinataire=:destinataire");
        $this->send = $db->prepare("INSERT INTO Message(expediteur,destinataire,objet,contenu,dateEnvoi) VALUES(:expediteur,:destinataire,:objet,:contenu,:dateEnvoi)");
    }

    public function send($expediteur,$destinataire,$objet,$contenu,$dateEnvoi){ // Étape 3         
        $r = true;        
        $this->send->execute(array(':expediteur'=>$expediteur,':destinataire'=>$destinataire,':objet'=>$objet,':contenu'=>$contenu,':dateEnvoi'=>$dateEnvoi));        
        if ($this->send->errorCode()!=0){
            print_r($this->send->errorInfo());               
            $r=false;        
        }        
        return $r; 
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