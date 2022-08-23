<?php
$tabImages = ['SN_PM_OM'=>'orage.png','SN_PM_FREE_MONEY'=>'free.png','SN_PM_EMONEY'=>'emoney.png','SN_PM_WIZALL'=>'wizall.png','SN_PM_WAVE'=>'wave.jpg'];
?>
<input type="hidden" name="serviceCode" value="<?= $service_code?>" />
<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Aside.menu_push_payment_label') ?></h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <img src="<?= base_url()?>/assets/images/<?= $tabImages[$service_code]?>" style="width: 100px; height: 100px;">
                </div>
            </div>
            <div class="row mb-4">
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label text-left" for="amount"><?= lang('Label.amount')?></label><span class="col-md-1 text-danger pull-right">(*)</span>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="<?= lang('Label.holder_amount')?>">
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label text-left" for="customerPhoneNumber"><?= lang('Label.mobile_number')?></label><span class="col-md-1 text-danger pull-right">(*)</span>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="customerPhoneNumber" name="customerPhoneNumber" placeholder="<?= lang('Label.holder_mobile_number')?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>