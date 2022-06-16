<?php

require_once("modele/modele.class.php");

class Controleur {

    private $unModele;

    public function __construct($server, $bdd, $user, $mdp) {
        $this->unModele = new Modele($server, $bdd, $user, $mdp);
    }

    public function setTable($uneTable) {
        $this->unModele->setTable($uneTable);
    }

    public function selectAll($chaine = "*", $orderby) {
        return $this->unModele->selectAll($chaine, $orderby);
    }

    public function selectWhere($chaine = "*", $where) {
        return $this->unModele->selectWhere($chaine, $where);
    }

    public function insert($tab) {
        $this->unModele->insert($tab);
    }

    public function delete($where) {
        $this->unModele->delete($where);
    }

    public function edit($tab, $where) {
        $this->unModele->edit($tab, $where);
    }

    public function selectSearch($tab, $mot) {
        return $this->unModele->selectSearch($tab, $mot);
    }

    public function title($text) {
        return $this->unModele->title($text);
    }

    public function generateMdp() {
        return $this->unModele->generateMdp();
    }

}

?>
