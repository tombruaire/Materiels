<div class="container mt-4 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            <div class="card bg-info">
                <div class="card-header">
                    <form method="post" action="" class="mt-2">
                        <div class="row mb-3">
                            <div class="col-9">
                                    <input type="search" name="mot" id="mot" placeholder="Rechercher un matériel..." class="form-control">
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
                                    <th scope="col">Désignation</th>
                                    <th scope="col">Date d'achat</th>
                                    <th scope="col">État</th>
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
                                            <td><input type="text" name="designationmateriel" id="designation" class="form-control" value="<?= ($leMateriel != null ? $leMateriel['designationmateriel'] : null); ?>"></td>
                                            <td><input type="date" name="dateachatmateriel" id="dateachat" class="form-control" value="<?= ($leMateriel != null ? $leMateriel['dateachatmateriel'] : null); ?>"></td>
                                            <td>
                                                <select name="etatmateriel" class="form-select">
                                                    <option value="Bon état" <?php if ($leMateriel != null && $leMateriel['etatmateriel'] == "Bon état") {echo "selected";} ?>>Bon état</option>
                                                    <option value="Mauvais état" <?php if ($leMateriel != null && $leMateriel['etatmateriel'] == "Mauvais état") {echo "selected";} ?>>Mauvais état</option>
                                                </select>
                                            </td>
                                            <td>
                                                <?php if ($leMateriel != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($leMateriel != null ? 'name="subeditmateriel"' : 'name="subaddmateriel"'); ?> class="btn <?= ($leMateriel != null ? 'btn-primary' : 'btn-success w-100'); ?>"><?= ($leMateriel != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php foreach ($lesMateriels as $unMateriel) { ?>
                                <tr>
                                    <td><?= $unMateriel['idmateriel']; ?></td>
                                    <td><?= $unMateriel['designationmateriel']; ?></td>
                                    <td><?= $unMateriel['dateachatmateriel']; ?></td>
                                    <td><?= $unMateriel['etatmateriel']; ?></td>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                    <td>
                                        <a href="index.php?page=2&action=edit&idmateriel=<?= $unMateriel['idmateriel']; ?>" class="btn btn-primary me-2">Modifier</a>
                                        <a href="index.php?page=2&action=sup&idmateriel=<?= $unMateriel['idmateriel']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer ce matériel ?'));" class="btn btn-danger">Supprimer</a>
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

