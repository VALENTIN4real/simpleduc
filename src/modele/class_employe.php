<?php
class Employe{    
    private $db;
    private $insert; 
    private $connect;
    private $select;
    private $selectByAccount;

    public function __construct($db){        
        $this->db = $db;    
        $this->insert = $this->db->prepare("insert  into  Employe(nom,  prenom,  idRole,idCompte,adresse,adresseBis,region,numTel,codePostal)values (:nom, :prenom, :role,:idCompte,:adresse,:adresseBis,:region,:numTel,:codePostal)");
        $this->connect = $this->db->prepare("select   C.email,   E.idRole,   C.mdp   from   Employe E, Compte C where E.idCompte = C.id and C.email=:email");
        $this->select = $db->prepare("select E.id, email, nom, prenom, idRole, r.libelle as libellerole from Employe E, role r where E.idRole = r.id order by email");
        $this->selectByAccount = $this->db->prepare("SELECT E.id, nom, prenom, adresse, adresseBis, region,codePostal, numTel , email, idRole,r.libelle, idCompte FROM Employe E, Compte C, Role r WHERE C.email = :email AND idRole = r.id");
        $this->mkUserList = $this->db->prepare("SELECT E.id, email, nom, prenom, libelle, numTel FROM Employe E, Role R, Compte C WHERE E.idCompte = C.id AND E.idRole = R.id");
    }

    public function insert($role,$idCompte, $nom, $prenom,$adresse,$adresseBis,$region,$numTel,$codePostal){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':role'=>$role,':idCompte'=>$idCompte, ':nom'=>$nom,':prenom'=>$prenom,'adresse'=>$adresse,'adresseBis'=>$adresseBis,'region'=>$region,'numTel'=>$numTel,'codePostal'=>$codePostal));        
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

    public function mkUserList(){
        $this->mkUserList->execute();

        if($this->mkUserList->errorCode()!=0){
            print_r($this->mkUserList->errorInfo());
        }

        return $this->mkUserList->fetchAll();
    }
}

?>