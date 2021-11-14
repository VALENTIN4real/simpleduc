<?php
class Dev{    
    private $db;
    private $insert;
    private $getAllDevs;
    private $getDevByID;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Developpeur(idEmploye)VALUES(:id)");
        $this->getAllDevs = $db->prepare("SELECT * FROM Developpeur, Employe WHERE idEmploye = id");
        $this->getDevByID = $db->prepare("SELECT * FROM Developpeur, Employe WHERE idEmploye = id AND idEmploye=:id");
    }



    public function insert($id){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':id'=>$id));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function getAllDevs(){        
        $this->getAllDevs->execute();        
        if ($this->getAllDevs->errorCode()!=0){             
            print_r($this->getAllDevs->errorInfo());          
        }        
        return $this->getAllDevs->fetchAll();    
    }
    public function getDevByID($id){        
        $this->getDevByID->execute(array(':id'=>$id));        
        if ($this->getDevByID->errorCode()!=0){             
            print_r($this->getDevByID->errorInfo());          
        }        
        return $this->getDevByID->fetch();    
    }
}

?>