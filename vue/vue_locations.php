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
                                    <th scope="col">Date location</th>
                                    <th scope="col">Heure location</th>
                                    <th scope="col">Durée location</th>
                                    <th scope="col">Professeur</th>
                                    <th scope="col">Matériel</th>
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
                                            <td><input type="date" name="datelocation" id="datel" class="form-control" value="<?= ($laLocation != null ? $laLocation['datelocation'] : null); ?>"></td>
                                            <td><input type="time" name="heurelocation" id="heure" class="form-control" value="<?= ($laLocation != null ? $laLocation['heurelocation'] : null); ?>"></td>
                                            <td><input type="number" name="dureelocation" id="duree" class="form-control" value="<?= ($laLocation != null ? $laLocation['dureelocation'] : null); ?>"></td>
                                            <td>
                                                <select name="idprofesseur" class="form-select">
                                                    <?php
                                                    $unControleur->setTable("professeurs");
                                                    $id = "idprofesseur";
                                                    $lesProfs = $unControleur->selectAll("*", $id);
                                                    foreach ($lesProfs as $unProf) { ?>
                                                        <option value="<?= $unProf['idprofesseur']; ?>" <?php if ($laLocation != null && $laLocation['idprofesseur'] == $unProf['idprofesseur']) {echo "selected";} ?>><?= $unProf['prenomprofesseur']; ?> <?= $unProf['nomprofesseur']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="idmateriel" class="form-select">
                                                    <?php
                                                    $unControleur->setTable("materiels");
                                                    $id = "idmateriel";
                                                    $lesMateriels = $unControleur->selectAll("*", $id);
                                                    foreach ($lesMateriels as $unMateriel) { ?>
                                                        <option value="<?= $unMateriel['idmateriel']; ?>" <?php if ($laLocation != null && $laLocation['idmateriel'] == $unMateriel['idmateriel']) {echo "selected";} ?>><?= $unMateriel['designationmateriel']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <?php if ($laLocation != null) { ?>
                                                    <button type="submit" name="Annuler" class="btn btn-danger me-2">Annuler</button>
                                                <?php } ?>
                                                <button type="submit" <?= ($laLocation != null ? 'name="subeditlocation"' : 'name="subaddlocation"'); ?> class="btn <?= ($laLocation != null ? 'btn-primary' : 'btn-success w-100'); ?>"><?= ($laLocation != null ? "Modifier" : "Ajouter"); ?></button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php foreach ($lesLocations as $uneLocation) { ?>
                                <tr>
                                    <td><?= $uneLocation['idlocation']; ?></td>
                                    <td><?= $uneLocation['datelocation']; ?></td>
                                    <td><?= $uneLocation['heurelocation']; ?></td>
                                    <td><?= $uneLocation['dureelocation']; ?> minutes</td>
                                    <td><?= $uneLocation['prenomprofesseur']; ?> <?= $uneLocation['nomprofesseur']; ?></td>
                                    <td><?= $uneLocation['designationmateriel']; ?></td>
                                    <?php if (isset($_SESSION['lvl']) && $_SESSION['lvl'] == 2) { ?>
                                    <td>
                                        <a href="index.php?page=4&action=edit&idlocation=<?= $uneLocation['idlocation']; ?>" class="btn btn-primary me-2">Modifier</a>
                                        <a href="index.php?page=4&action=sup&idlocation=<?= $uneLocation['idlocation']; ?>" onclick="return(confirm('Voulez-vous vraiment supprimer cette location ?'));" class="btn btn-danger">Supprimer</a>
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
