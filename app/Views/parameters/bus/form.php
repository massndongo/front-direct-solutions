<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.bus_form_title')?></h4>
        </div>
        <?php
            if(isset($busData)): ?>
                <input type="hidden" name="busId" value="<?= $busData['busId']?>" >
                <?php
            endif;
        ?>
        <div class="card-body">
            <div class="row mb-4">
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($busData) ? 'text-center':''?>" for="lineLabel"><?= lang('Label.brand')?></label><span class="col-md-1 text-danger pull-right"></span>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="busBrand" name="busBrand" placeholder="<?= lang('Label.holder_brand')?>" value="<?= isset($busData) ? $busData['busBrand']:set_value('busBrand')?>" autocomplete="off" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($busData) ? 'text-center':''?>" for="lineLabel"><?= lang('Label.model')?></label><span class="col-md-1 text-danger pull-right"></span>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="busModel" name="busModel" placeholder="<?= lang('Label.holder_model')?>" value="<?= isset($busData) ? $busData['busModel']:set_value('busModel')?>" autocomplete="off" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($busData) ? 'text-center':''?>" for="lineLabel"><?= lang('Label.registration_number')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="busRegistrationNumber" name="busRegistrationNumber" placeholder="<?= lang('Label.holder_matricule')?>" value="<?= isset($busData) ? $busData['busRegistrationNumber']:set_value('busRegistrationNumber')?>" autocomplete="off" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($busData) ? 'text-center':''?>" for="lineLabel"><?= lang('Label.bus_color')?></label><span class="col-md-1 text-danger pull-right"></span>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="busColor" name="busColor" placeholder="<?= lang('Label.holder_couleur')?>" value="<?= isset($busData) ? $busData['busColor']:set_value('busColor')?>" autocomplete="off" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($busData) ? 'text-center':''?>" for="lineLabel"><?= lang('Label.number_of_places')?></label><span class="col-md-1 text-danger pull-right"></span>
                    <div class="col-md-8">
                        <select id="busPlace" name="busPlace"  class="form-select">
                            <option value="<?= isset($busdata) ? $busdata['busPlace']:set_value('busPlace')?>"><?= lang('Label.holder_places_number')?></option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="60">60</option>
                            <option value="60">80</option>
                            <option value="60">100</option>
                            <option value="60">120</option>
                        </select>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>