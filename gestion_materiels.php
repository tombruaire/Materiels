<?php

print($unControleur->title("Gestion des materiels"));

$leMateriel = null;

$unControleur->setTable("materiels");

if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) {

    if (isset($_GET['action']) && isset($_GET['idmateriel'])) {
        $action = $_GET['action'];
        $idmateriel = $_GET['idmateriel'];
        $where = array('idmateriel'=>$idmateriel);
        switch ($action) {
            case 'sup':
                $unControleur->delete($where);
                echo "<script>alert('Suppression du matériel réussi !');window.location.href='index.php?page=2';</script>";
                break;
            case 'edit':
                $leMateriel = $unControleur->selectWhere("*", $where);
                break;
        }
    }

    if (isset($_POST['subeditmateriel'])) {
        $where = array('idmateriel' => $_GET['idmateriel']);
        $tab = array(
            'designationmateriel'=>$_POST['designationmateriel'],
            'dateachatmateriel'=>$_POST['dateachatmateriel'],
            'etatmateriel'=>$_POST['etatmateriel']
        );
        $unControleur->edit($tab, $where);
        echo "<script>alert('Modification du matériel effectuée !');window.location.href='index.php?page=2';</script>";
    }

    if (isset($_POST['subaddmateriel'])) {
        $tab = array(
            'designationmateriel'=>$_POST['designationmateriel'],
            'dateachatmateriel'=>$_POST['dateachatmateriel'],
            'etatmateriel'=>$_POST['etatmateriel']
        );
        $unControleur->insert($tab);
        echo "<script>alert('Insertion du matériel réussi !');window.location.href='index.php?page=2';</script>";
    }

    if (isset($_POST['Annuler'])) {
        echo "<script>window.location.href='index.php?page=2';</script>";
    }

}

if (isset($_POST['Rechercher'])) {
    $mot = $_POST['mot'];
    $tab = array("idmateriel", "designationmateriel", "dateachatmateriel", "etatmateriel");
    $lesMateriels = $unControleur->selectSearch($tab, $mot);
} else {
    $orderby = "idmateriel";
    $lesMateriels = $unControleur->selectAll("*", $orderby);
}

require_once("vue/vue_materiels.php");

?>
