<?php
class AssocierEquipe{    
    private $db;
    private $insert;

    public function __construct($db){        
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO AssocierEquipe(idEmploye,idEquipe)VALUES(:idEmploye,:idEquipe)");
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
}

?>