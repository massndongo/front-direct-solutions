<?php
    $tabImages = ['SN_PM_OM'=>'orage.png','SN_PM_FREE_MONEY'=>'free.png','SN_PM_EMONEY'=>'emoney.png','SN_PM_WIZALL'=>'wizall.png','SN_PM_WAVE'=>'wave.jpg'];
?>
<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Aside.submenu_mass_init_payment') ?></h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <img src="<?= base_url()?>/assets/images/<?= $tabImages[$service_code]?>" style="width: 100px; height: 100px;">
                </div>
            </div>
            <input type="hidden" name="payment_method" value="<?= $service_code?>" />
            <div class="row mb-4">
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label text-center" for="lineLabel"><?= lang('Label.label_fichier')?></label><span class="col-md-1 text-danger pull-right">(*)</span>
                    <div class="col-md-8">
                        <input type="file" class="form-control" id="fichier" name="fichier">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>