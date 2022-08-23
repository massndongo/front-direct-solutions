<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.rate_form_title')?></h4>
        </div>
        <?php
            if(isset($rateEdit)): ?>
                <input type="hidden" name="rateId" value="<?= $rateEdit['rateId']?>" >
                <?php
            endif;
        ?>
        <div class="card-body">
            <div class="row mb-4">
                <div class="mb-3">
                    <label class="form-label <?= !isset($rateEdit) ? 'text-left':''?>" for="lineLabel"><?= lang('Aside.submenu_tarif_price')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <input type="text" class="form-control" id="rateAmount" name="rateAmount" data-parsley-type="integer" required data-parsley-type-message="<?= lang('Messages.form_message_error_price') ?>" data-parsley-required-message="<?= lang('Messages.form_message_required') ?>" placeholder="<?= lang('Label.holder_rate')?>" value="<?= isset($rateEdit) ? $rateEdit['rateAmount']:""?>" />
                </div>
            </div>
        </div>
    </div>
</div>