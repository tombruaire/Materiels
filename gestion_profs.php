<?php

print($unControleur->title("Gestion des professeurs"));

$leProf = null;

$unControleur->setTable("professeurs");

if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) {

    if (isset($_GET['action']) && isset($_GET['idprofesseur'])) {
        $action = $_GET['action'];
        $idprofesseur = $_GET['idprofesseur'];
        $where = array('idprofesseur'=>$idprofesseur);
        switch ($action) {
            case 'sup':
                $unControleur->delete($where);
                echo "<script>alert('Suppression du professeur réussi !');window.location.href='index.php?page=1';</script>";
                break;
            case 'edit':
                $leProf = $unControleur->selectWhere("*", $where);
                break;
        }
    }

    if (isset($_POST['subeditprofesseur'])) {
        $where = array('idprofesseur' => $_GET['idprofesseur']);
        $tab = array(
            'nomprofesseur' => $_POST['nomprofesseur'],
            'prenomprofesseur' => $_POST['prenomprofesseur'],
            'adresseprofesseur' => $_POST['adresseprofesseur'],
            'diplomeprofesseur' => $_POST['diplomeprofesseur']
        );
        $unControleur->edit($tab, $where);
        echo "<script>alert('Modification du professeur effectuée !');window.location.href='index.php?page=1';</script>";
    }

    if (isset($_POST['subaddprofesseur'])) {
        $tab = array(
            'nomprofesseur'=>$_POST['nomprofesseur'],
            'prenomprofesseur'=>$_POST['prenomprofesseur'],
            'adresseprofesseur'=>$_POST['adresseprofesseur'],
            'diplomeprofesseur'=>$_POST['diplomeprofesseur']
        );
        $unControleur->insert($tab);
        echo "<script>alert('Insertion du professeur réussi !');window.location.href='index.php?page=1';</script>";
    }

    if (isset($_POST['Annuler'])) {
        echo "<script>window.location.href='index.php?page=1';</script>";
    }

}

if (isset($_POST['Rechercher'])) {
    $mot = $_POST['mot'];
    $tab = array("idprofesseur", "nomprofesseur", "prenomprofesseur", "adresseprofesseur", "diplomeprofesseur");
    $lesProfs = $unControleur->selectSearch($tab, $mot);
} else {
    $orderby = "idprofesseur";
    $lesProfs = $unControleur->selectAll("*", $orderby);
}

require_once("vue/vue_professeurs.php");

?>
