<h2 class="text-center mb-3">Nouveau trajet</h2>
<form action="<?= base_url("parameters/trajet-list") ?>" method="post" class="parsley-examples">
    <!-- Départ -->
    <div class="mb-3">
        <label class="form-label"><?= lang('Label.departure')?></label>
        <div>
            <input type="text" name="trajetStart" class="form-control" required data-parsley-required-message="<?= lang('Label.required')?>" placeholder="Saisir ici" />
        </div>
    </div>
    <!-- Arrivée -->
    <div class="mb-3">
        <label class="form-label"><?= lang('Label.arrival')?></label>
        <div>
            <input type="text" name="trajetEnd" class="form-control" required data-parsley-required-message="<?= lang('Label.required')?>" placeholder="Saisir ici" />
        </div>
    </div>
    <!-- Zones -->
    <div class="mb-3">
        <label for="selectize-optgroup" class="form-label"><?= lang('Label.zone')?></label>
        <select id="selectize-optgroup" name="zone[]" class="selectMultiple" multiple>
            <option value=""><?= lang('Label.zoneChoose') ?></option>
            <?php foreach ($zone as $row) :
                foreach ($row as $item) { ?>
                    <option value="<?php echo $item->zoneId; ?>"><?php echo $item->zoneLabel; ?></option>
                <?php } endforeach; ?>
        </select>
    </div>
    <!-- Buttons -->
    <div class="container mt-3 d-flex justify-content-center">
        <button type="submit" class="btn btn-success mx-1">Enregistrer</button>
        <button type="reset" class="btn btn-outline-danger mx-1" data-bs-dismiss="modal">Annuler</button>
    </div>
</form>