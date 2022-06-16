<?php session_start();
require_once("controleur/controleur.class.php");
require_once("controleur/config_db.php");
$unControleur = new Controleur($server, $bdd, $user, $mdp);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion des matériels - IRIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">

<?php 
    if (isset($_POST['Connexion'])) {
        $emailuser = $_POST['emailuser'];
        $mdpuser = $_POST['mdpuser'];
        $chaine = "*";
        $where = array("emailuser"=>$emailuser, "mdpuser"=>$mdpuser);
        $unControleur->setTable("users");
        $unUser = $unControleur->selectWhere($chaine, $where);
        if (isset($unUser['emailuser'])) {
            $_SESSION['emailuser'] = $unUser['emailuser'];
            $_SESSION['pseudouser'] = $unUser['pseudouser'];
            $_SESSION['lvl'] = $unUser['lvl'];
            header('Location: index.php');
        } else {
            echo '<div class="container mt-4">
                    <div class="row d-flex justify-content-center">
                        <div class="col-auto">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Veuillez vérifiez vos identifiants</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
    if (!isset($_SESSION['emailuser'])) {
        require_once("vue/vue_connexion.php");  
    } else {  
?>
<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="index.php">IRIS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="index.php?page=0">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="index.php?page=1">Professeurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="index.php?page=2">Matériels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="index.php?page=3">Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="index.php?page=4">Locations</a>
                </li>
                <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="index.php?page=5">Utilisateurs</a>
                </li>
                <?php } ?>
            </ul>
            <?php if ($_SESSION['lvl'] == 1) { ?>
            <span class="ms-3 badge bg-info text-dark me-4"><?= $_SESSION['pseudouser']; ?></span>
            <?php } elseif ($_SESSION['lvl'] == 2) { ?>
            <span class="ms-3 badge bg-danger me-4"><?= $_SESSION['pseudouser']; ?></span>
            <?php } ?>
            <a href="index.php?page=6" class="btn btn-danger">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row d-flex justify-content-center">
        <?php
            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                $page = 0;

            switch ($page) {
                case 1 :
                    require_once("gestion_profs.php");
                    break;
                case 2 :
                    require_once("gestion_materiels.php");
                    break;
                case 3 :
                    require_once("gestion_categories.php");
                    break;
                case 4 :
                    require_once("gestion_locations.php");
                    break;
                case 5 :
                    require_once("gestion_utilisateurs.php");
                    break;
                case 6 :
                    unset($_SESSION);
                    session_destroy();
                    header('Location: /Materiels/');
                    break;
                case 0 :
                    require_once("home.php");
                    break;
                default :
                    require_once("erreur.php");
                    break;
            }
        ?>
    </div>
</div>

<?php } ?>

<div class="card text-center fixed-bottom">
    <div class="card-body">
        <h5 class="card-title text-dark">Gestion des matériels au sein de l'école IRIS</h5>
    </div>
    <div class="card-footer text-muted">&copy; Copyright 2021 - Tom BRUAIRE</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>

</body>
</html>
