<?php
class Role{    
    private $db;
    private $insert; 
    private $connect;
    private $select;

    public function __construct($db){        
        $this->db = $db;    
        $this->insert = $this->db->prepare("insert  into  Role(libelle)values (:libelle)");
        $this->select = $db->prepare("SELECT * FROM Role");
    }

    public function insert($libelle){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':libelle'=>$libelle));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function connect($email){   
        $unUtilisateur = $this->connect->execute(array(':email'=>$email));       
        if ($this->connect->errorCode()!=0){             
            print_r($this->connect->errorInfo());          
        }        
        return $this->connect->fetch();    
    } 

    public function select(){        
        $this->select->execute();        
        if ($this->select->errorCode()!=0){             
            print_r($this->select->errorInfo());          
        }        
        return $this->select->fetchAll();    
    }
}

?>