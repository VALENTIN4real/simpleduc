<?php
class Archivage{    
    private $db;
    private $selectEmploye;
    private $selectLimit;
    private $selectCount;

    public function __construct($db){        
        $this->db = $db;
        $this->selectEmploye = $db->prepare("SELECT * FROM archiveEmploye");
        $this->selectLimit = $db->prepare("SELECT * FROM archiveEmploye order by id limit :inf,:limite");
        $this->selectCount =$db->prepare("SELECT count(*) as nb FROM archiveEmploye");
    }

    public function selectEmploye(){        
        $this->selectEmploye->execute();        
        if ($this->selectEmploye->errorCode()!=0){             
            print_r($this->selectEmploye->errorInfo());          
        }        
        return $this->selectEmploye->fetchAll();    
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