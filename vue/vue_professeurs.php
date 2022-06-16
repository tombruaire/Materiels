<div class="container mt-4 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher un professeur..." class="form-control">
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
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Diplôme</th>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                    <th scope="col">Opérations</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                    <form method="post" action="">
                                        <tr>
                                            <td></td>
                                            <td><input type="text" name="nomprofesseur" id="nom" class="form-control" value="<?= ($leProf != null ? $leProf['nomprofesseur'] : null); ?>"></td>
                                            <td><input type="text" name="prenomprofesseur" id="prenom" class="form-control" value="<?= ($leProf != null ? $leProf['prenomprofesseur'] : null); ?>"></td>
                                            <td><input type="text" name="adresseprofesseur" id="adresse" class="form-control" value="<?= ($leProf != null ? $leProf['adresseprofesseur'] : null); ?>"></td>
                                            <td><input type="text" name="diplomeprofesseur" id="diplome" class="form-control" value="<?= ($leProf != null ? $leProf['diplomeprofesseur'] : null); ?>"></td>
                                            <td>
                                                <?php if ($leProf != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($leProf != null ? 'name="subeditprofesseur"' : 'name="subaddprofesseur"'); ?> class="btn <?= ($leProf != null ? 'btn-primary' : 'btn-success w-100'); ?> "><?= ($leProf != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php foreach ($lesProfs as $unProf) { ?>
                                <tr>
                                    <td><?= $unProf['idprofesseur']; ?></td>
                                    <td><?= $unProf['nomprofesseur']; ?></td>
                                    <td><?= $unProf['prenomprofesseur']; ?></td>
                                    <td><?= $unProf['adresseprofesseur']; ?></td>
                                    <td><?= $unProf['diplomeprofesseur']; ?></td>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                    <td>
                                        <a href="index.php?page=1&action=edit&idprofesseur=<?= $unProf['idprofesseur']; ?>" class="btn btn-primary me-2">Modifier</a>
                                        <a href="index.php?page=1&action=sup&idprofesseur=<?= $unProf['idprofesseur']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce professeur ?'));" class="btn btn-danger">Supprimer</a>
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
