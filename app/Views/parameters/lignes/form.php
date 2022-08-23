<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.ligne_form_title')?></h4>
        </div>
        <?php
            if(isset($lineData)): ?>
                <input type="hidden" name="lineId" value="<?= $lineData['lineId']?>" >
                <?php
            endif;
        ?>
        <div class="card-body">
            <div class="row mb-4">
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($lineData) ? 'text-center':''?>" for="lineLabel"><?= lang('Label.ligne')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <input type="number" class="form-control" id="lineLabel" name="lineLabel" placeholder="<?= lang('Label.holder_ligne')?>" value="<?= isset($lineData) ? $lineData['lineLabel']:set_value('lineLabel')?>" autocomplete="off" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($lineData) ? 'text-center':''?>" for="lineDescription"><?= lang('Label.description')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <textarea class="form-control" id="lineDescription" name="lineDescription" placeholder="<?= lang('Label.holder_description')?>" ><?= isset($lineData) ? $lineData['lineDescription']:set_value('lineDescription')?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($lineData) ? 'text-center':''?>" for="lineStart"><?= lang('Label.terminus_start')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <select class="form-control" id="lineStart" name="lineStart" data-toggle="select2" data-width="100%" autocomplete="off" required>
                            <option label="<?= lang('Label.holder_choice')?>"></option>
                            <?php
                            if(isset($terminusList) && is_array($terminusList) && count($terminusList)>0):
                                foreach($terminusList as $item): ?>
                                    <option value="<?= $item->termId?>" <?= isset($lineData) && (int)$lineData['lineStart']===(int)$item->termId ? 'selected':''?> ><?= $item->termLibelle?></option> <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($lineData) ? 'text-center':''?>" for="lineEnd"><?= lang('Label.terminus_end')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <select class="form-control" id="lineEnd" name="lineEnd" data-toggle="select2" data-width="100%" autocomplete="off" required>
                            <option label="<?= lang('Label.holder_choice')?>"></option>
                            <?php
                            if(isset($terminusList) && is_array($terminusList) && count($terminusList)>0):
                                foreach($terminusList as $item): ?>
                                    <option value="<?= $item->termId?>" <?= isset($lineData) && (int)$lineData['lineEnd']===(int)$item->termId ? 'selected':''?> ><?= $item->termLibelle?></option> <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($lineData) ? 'text-center':''?>" for="lineEnd"><?= lang('Label.zones')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <select class="selectMultipleIn" id="lineZone" name="lineZone[]" data-toggle="select2" data-width="100%" autocomplete="off" multiple required>
                            <option label="<?= lang('Label.holder_choice')?>"></option>
                            <?php
                            if(isset($zoneList) && is_array($zoneList) && count($zoneList)>0):
                                foreach($zoneList as $item): ?>
                                    <option value="<?= $item->zoneId?>" <?= isset($lineData) ? isSelected('zoneId',$lineData['lineZone'],$item->zoneId):''?> ><?= $item->zoneLabel?></option> <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".selectMultipleIn").select2({
        dropdownParent: $('#con-close-modal')
    });
</script>