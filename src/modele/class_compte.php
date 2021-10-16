<?php
class Compte{    
    private $db;
    private $insert; 
    private $connect;
    private $select;
    private $getbyID;
    private $delete;

    public function __construct($db){        
        $this->db = $db;    
        $this->insert = $this->db->prepare("insert  into  Compte(email,mdp)values (:email,:mdp)");
        $this->select = $db->prepare("SELECT * FROM Compte");
        $this->getbyID = $db->prepare("SELECT id FROM Compte WHERE email=:email");
        $this->delete = $db->prepare("DELETE FROM Compte WHERE id=:id");
    }

    public function insert($email,$mdp){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':email'=>$email,':mdp'=>$mdp));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function select(){        
        $this->select->execute();        
        if ($this->select->errorCode()!=0){             
            print_r($this->select->errorInfo());          
        }        
        return $this->select->fetchAll();    
    }

    public function getbyID($email){        
        $this->getbyID->execute(array(':email'=>$email));        
        if ($this->getbyID->errorCode()!=0){             
            print_r($this->getbyID->errorInfo());          
        }        
        return $this->getbyID->fetch();    
    }

    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));

        if($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r = false;
        }

        return $r;

    }
}

?>