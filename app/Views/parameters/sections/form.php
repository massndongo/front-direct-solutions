<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.section_form_title') ?></h4>
        </div>
        <?php


if (isset($sectionEdit)) : ?>
            <input type="hidden" name="sectionId" value="<?= $sectionEdit['sectionId'] ?>">
        <?php
        endif;
        ?>
        <div class="card-body">
            <div class="row mb-4">
                <div class="mb-3">
                    <label for="sectionLabel" class="col-8 form-label <?= !isset($sectionEdit) ? 'text-left' : '' ?>"><?= lang('Label.label') ?></label>
                    <input type="text" class="form-control" name="sectionLabel" id="sectionLabel" placeholder="<?= lang('Label.holder_section') ?>" value="<?= isset($sectionEdit) ? $sectionEdit['sectionLabel'] : set_value('sectionLabel') ?>">
                </div>
                <div class="mb-3">
                    <label for="sectionRateId" class="col-md-3 col-form-label <?= !isset($sectionEdit) ? 'text-left' : '' ?>"><?= lang('Label.pri') ?></label>

                    <select class="form-select" name="sectionRateId" id="sectionRateId">
                        <option label="<?= lang('Label.holder_choice') ?>"></option>
                        <?php
                            if(isset($rate) && is_array($rate) && count($rate)>0):
                                foreach ($rate as $item):  ?>
                                    <option value="<?= $item->rateId ?>" <?= isset($sectionEdit) && (int)$sectionEdit['sectionRateId']===(int)$item->rateId ? 'selected':''?>><?= $item->rateAmount ?></option><?php
                                endforeach;
                            endif;
                        ?>

                    </select>
                </div>
            </div>
        </div>
    </div>
</div>