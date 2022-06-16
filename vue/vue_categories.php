<div class="container mt-4 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher une catégorie..." class="form-control">
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
                                    <th scope="col">Fournisseur</th>
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
                                            <td><input type="text" name="libellecategorie" id="libelle" class="form-control" value="<?= ($laCategorie != null ? $laCategorie['libellecategorie'] : null); ?>"></td>
                                            <td><input type="text" name="fournisseurcategorie" id="fournisseur" class="form-control" value="<?= ($laCategorie != null ? $laCategorie['fournisseurcategorie'] : null); ?>"></td>
                                            <td>
                                                <?php if ($laCategorie != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($laCategorie != null ? 'name="subeditcategorie"' : 'name="subaddcategorie"'); ?> class="btn <?= ($laCategorie != null ? 'btn-primary' : 'btn-success w-100'); ?>"><?= ($laCategorie != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                 <?php } ?>
                            <?php foreach ($lesCategories as $uneCategorie) { ?>
                                <tr>
                                    <td><?= $uneCategorie['idcategorie']; ?></td>
                                    <td><?= $uneCategorie['libellecategorie']; ?></td>
                                    <td><?= $uneCategorie['fournisseurcategorie']; ?></td>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                    <td>
                                        <a href="index.php?page=3&action=edit&idcategorie=<?= $uneCategorie['idcategorie']; ?>" class="btn btn-primary me-2">Modifier</a>
                                        <a href="index.php?page=3&action=sup&idcategorie=<?= $uneCategorie['idcategorie']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cette catégorie ?'));" class="btn btn-danger">Supprimer</a>
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
