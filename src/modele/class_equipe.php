<?php
class Equipe{    
    private $db;
    private $insert;
    private $getAllEquipes;
    private $getByNom;
    private $selectLimit;
    private $selectCount;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Equipe(nomEquipe)VALUES(:nomEquipe)");
        $this->getAllEquipes = $db->prepare("SELECT * FROM Equipe order by nomEquipe");
        $this->getByNom = $db->prepare("SELECT * FROM Equipe where nomEquipe=:nomEquipe");
        $this->selectLimit = $db->prepare("SELECT * FROM Equipe order by id limit :inf,:limite");
        $this->selectCount =$db->prepare("SELECT count(*) as nb FROM Equipe");
    }



    public function insert($nomEquipe){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':nomEquipe'=>$nomEquipe));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function getAllEquipes(){        
        $this->getAllEquipes->execute();        
        if ($this->getAllEquipes->errorCode()!=0){             
            print_r($this->getAllEquipes->errorInfo());          
        }        
        return $this->getAllEquipes->fetchAll();    
    }

    public function getByNom($nomEquipe){        
        $this->getByNom->execute(array(':nomEquipe'=>$nomEquipe));        
        if ($this->getByNom->errorCode()!=0){             
            print_r($this->getByNom->errorInfo());          
        }        
        return $this->getByNom->fetch();    
    }

    public function selectLimit($inf, $limite){
        $this->selectLimit->bindParam(':inf', $inf, PDO::PARAM_INT);
        $this->selectLimit->bindParam(':limite', $limite, PDO::PARAM_INT);
        $this->selectLimit->execute();
        if ($this->selectLimit->errorCode()!=0){
             print_r($this->selectLimit->errorInfo());  
        }
        return $this->selectLimit->fetchAll();
    }

    public function selectCount(){
        $this->selectCount->execute();
        if ($this->selectCount->errorCode()!=0){
             print_r($this->selectCount->errorInfo());  
        }
        return $this->selectCount->fetch();  
    }
}

?>