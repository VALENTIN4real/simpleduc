<?php
class Compte{    
    private $db;
    private $insert; 
    private $connect;
    private $select;
    private $getID;
    private $getFirstConnexion;
    private $modifPassword;
    private $delete;
    private $updateConnexion;

    public function __construct($db){        
        $this->db = $db;    
        $this->insert = $this->db->prepare("insert  into  Compte(email,mdp,premiereConnexion)values (:email,:mdp,1)");
        $this->select = $db->prepare("SELECT * FROM Compte");
        $this->getID = $db->prepare("SELECT id FROM Compte WHERE email=:email");
        $this->getFirstConnexion = $db->prepare("SELECT premiereConnexion FROM Compte WHERE email=:email");
        $this->modifPassword = $db->prepare("UPDATE Compte SET mdp=:mdp WHERE id=:id");
        $this->delete = $db->prepare("DELETE FROM Compte WHERE id=:id");
        $this->updateConnexion = $db->prepare("UPDATE Compte SET premiereConnexion = 0 WHERE id=:id");
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

    public function getID($email){        
        $this->getID->execute(array(':email'=>$email));        
        if ($this->getID->errorCode()!=0){             
            print_r($this->getID->errorInfo());          
        }        
        return $this->getID->fetch();    
    }

    public function getFirstConnexion($email){        
        $this->getFirstConnexion->execute(array(':email'=>$email));        
        if ($this->getFirstConnexion->errorCode()!=0){             
            print_r($this->getFirstConnexion->errorInfo());          
        }        
        return $this->getFirstConnexion->fetch();    
    }

    public function modifPassword($mdp,$id){ // Étape 3         
        $r = true;        
        $this->modifPassword->execute(array(':mdp'=>$mdp,':id'=>$id));        
        if ($this->modifPassword->errorCode()!=0){
            print_r($this->modifPassword->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function updateConnexion($id){ // Étape 3         
        $r = true;        
        $this->updateConnexion->execute(array(':id'=>$id));        
        if ($this->updateConnexion->errorCode()!=0){
            print_r($this->updateConnexion->errorInfo());               
            $r=false;        
        }        
        return $r; 
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