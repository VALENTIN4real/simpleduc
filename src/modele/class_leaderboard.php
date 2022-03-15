<?php
class Leaderboard{    
    private $db;
    private $insert;
    private $selectFacileTops;
    private $selectMoyenTops;
    private $selectDifficileTops;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Leaderboard(nomJoueur,score,difficulty)VALUES(:nomJoueur,:score,:difficulty)");
        $this->selectFacileTops = $db->prepare("SELECT * FROM Leaderboard where difficulty=1 order by score DESC LIMIT 10");
        $this->selectMoyenTops = $db->prepare("SELECT * FROM Leaderboard where difficulty=2 order by score DESC LIMIT 10");
        $this->selectDifficileTops = $db->prepare("SELECT * FROM Leaderboard where difficulty=3 order by score DESC LIMIT 10");
    }

    public function insert($nomJoueur,$score,$difficulty){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':nomJoueur'=>$nomJoueur,':score'=>$score,':difficulty'=>$difficulty));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }


    public function selectFacileTops(){        
        $this->selectFacileTops->execute();        
        if ($this->selectFacileTops->errorCode()!=0){             
            print_r($this->selectFacileTops->errorInfo());          
        }        
        return $this->selectFacileTops->fetchAll();    
    }

    public function selectMoyenTops(){        
        $this->selectMoyenTops->execute();        
        if ($this->selectMoyenTops->errorCode()!=0){             
            print_r($this->selectMoyenTops->errorInfo());          
        }        
        return $this->selectMoyenTops->fetchAll();    
    }

    public function selectDifficileTops(){        
        $this->selectDifficileTops->execute();        
        if ($this->selectDifficileTops->errorCode()!=0){             
            print_r($this->selectDifficileTops->errorInfo());          
        }        
        return $this->selectDifficileTops->fetchAll();    
    }
}

?>