<?php

print($unControleur->title("Gestion des utilisateurs"));

$leUser = null;

$unControleur->setTable("users");

if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) {

    if (isset($_GET['action']) && isset($_GET['iduser'])) {
        $action = $_GET['action'];
        $iduser = $_GET['iduser'];
        $where = array('iduser'=>$iduser);
        switch ($action) {
            case 'sup':
                $unControleur->delete($where);
                echo "<script>alert('Suppression de l\'utilisateur réussi !');window.location.href='index.php?page=5';</script>";
                break;
            case 'edit':
                $leUser = $unControleur->selectWhere("*", $where);
                break;
        }
    }

    if (isset($_POST['subeditutilisateur'])) {
        $unControleur->setTable("users");
        $where = array('iduser' => $_GET['iduser']);
        $tab = array(
            'nomuser'=>$_POST['nomuser'],
            'prenomuser'=>$_POST['prenomuser'],
            'pseudouser'=>$_POST['pseudouser'],
            'emailuser'=>$_POST['emailuser'],
            'mdpuser'=>$_POST['mdpuser'],
            'lvl'=>$_POST['lvl']
        );
        $unControleur->edit($tab, $where);
        echo "<script>alert('Modification de l\'utilisateur effectuée !');window.location.href='index.php?page=5';</script>";
    }

    if (isset($_POST['subaddutilisateur'])) {
        $nomuser = $_POST['nomuser'];
        $prenomuser = $_POST['prenomuser'];
        $pseudouser = $_POST['pseudouser'];
        $emailuser = $_POST['emailuser'];
        $lvl = $_POST['lvl'];
        if ($nomuser != "") {
            if (preg_match("#^[A-Z][a-zA-Z]{1,50}$#", $nomuser)) {
                if ($prenomuser != "") {
                    if (preg_match("#^[A-Z][a-zA-Z]{1,50}$#", $prenomuser)) {
                        if ($pseudouser != "") {
                            if (preg_match("#^[A-Z][a-zA-Z]{1,20}$#", $pseudouser)) {
                                if ($emailuser != "") {
                                    if (filter_var($emailuser, FILTER_VALIDATE_EMAIL)) {
                                        if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$#", $emailuser)) {
                                            $unControleur->setTable("users");
                                            $where = array("pseudouser"=>$pseudouser);
                                            $checkPseudo = $unControleur->selectWhere("pseudouser", $where);
                                            if (!$checkPseudo) {
                                                $unControleur->setTable("users");
                                                $where = array("emailuser"=>$emailuser);
                                                $checkEmail = $unControleur->selectWhere("emailuser", $where);
                                                if (!$checkEmail) {
                                                    $tab = array(
                                                        'nomuser'=>$nomuser,
                                                        'prenomuser'=>$prenomuser,
                                                        'pseudouser'=>$pseudouser,
                                                        'emailuser'=>$emailuser,
                                                        'mdpuser'=>$unControleur->generateMdp(),
                                                        'lvl'=>$lvl
                                                    );
                                                    $unControleur->insert($tab);
                                                    echo "<script>alert('Insertion de l\'utilisateur réussi !');window.location.href='index.php?page=5';</script>";
                                                } else {
                                                    $erreur = "Cette adresse email est déjà utilisée.";
                                                }
                                            } else {
                                                $erreur = "Ce pseudo est déjà utilisé.";
                                            }
                                        } else {
                                            $erreur = "Format de l'adresse email invalide !";
                                        }
                                    } else {
                                        $erreur = "Format de l'adresse email invalide !";
                                    }
                                } else {
                                    $erreur = "Veuillez saisir une adresse email.";
                                }
                            } else {
                                $erreur = "Le pseudo doit commencer par une lettre majuscule, ne doit pas contenir de chiffre, et ne doit pas dépasser 20 caractères !";
                            }
                        } else {
                            $erreur = "Veuillez saisir un pseudo.";
                        }
                    } else {
                        $erreur = "Le prénom doit commencer par une lettre majuscule, ne doit pas contenir de chiffre, et ne doit pas dépasser 50 caractères !";
                    }
                } else {
                    $erreur = "Veuillez saisir un prénom.";
                }
            } else {
                $erreur = "Le nom doit commencer par une lettre majuscule, ne doit pas contenir de chiffre, et ne doit pas dépasser 50 caractères !";
            }
        } else {
            $erreur = "Veuillez saisir un nom.";
        }
    }

    if (isset($_POST['Annuler'])) {
        echo "<script>window.location.href='index.php?page=5';</script>";
    }

}

if (isset($_POST['Rechercher'])) {
    $mot = $_POST['mot'];
    $tab = array("iduser", "nomuser", "prenomuser", "pseudouser", "emailuser", "lvl");
    $lesUtilisateurs = $unControleur->selectSearch($tab, $mot);
} else {
    $orderby = "iduser";
    $lesUtilisateurs = $unControleur->selectAll("*", $orderby);
}

require_once("vue/vue_utilisateurs.php");

?>
