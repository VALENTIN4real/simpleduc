<?php
class Projet{    
    private $db;
    private $insert;
    private $getAllProjets;
    private $getStartedProjets;
    private $getProjetByID;
    private $update;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Projet(designation)VALUES(:designation)");
        $this->getStartedProjets = $db->prepare("SELECT *,nomEquipe FROM  Projet P, Equipe E WHERE P.idGroupe = E.id");
        $this->getAllProjets = $db->prepare("SELECT * FROM  Projet P");
        $this->getProjetByID = $db->prepare("SELECT * FROM  Projet P WHERE id = :id");
        $this->update = $db->prepare("UPDATE Projet SET idGroupe=:idGroupe WHERE id=:id");
   
    }



    public function insert($idEmploye, $idEquipe){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':idEmploye'=>$idEmploye,':idEquipe'=>$idEquipe));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }   
    
    public function getAllProjets(){        
        $this->getAllProjets->execute();        
        if ($this->getAllProjets->errorCode()!=0){             
            print_r($this->getAllProjets->errorInfo());          
        }        
        return $this->getAllProjets->fetchAll();    
    }

    public function getStartedProjets(){        
        $this->getStartedProjets->execute();        
        if ($this->getStartedProjets->errorCode()!=0){             
            print_r($this->getStartedProjets->errorInfo());          
        }        
        return $this->getStartedProjets->fetchAll();    
    }

    public function getProjetByID($id){        
        $this->getProjetByID->execute(array(':id'=>$id));        
        if ($this->getProjetByID->errorCode()!=0){             
            print_r($this->getProjetByID->errorInfo());          
        }        
        return $this->getProjetByID->fetch();    
    }

    public function update($id,$idGroupe){        
        $r = true;        
        $this->update->execute(array(':id'=>$id,':idGroupe'=>$idGroupe));        
        if ($this->update->errorCode()!=0){
            print_r($this->update->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }
}

?>