<?php

print($unControleur->title("Gestion des locations"));

$laLocation = null;

if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) {

    if (isset($_GET['action']) && isset($_GET['idlocation'])) {
        $unControleur->setTable("locations");
        $id = "idlocation";
        $laLocation = $unControleur->selectAll("*", $id);
    }

    if (isset($_GET['action']) && isset($_GET['idlocation'])) {
        $action = $_GET['action'];
        $idlocation = $_GET['idlocation'];
        $where = array('idlocation'=>$idlocation);
        switch ($action) {
            case 'sup':
                $unControleur->delete($where);
                echo "<script>alert('Suppression de la location réussi !');window.location.href='index.php?page=4';</script>";
                break;
            case 'edit':
                $laLocation = $unControleur->selectWhere("*", $where);
                break;
        }
    }

    if (isset($_POST['subeditlocation'])) {
        $unControleur->setTable("locations");
        $where = array('idlocation' => $_GET['idlocation']);
        $tab = array(
            'datelocation'=>$_POST['datelocation'],
            'heurelocation'=>$_POST['heurelocation'],
            'dureelocation'=>$_POST['dureelocation'],
            'idprofesseur'=>$_POST['idprofesseur'],
            'idmateriel'=>$_POST['idmateriel']
        );
        $unControleur->edit($tab, $where);
        echo "<script>alert('Modification de la location effectuée !');window.location.href='index.php?page=4';</script>";
    }

    if (isset($_POST['subaddlocation'])) {
        $unControleur->setTable("locations");
        $tab = array(
            'datelocation'=>$_POST['datelocation'],
            'heurelocation'=>$_POST['heurelocation'],
            'dureelocation'=>$_POST['dureelocation'],
            'idprofesseur'=>$_POST['idprofesseur'],
            'idmateriel'=>$_POST['idmateriel']
        );
        $unControleur->insert($tab);
        echo "<script>alert('Insertion de la location réussi !');window.location.href='index.php?page=4';</script>";
    }

    if (isset($_POST['Annuler'])) {
        echo "<script>window.location.href='index.php?page=4';</script>";
    }

}

$unControleur->setTable("locationsProfsMats");

if (isset($_POST['Rechercher'])) {
    $mot = $_POST['mot'];
    $tab = array("idlocation", "datelocation", "heurelocation", "dureelocation", "nomprofesseur", "prenomprofesseur", "designationmateriel");
    $lesLocations = $unControleur->selectSearch($tab, $mot);
} else {
    $orderby = "idlocation";
    $lesLocations = $unControleur->selectAll("*", $orderby);
}

require_once("vue/vue_locations.php");

?>
