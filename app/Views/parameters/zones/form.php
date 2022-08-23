<div class="col-12">
    <div class="container">
        <?php if (isset($zone)) { ?>
            <h2 class="text-center my-2"><?= lang('Label.zone_form_edit') ?></h2>
        <?php } else { ?>
            <h2 class="text-center my-2"><?= lang('Label.zone_form_add') ?></h2>
        <?php } ?>
    </div>
    <?php
    if (isset($zone)) : ?>
        <input type="hidden" name="zoneId" value="<?= $zone->zoneId ?>">
    <?php
    endif;
    ?>
    <div class="card-body">
        <div class="row mb-4">
            <!--Libelle-->
            <div class="mb-3">
                <label for="zoneLabel" class="col-8 form-label"><?= lang('Label.label') ?></label>
                <input type="text" required class="form-control" name="zoneLabel" id="zoneLabel" value="<?= isset($zone) ? $zone->zoneLabel : set_value('zoneLabel') ?>">
            </div>

            <!-- Section Séléctionnées -->
            <?php if (isset($zone)) : ?>
                <div class="mb-3 container">
                    <div>
                        <label class="form-label <?= !isset($zone) ? 'text-center':''?>" for="zoneSection"><?= lang('Label.selectedSections')?></label><span class="mx-1 text-danger pull-right">*</span>
                    </div>
                    <?php if (isset($zone)) { foreach ($zone->zoneSection as $item) {?>
                        <input type="checkbox" class="checkbox-row" name="zoneSection[]" id="zoneSection" value="<?= $item->sectionId ?>" checked style="margin-left: 1.5%"> <?= $item->sectionLabel ?>
                    <?php } } ?>
                </div>
            <?php endif; ?>

            <!-- Sections -->
            <div class="mb-3 container">
                <label for="selectize-optgroup" class="form-label"><?= lang('Label.section')?></label>
                <select id="selectize-optgroup" name="zoneSections[]"  class="selectMultiple" multiple>
                    <option value=""><?= lang('Label.sectionChoose') ?></option>
                    <?php foreach ($section as $row) : ?>
                        <option value="<?php echo $row->sectionId; ?>"><?php echo $row->sectionLabel; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
<<<<<<< HEAD

            <!-- Début -->
            <div class="mb-3">
                <label for="zoneStart" class="col-8 form-label"><?= lang('Label.start') ?></label>
                <input type="text" required class="form-control" name="zoneStart" id="zoneStart" value="<?= isset($zone) ? $zone->zoneStart : set_value('zoneStart') ?>">
            </div>
            <!-- Fin -->
            <div class="mb-3">
                <label for="zoneEnd" class="col-8 form-label"><?= lang('Label.end') ?></label>
                <input type="text" required class="form-control" name="zoneEnd" id="zoneEnd" value="<?= isset($zone) ? $zone->zoneEnd : set_value('zoneEnd') ?>">
=======
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="row">
                        <label class="col-md-3 col-form-label <-?= !isset($zone) ? 'text-center':''?>" for="zoneStart"><-?= lang('Label.end')?></label><span class="col-md-1 text-danger pull-right">*</span>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="zoneEnd" name="zoneEnd" placeholder="<-?= lang('Holder.holder_end')?>" value="<-?= isset($zone) ? $zone->zoneEnd:set_value('zoneEnd')?>" >
                        </div>
                    </div>
                </div>
            </div-->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="row">
                        <label for="section"  class="col-md-3 col-form-label <?= !isset($zone) ? 'text-center':''?>"><?= lang('Label.section')?></label><span class="col-md-1 text-danger pull-right">*</span>
                        <div class="col-md-8">
                            <select id="section" name="zoneSection[]"  class="form-control select2-multiple" data-toggle="select2" data-width="100%" multiple="multiple" data-placeholder="<?= lang('Label.sectionChoose') ?>">
                                <!--option value=""><--?= lang('Label.sectionChoose') ?></option-->
                                <?php
                                    if(isset($section) && is_array($section) && count($section)>0):
                                        foreach ($section as $item) : ?>
                                            <option value="<?= $item->sectionId; ?>" <?= isset($zone) ? isSelected('sectionId',$zone->zoneSection,$item->sectionId):''?>><?= $item->sectionLabel; ?></option> <?php
                                        endforeach;
                                    endif;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
>>>>>>> 9a543ca0aca25fbe14554e1afbeb5839d4ce7ef1
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

<?= $this->include('themes/js')?>
=======
<script>
    $('[data-toggle="select2"]').select2({
        dropdownParent: $('#con-close-modal')
    });
</script>
>>>>>>> 9a543ca0aca25fbe14554e1afbeb5839d4ce7ef1
