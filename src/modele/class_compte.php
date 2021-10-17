<?php
class Compte{    
    private $db;
    private $insert; 
    private $connect;
    private $select;
    private $getAnAccount;
    private $getID;
    private $getFirstConnexion;
    private $modifPassword;
    private $delete;
    private $updateConnexion;
    private $updateA2F;
    private $updateCodeA2F;

    public function __construct($db){        
        $this->db = $db;    
        $this->insert = $this->db->prepare("insert  into  Compte(email,mdp,premiereConnexion,isA2F)values (:email,:mdp,1,0)");
        $this->select = $db->prepare("SELECT * FROM Compte");
        $this->getAnAccount = $db->prepare("SELECT * FROM Compte WHERE email=:email");
        $this->getAnAccountByID = $db->prepare("SELECT * FROM Compte WHERE id=:id");
        $this->getID = $db->prepare("SELECT id FROM Compte WHERE email=:email");
        $this->getFirstConnexion = $db->prepare("SELECT premiereConnexion FROM Compte WHERE email=:email");
        $this->modifPassword = $db->prepare("UPDATE Compte SET mdp=:mdp WHERE id=:id");
        $this->delete = $db->prepare("DELETE FROM Compte WHERE id=:id");
        $this->updateConnexion = $db->prepare("UPDATE Compte SET premiereConnexion = 0 WHERE id=:id");
        $this->updateA2F = $db->prepare("UPDATE Compte SET isA2F=:a2fValue WHERE email=:email");
        $this->updateCodeA2F = $db->prepare("UPDATE Compte SET codeA2F=:codeA2F WHERE email=:email");
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

    public function getAnAccount($email){        
        $this->getAnAccount->execute(array(':email'=>$email));        
        if ($this->getAnAccount->errorCode()!=0){             
            print_r($this->getAnAccount->errorInfo());          
        }        
        return $this->getAnAccount->fetch();    
    }

    public function getAnAccountByID($id){        
        $this->getAnAccountByID->execute(array(':id'=>$id));        
        if ($this->getAnAccountByID->errorCode()!=0){             
            print_r($this->getAnAccountByID->errorInfo());          
        }        
        return $this->getAnAccountByID->fetch();    
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

    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));

        if($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r = false;
        }

        return $r;

    }

    public function updateConnexion($id){        
        $r = true;        
        $this->updateConnexion->execute(array(':id'=>$id));        
        if ($this->updateConnexion->errorCode()!=0){
            print_r($this->updateConnexion->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function updateA2F($a2fValue,$email){       
        $r = true;        
        $this->updateA2F->execute(array(':a2fValue'=>$a2fValue,':email'=>$email));        
        if ($this->updateA2F->errorCode()!=0){
            print_r($this->updateA2F->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function updateCodeA2F($codeA2F,$email){       
        $r = true;        
        $this->updateCodeA2F->execute(array(':codeA2F'=>$codeA2F,':email'=>$email));        
        if ($this->updateCodeA2F->errorCode()!=0){
            print_r($this->updateCodeA2F->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

}

?>