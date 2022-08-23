<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.session_form_title')?></h4>
        </div>
        <?php
            if(isset($tagSession)): ?>
                <input type="hidden" name="ssId" value="<?= $tagSession['ssId']?>">
                <?php
            endif;
        ?>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-md-3 col-form-label <?= !isset($tagSession) ? 'text-center':''?>" for="ssLineId"><?= lang('Label.ligne_label')?></label><span class="col-md-1 text-danger pull-right">*</span>
                <div class="col-md-8">
                    <select class="form-control" id="ssLineId" name="ssLineId" data-toggle="select2" data-width="100%" autocomplete="off" required>
                        <option label="<?= lang('Label.holder_choice')?>"></option>
                        <?php
                        if(isset($ligneList) && is_array($ligneList) && count($ligneList)>0):
                            foreach($ligneList as $item): ?>
                                <option value="<?= $item->lineId?>" <?= isset($tagSession) && (int)$tagSession['ssLineId']===(int)$item->lineId ? 'selected':''?> ><?= lang('Label.ligne_numero',['number'=>$item->lineLabel])?></option> <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-3 col-form-label <?= !isset($tagSession) ? 'text-center':''?>" for="ssBusId"><?= lang('Label.bus')?></label><span class="col-md-1 text-danger pull-right">*</span>
                <div class="col-md-8">
                    <select class="form-control" id="ssBusId" name="ssBusId" data-toggle="select2" data-width="100%" autocomplete="off" required>
                        <option label="<?= lang('Label.holder_choice')?>"></option>
                        <?php
                        if(isset($busList) && is_array($busList) && count($busList)>0):
                            foreach($busList as $item): ?>
                                <option value="<?= $item->busId?>" <?= isset($tagSession) && (int)$tagSession['ssBusId']===(int)$item->busId ? 'selected':''?> ><?= $item->busRegistrationNumber.' ('.$item->busLabel.')'?></option> <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-3 col-form-label <?= !isset($tagSession) ? 'text-center':''?>" for="ssDriverId"><?= lang('Label.chauffeur')?></label><span class="col-md-1 text-danger pull-right">*</span>
                <div class="col-md-8">
                    <select class="form-control" id="ssDriverId" name="ssDriverId" data-toggle="select2" data-width="100%" autocomplete="off" required>
                        <option label="<?= lang('Label.holder_choice')?>"></option>
                        <?php
                        if(isset($driverList) && is_array($driverList) && count($driverList)>0):
                            foreach($driverList as $item): ?>
                                <option value="<?= $item->id?>" <?= isset($tagSession) && (int)$tagSession['ssDriverId']===(int)$item->id ? 'selected':''?> ><?= $item->first_name.' '.$item->last_name?></option> <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-3 col-form-label <?= !isset($tagSession) ? 'text-center':''?>" for="ssReceiptId"><?= lang('Label.receveur')?></label><span class="col-md-1 text-danger pull-right">*</span>
                <div class="col-md-8">
                    <select class="form-control" id="ssReceiptId" name="ssReceiptId" data-toggle="select2" data-width="100%" autocomplete="off" required>
                        <option label="<?= lang('Label.holder_choice')?>"></option>
                        <?php
                        if(isset($receiptList) && is_array($receiptList) && count($receiptList)>0):
                            foreach($receiptList as $item): ?>
                                <option value="<?= $item->id?>" <?= isset($tagSession) && (int)$tagSession['ssReceiptId']===(int)$item->id ? 'selected':''?> ><?= $item->first_name.' '.$item->last_name?></option> <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-3 col-form-label <?= !isset($tagSession) ? 'text-center':''?>" for="ssQrCodeStatus"><?= lang('Label.qrcode')?></label><span class="col-md-1 text-danger pull-right">*</span>
                <div class="col-md-8">
                    <select class="form-control" id="ssQrCodeStatus" name="ssQrCodeStatus" data-toggle="select2" data-width="100%" autocomplete="off" required>
                        <option label="<?= lang('Label.holder_choice')?>"></option>
                        <option value="I" <?= isset($tagSession) && $tagSession['ssQrCodeStatus']==='I' ? 'selected':set_select('ssQrCodeStatus','I',true)?> ><?= lang('Values.I')?></option>
                        <option value="A" <?= isset($tagSession) && $tagSession['ssQrCodeStatus']==='A' ? 'selected':''?> ><?= lang('Values.A')?></option>
                    </select>
                </div>
            </div>
            <?php
                if(isset($tagSession)): ?>
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label <?= !isset($tagSession) ? 'text-center':''?>" for="ssStatut"><?= lang('Label.status')?></label><span class="col-md-1 text-danger pull-right">&nbsp;</span>
                        <div class="col-md-8">
                            <select class="form-control" id="ssStatut" name="ssStatut" data-toggle="select2" data-width="100%" autocomplete="off">
                                <option label="<?= lang('Label.holder_choice')?>"></option>
                                <option value="1" <?= isset($tagSession) && (int)$tagSession['ssStatut']===1 ? 'selected':''?>><?= lang('Values.1')?></option>
                                <option value="0" <?= isset($tagSession) && (int)$tagSession['ssStatut']===0 ? 'selected':''?>><?= lang('Values.0')?></option>
                            </select>
                        </div>
                    </div> <?php
                endif;
            ?>
            <div class="row mb-3">
                <label class="col-md-3 col-form-label <?= !isset($tagSession) ? 'text-center':''?>" for="ssReceiptId"><?= lang('Label.collecte_time')?></label><span class="col-md-1 text-danger pull-right">*</span>
                <div class="col-md-8">
                    <div  class="input-group hourPicker" data-placement="top" data-align="top" data-autoclose="true">
                        <input class="form-control" id="ssCollectionTime" name="ssCollectionTime" value="<?= isset($tagSession) ? $tagSession['ssCollectionTime']:set_value('ssCollectionTime')?>" autocomplete="off" required >
                        <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(".hourPicker").clockpicker({
        donetext:"Done"
    });
</script>