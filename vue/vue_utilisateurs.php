<?php if (isset($erreur)) { ?>
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?= $erreur; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="container mt-4 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher un utilisateur..." class="form-control">
                            </div>
                            <div class="col-3">
                                <button type="submit" name="Rechercher" class="btn btn-dark w-100">Rechercher</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Pseudo</th>
                                    <th scope="col">Adresse email</th>
                                    <th scope="col">Type</th>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                        <th scole="col">Opérations</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                    <form method="post" action="">
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="nomuser" id="nom" class="form-control" value="<?= ($leUser != null ? $leUser['nomuser'] : null); ?>"></td>
                                            <td><input type="text" name="prenomuser" id="prenom" class="form-control" value="<?= ($leUser != null ? $leUser['prenomuser'] : null); ?>"></td>
                                            <td><input type="text" name="pseudouser" id="pseudo" class="form-control" value="<?= ($leUser != null ? $leUser['pseudouser'] : null); ?>"></td>
                                            <td><input type="email" name="emailuser" id="email" class="form-control" value="<?= ($leUser != null ? $leUser['emailuser'] : null); ?>"></td>
                                            <td>
                                                <select name="lvl" class="form-select">
                                                    <option value="1" <?php if ($leUser != null && $leUser['lvl'] == 1) {echo "selected";} ?>>Utilisateur</option>
                                                    <option value="2" <?php if ($leUser != null && $leUser['lvl'] == 2) {echo "selected";} ?>>Administrateur</option>
                                                </select>
                                            </td>
                                            <td>
                                                <?php if ($leUser != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($leUser != null ? 'name="subeditutilisateur"' : 'name="subaddutilisateur"'); ?> class="btn <?= ($leUser != null ? 'btn-primary' : 'btn-success w-100'); ?>"><?= ($leUser != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php foreach ($lesUtilisateurs as $unUtilisateur) { ?>
                                <tr>
                                    <td><?= $unUtilisateur['iduser']; ?></td>
                                    <td><?= $unUtilisateur['nomuser']; ?></td>
                                    <td><?= $unUtilisateur['prenomuser']; ?></td>
                                    <td><?= $unUtilisateur['pseudouser']; ?></td>
                                    <td><?= $unUtilisateur['emailuser']; ?></td>
                                    <td>
                                        <?php if ($unUtilisateur['lvl'] == 1) { ?>
                                            <span class="badge bg-info text-dark">Utilisateur</span>
                                        <?php } elseif ($unUtilisateur['lvl'] == 2) { ?>
                                            <span class="badge bg-danger">Administrateur</span>
                                        <?php } ?>
                                    </td>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                        <td>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="index.php?page=5&action=edit&iduser=<?= $unUtilisateur['iduser']; ?>" class="btn btn-primary">Modifier</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="index.php?page=5&action=sup&iduser=<?= $unUtilisateur['iduser']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cet utilisateur ?'));" class="btn btn-danger">Supprimer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
<h3 class="text-center mb-3"><?= ($leUser != null ? "Modification" : "Insertion"); ?> d'un utilisateur</h3>
<form method="post" action="">
    <div class="mb-3">
        <label for="email" class="form-label">Adresse email de l'utilisateur</label>
        <input type="email" name="emailuser" id="email" class="form-control" value="<?= ($leUser != null ? $leUser['emailuser'] : null); ?>">
    </div>
    <div class="mb-3">
        <label for="mdp" class="form-label">Mot de passe de l'utilisateur</label>
        <input type="password" name="mdpuser" id="mdp" class="form-control" value="<?= ($leUser != null ? $leUser['mdpuser'] : null); ?>">
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type d'utilisateur</label>
        <select class="form-select" name="lvl" id="type">
            <option value="1">Utilisateur</option>
            <option value="2">Administrateur</option>
        </select>
    </div>
</form>
-->

