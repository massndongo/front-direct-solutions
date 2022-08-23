<div class="col-12">
    <div class="container">
        <?php if (isset($termEdit)) { ?>
            <h2 class="text-center my-2"><?= lang('Label.term_form_edit') ?></h2>
        <?php } else { ?>
            <h2 class="text-center my-2"><?= lang('Label.term_form_add') ?></h2>
        <?php } ?>
    </div>
    <?php
    if (isset($termEdit)) : ?>
        <input type="hidden" name="termId" value="<?= $termEdit['termId'] ?>">
    <?php
    endif;
    ?>
    <div class="card-body">
        <div class="row mb-4">
            <!--Libelle-->
            <div class="mb-3">
                <label for="termLibelle" class="col-8 form-label"><?= lang('Label.label') ?></label>
                <input type="text" required class="form-control" name="termLibelle" id="termLibelle" value="<?= isset($termEdit) ? $termEdit['termLibelle'] : set_value('termLibelle') ?>">
            </div>
            <!-- Latitude -->
            <div class="mb-3">
                <label for="termLng" class="col-8 form-label"><?= lang('Label.lng') ?></label>
                <input type="text" required class="form-control" name="termLng" id="termLng" value="<?= isset($termEdit) ? $termEdit['termLng'] : set_value('termLng') ?>">
            </div>
            <!-- Longitude -->
            <div class="mb-3">
                <label for="termLat" class="col-8 form-label"><?= lang('Label.lat') ?></label>
                <input type="text" required class="form-control" name="termLat" id="termLat" value="<?= isset($termEdit) ? $termEdit['termLat'] : set_value('termLat') ?>">
            </div>
        </div>
    </div>
</div>