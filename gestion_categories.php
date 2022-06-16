<?php

print($unControleur->title("Gestion des catégories"));

$laCategorie = null;

$unControleur->setTable("categories");

if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) {

    if (isset($_GET['action']) && isset($_GET['idcategorie'])) {
        $action = $_GET['action'];
        $idcategorie = $_GET['idcategorie'];
        $where = array('idcategorie'=>$idcategorie);
        switch ($action) {
            case 'sup':
                $unControleur->delete($where);
                echo "<script>alert('Suppression de la catégorie réussi !');window.location.href='index.php?page=3';</script>";
                break;
            case 'edit':
                $laCategorie = $unControleur->selectWhere("*", $where);
                break;
        }
    }

    if (isset($_POST['subeditcategorie'])) {
        $where = array('idcategorie' => $_GET['idcategorie']);
        $tab = array(
            'libellecategorie'=>$_POST['libellecategorie'],
            'fournisseurcategorie'=>$_POST['fournisseurcategorie']
        );
        $unControleur->edit($tab, $where);
        echo "<script>alert('Modification de la catégorie effectuée !');window.location.href='index.php?page=3';</script>";
    }

    if (isset($_POST['subaddcategorie'])) {
        $tab = array(
            'libellecategorie'=>$_POST['libellecategorie'],
            'fournisseurcategorie'=>$_POST['fournisseurcategorie']
        );
        $unControleur->insert($tab);
        echo "<script>alert('Insertion de la catégorie réussi !');window.location.href='index.php?page=3';</script>";
    }

}

if (isset($_POST['Rechercher'])) {
    $mot = $_POST['mot'];
    $tab = array("idcategorie", "libellecategorie", "fournisseurcategorie");
    $lesCategories = $unControleur->selectSearch($tab, $mot);
} else {
    $orderby = "idcategorie";
    $lesCategories = $unControleur->selectAll("*", $orderby);
}

require_once("vue/vue_categories.php");

?>
