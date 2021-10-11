<?php
class Employe{    
    private $db;
    private $insert; 
    private $connect;
    private $select;
    private $selectByAccount;

    public function __construct($db){        
        $this->db = $db;    
        $this->insert = $this->db->prepare("insert  into  Employe(email,  mdp,  nom,  prenom,  idRole)values (:email, :mdp, :nom, :prenom, :role)");
        $this->connect = $this->db->prepare("select   C.email,   E.idRole,   C.mdp   from   Employe E, Compte C where E.idCompte = C.id and C.email=:email");
        $this->select = $db->prepare("select E.id, email, nom, prenom, idRole, r.libelle as libellerole from Employe E, role r where E.idRole = r.id order by email");
        $this->selectByAccount = $this->db->prepare("SELECT E.id, nom, prenom, email, idRole, idCompte FROM Employe E, Compte C WHERE C.email = :email");
    }

    public function insert($email, $mdp, $role, $nom, $prenom){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':email'=>$email, ':mdp'=>$mdp, ':role'=>$role, ':nom'=>$nom,':prenom'=>$prenom));        
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
    public function selectByAccount($email){        
        $this->selectByAccount->execute(array(':email'=>$email));        
        if ($this->selectByAccount->errorCode()!=0){             
            print_r($this->selectByAccount->errorInfo());          
        }        
        return $this->selectByAccount->fetch();    
    }
}

?>