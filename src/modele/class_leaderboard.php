<?php
class Leaderboard{    
    private $db;
    private $insert;
    private $selectTops;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Leaderboard(nomJoueur,score)VALUES(:nomJoueur,:score)");
        $this->selectTops = $db->prepare("SELECT * FROM Leaderboard order by score DESC LIMIT 10");
    }

    public function insert($nomJoueur,$score){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':nomJoueur'=>$nomJoueur,':score'=>$score));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }


    public function selectTops(){        
        $this->selectTops->execute();        
        if ($this->selectTops->errorCode()!=0){             
            print_r($this->selectTops->errorInfo());          
        }        
        return $this->selectTops->fetchAll();    
    }
}

?>