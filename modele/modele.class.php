<?php

class Modele {

    private $pdo;
    private $uneTable;

    public function __construct($server, $bdd, $user, $mdp) {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=".$server.";dbname=".$bdd.";charset=utf8", $user, $mdp);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function setTable($uneTable) {
        $this->uneTable = $uneTable;
    }

    public function selectAll($chaine, $orderby) {
        if ($this->pdo != null) {
            $requete = "SELECT ".$chaine." FROM ". $this->uneTable." ORDER BY ".$orderby." DESC;";
            $select = $this->pdo->prepare($requete);
            $select->execute();
            return $select->fetchAll();
        } else {
            return null;
        }
    }

    public function selectWhere($chaine, $where) {
        if ($this->pdo != null) {
            $champs = array();
            $donnees = array();
            foreach ($where as $key=>$value) {
                $champs[] = $key." = :".$key;
                $donnees[":".$key] = $value;
            }
            $chaineWhere = implode(" AND ", $champs);
            $requete = "SELECT ".$chaine." FROM ".$this->uneTable." WHERE ".$chaineWhere;
            $select = $this->pdo->prepare($requete);
            $select->execute($donnees);
            return $select->fetch();
        } else {
            return null;
        }
    }

    public function insert($tab) {
        if ($this->pdo != null) {
            $champs = array();
            $donnees = array();
            foreach ($tab as $key=>$value) {
                $champs[] = ":".$key;
                $donnees[":".$key] = $value;
            }
            $chaine = implode(",", $champs);
            $requete = "INSERT INTO ".$this->uneTable." VALUES (null, ".$chaine.")";
            $insert = $this->pdo->prepare($requete);
            $insert->execute($donnees);
        } else {
            return null;
        }
    }

    public function delete($where) {
        if ($this->pdo != null) {
            $champs = array();
            $donnees = array();
            foreach ($where as $key=>$value) {
                $champs[] = $key." = :".$key;
                $donnees[":".$key] = $value;
            }
            $chaine = implode(" AND ", $champs);
            $requete = "DELETE FROM ".$this->uneTable." WHERE ".$chaine;
            $delete = $this->pdo->prepare($requete);
            $delete->execute($donnees);
        } else {
            return null;
        }
    }

    public function edit($tab, $where) {
        if ($this->pdo != null) {
            $champs = array();
            $donnees = array();
            foreach ($tab as $key=>$value) {
                $champs[] = $key . " = :".$key;
                $donnees[":".$key] = $value;
            }
            $chaine = implode(",", $champs);
            $champsWhere = array();
            foreach ($where as $key=>$value) {
                $champsWhere[] = $key." = :".$key;
                $donnees[":".$key] = $value;
            }
            $chaineWhere = implode(" AND ", $champsWhere);
            $requete ="UPDATE ".$this->uneTable." SET ".$chaine." WHERE ".$chaineWhere;
            $update = $this->pdo->prepare($requete);
            $update->execute($donnees);
        } else {
            return null;
        }
    }
    
    public function selectSearch($tab, $mot) {
        if ($this->pdo != null) {
            $donnees = array();
            $champs = array();
            foreach ($tab as $key) {
                $champs[] = $key." like :mot";
                $donnees[":mot"] = "%".$mot."%";
            }
            $chaineWhere = implode(" or ", $champs);
            $requete = "SELECT * FROM ".$this->uneTable." WHERE ".$chaineWhere;
            $select = $this->pdo->prepare($requete);
            $select->execute($donnees);
            return $select->fetchAll();
        } else {
            return null;
        }
    }

    public function title($text) {
        $html = "<div class='container'>";
        $html .= "<div class='row d-flex justify-content-center'>";
        $html .= "<div class='col-auto'>";
        $html .= "<div class='card bg-light mt-4'>";
        $html .= "<div class='card-header bg-light'>";
        $html .= "<h3 class='text-center text-dark'>{$text}</h3>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";
        return $html;
    }

    public function generateMdp() {
        $chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789/;%\()@&!";
        
        $mdp = ""; // Mot de passe vide par défaut
        
        // 5 lettres majuscules choisis aléatoirement
        $mdp .= $chaine[rand(0,25)]; // 1 lettre majuscule choisi aléatoirement
        $mdp .= $chaine[rand(0,25)]; // 1 lettre majuscule choisi aléatoirement
        $mdp .= $chaine[rand(0,25)]; // 1 lettre majuscule choisi aléatoirement
        $mdp .= $chaine[rand(0,25)]; // 1 lettre majuscule choisi aléatoirement
        $mdp .= $chaine[rand(0,25)]; // 1 lettre majuscule choisi aléatoirement
       
        // 5 lettres minuscules choisis aléatoirement
        $mdp .= $chaine[rand(26,51)]; // 1 lettre minuscule choisi aléatoirement
        $mdp .= $chaine[rand(26,51)]; // 1 lettre minuscule choisi aléatoirement
        $mdp .= $chaine[rand(26,51)]; // 1 lettre minuscule choisi aléatoirement
        $mdp .= $chaine[rand(26,51)]; // 1 lettre minuscule choisi aléatoirement
        $mdp .= $chaine[rand(26,51)]; // 1 lettre minuscule choisi aléatoirement
        
        // 2 chiffres choisis aléatoirement
        $mdp .= $chaine[rand(52,60)]; // 1 chiffre choisi aléatoirement
        $mdp .= $chaine[rand(52,60)]; // 1 chiffre choisi aléatoirement

        // 5 caractères spécial choisis aléatoirement
        $mdp .= $chaine[rand(61,69)]; // 1 caractère spécial choisi aléatoirement
        $mdp .= $chaine[rand(61,69)]; // 1 caractère spécial choisi aléatoirement
        $mdp .= $chaine[rand(61,69)]; // 1 caractère spécial choisi aléatoirement
        $mdp .= $chaine[rand(61,69)]; // 1 caractère spécial choisi aléatoirement
        $mdp .= $chaine[rand(61,69)]; // 1 caractère spécial choisi aléatoirement
        
        $mdp = str_shuffle($mdp); // str_shuffle mélange les caractères d'une chaine de caractères
        return $mdp;
    }

}

?>
