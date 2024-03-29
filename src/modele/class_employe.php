<?php
class Employe{    
    private $db;
    private $insert; 
    private $connect;
    private $select;
    private $selectDestinataire;
    private $selectByAccount;
    private $selectByID;
    private $update;
    private $mkUserList;
    private $mkUserListIna;
    private $delete;
    private $getIDAccount;
    private $updateEstInactif;

    public function __construct($db){        
        $this->db = $db;    
        $this->insert = $this->db->prepare("insert  into  Employe(nom,  prenom,  idRole,idCompte,adresse,adresseBis,ville,numTel,codePostal,dateInscription)values (:nom, :prenom, :role,:idCompte,:adresse,:adresseBis,:ville,:numTel,:codePostal,:dateInscription)");
        $this->connect = $this->db->prepare("select   E.id, C.email,   E.idRole, libelle, C.mdp, estInactif from Employe E, Compte C, Role R WHERE R.id = E.idRole AND E.idCompte = C.id and C.email=:email");
        $this->select = $db->prepare("select E.id, nom, prenom, idRole, libelle,dateInscription  from Employe E, Role R where E.idRole = R.id");
        $this->selectDestinataire = $db->prepare("select E.id, nom, prenom, idRole, libelle,dateInscription,email  from Employe E, Role R, Compte C where E.idRole = R.id  AND E.idCompte = C.id AND nom != :nom");
        $this->selectByAccount = $this->db->prepare("SELECT E.id, nom, prenom, adresse, adresseBis, ville,codePostal, numTel, estInactif , email, idRole,r.libelle, idCompte, dateInscription FROM Employe E, Compte C, Role r WHERE C.email = :email AND idRole = r.id AND C.id = E.idCompte;");
        $this->selectByID = $this->db->prepare("SELECT E.id, nom, prenom, adresse, adresseBis, ville,codePostal, numTel ,estInactif, email, idRole, r.libelle, idCompte,dateInscription FROM Employe E, Compte C, Role r WHERE E.id = :id AND idRole = r.id AND idCompte = C.id");
        $this->mkUserList = $this->db->prepare("SELECT E.id, email, nom, prenom, libelle, numTel, estInactif,dateInscription FROM Employe E, Role R, Compte C WHERE E.idCompte = C.id AND E.idRole = R.id ORDER BY estInactif,E.nom");
        $this->mkUserListIna = $this->db->prepare("SELECT E.id, email, nom, prenom, libelle, numTel, estInactif,dateInscription FROM Employe E, Role R, Compte C WHERE estInactif = 1 AND E.idCompte = C.id AND E.idRole = R.id ORDER BY E.idCompte");
        $this->update  =  $db->prepare("UPDATE Employe, Compte set  nom=:nom,  prenom=:prenom,  idRole=:role, adresse=:adresse, adresseBis=:adresseBis, ville=:ville, numTel=:numTel, codePostal=:codePostal, email=:email where Compte.id = idCompte AND Employe.id=:id");
        $this->delete = $db->prepare("DELETE FROM Employe WHERE id=:id");
        $this->getIDAccount = $this->db->prepare("SELECT idCompte FROM Employe WHERE id=:id");
        $this->updateEstInactif = $db->prepare("UPDATE Employe SET estInactif=:estInactif WHERE id=:id");
    }

    public function insert($role,$idCompte, $nom, $prenom,$adresse,$adresseBis,$ville,$numTel,$codePostal,$dateInscription){ // Étape 3         
        $r = true;        
        $this->insert->execute(array(':role'=>$role,':idCompte'=>$idCompte, ':nom'=>$nom,':prenom'=>$prenom,':adresse'=>$adresse,':adresseBis'=>$adresseBis,':ville'=>$ville,':numTel'=>$numTel,':codePostal'=>$codePostal,'dateInscription'=>$dateInscription));        
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());               
            $r=false;        
        }        
        return $r; 
    }

    public function update($role, $nom, $prenom,$adresse,$adresseBis,$ville,$numTel,$codePostal,$email,$id){ // Étape 3         
        $r = true;        
        $this->update->execute(array(':role'=>$role,':nom'=>$nom,':prenom'=>$prenom,':adresse'=>$adresse,':adresseBis'=>$adresseBis,':ville'=>$ville,':numTel'=>$numTel,':codePostal'=>$codePostal,':email'=>$email,':id'=>$id));        
        if ($this->update->errorCode()!=0){
            print_r($this->update->errorInfo());               
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

    public function selectDestinataire($nom){        
        $this->selectDestinataire->execute(array(':nom'=>$nom));        
        if ($this->selectDestinataire->errorCode()!=0){             
            print_r($this->selectDestinataire->errorInfo());          
        }        
        return $this->selectDestinataire->fetchAll();    
    }

    public function selectByAccount($email){        
        $this->selectByAccount->execute(array(':email'=>$email));        
        if ($this->selectByAccount->errorCode()!=0){             
            print_r($this->selectByAccount->errorInfo());          
        }        
        return $this->selectByAccount->fetch();    
    }

    public function selectByID($id){        
        $this->selectByID->execute(array(':id'=>$id));        
        if ($this->selectByID->errorCode()!=0){             
            print_r($this->selectByID->errorInfo());          
        }        
        return $this->selectByID->fetch();    
    }

    public function mkUserList(){
        $this->mkUserList->execute();

        if($this->mkUserList->errorCode()!=0){
            print_r($this->mkUserList->errorInfo());
        }

        return $this->mkUserList->fetchAll();
    }

    public function mkUserListIna(){
        $this->mkUserList->execute();

        if($this->mkUserList->errorCode()!=0){
            print_r($this->mkUserList->errorInfo());
        }

        return $this->mkUserList->fetchAll();
    }

    public function delete($id){
        $r = true;

        $this->delete->execute(array(':id'=>$id));

        if($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r = false;
        }

        return $r;

    }
    

    public function getIDAccount($id){        
        $this->getIDAccount->execute(array(':id'=>$id));        
        if ($this->getIDAccount->errorCode()!=0){             
            print_r($this->getIDAccount->errorInfo());          
        }        
        return $this->getIDAccount->fetch();    
    }

    public function updateEstInactif($estInactif,$id){
        $r = true;

        $this->updateEstInactif->execute(array('estInactif'=>$estInactif,':id'=>$id));

        if($this->updateEstInactif->errorCode()!=0){
            print_r($this->updateEstInactif->errorInfo());
            $r = false;
        }

        return $r;

    }
}

?>