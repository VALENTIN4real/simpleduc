<?php
class Projet{    
    private $db;
    private $insert;
    private $getAllProjets;
    private $getStartedProjets;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Projet(designation)VALUES(:designation)");
        $this->getStartedProjets = $db->prepare("SELECT *,nomEquipe FROM  Projet P, Equipe E WHERE P.idGroupe = E.id");
        $this->getAllProjets = $db->prepare("SELECT * FROM  Projet P");
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
}

?>