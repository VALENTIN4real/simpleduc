<?php
class Equipe{    
    private $db;
    private $insert;
    private $getAllEquipes;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Equipe(nomEquipe)VALUES(:nomEquipe)");
        $this->getAllEquipes = $db->prepare("SELECT * FROM Equipe");
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
}

?>