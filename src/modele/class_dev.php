<?php
class Dev{    
    private $db;
    private $insert;
    private $getAllDevs;
    private $getDevByID;
    private $getAllDevsFromAGroup;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO Developpeur(idEmploye)VALUES(:id)");
        $this->getAllDevs = $db->prepare("SELECT * FROM Developpeur, Employe WHERE idEmploye = id");
        $this->getDevByID = $db->prepare("SELECT * FROM Developpeur, Employe WHERE idEmploye = id AND idEmploye=:id");
        $this->getAllDevsFromAGroup = $db->prepare("SELECT * FROM Developpeur D, AssocierEquipe A,Employe E  WHERE D.idEmploye = A.idEmploye AND D.idEmploye = E.id AND A.idEquipe=:id");
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

    public function getAllDevsFromAGroup($id){        
        $this->getAllDevsFromAGroup->execute(array(':id'=>$id));        
        if ($this->getAllDevsFromAGroup->errorCode()!=0){             
            print_r($this->getAllDevsFromAGroup->errorInfo());          
        }        
        return $this->getAllDevsFromAGroup->fetchAll();    
    }
}

?>