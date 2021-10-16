<?php
class Archivage{    
    private $db;
    private $selectEmploye;

    public function __construct($db){        
        $this->db = $db;
        $this->selectEmploye = $db->prepare("SELECT * FROM archiveEmploye");
    }



    public function selectEmploye(){        
        $this->selectEmploye->execute();        
        if ($this->selectEmploye->errorCode()!=0){             
            print_r($this->selectEmploye->errorInfo());          
        }        
        return $this->selectEmploye->fetchAll();    
    }
}

?>