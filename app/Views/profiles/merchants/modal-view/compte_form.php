<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.profile_form_title')?></h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <?php
                    if(isset($linkUser)): ?>
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="row  mb-3">
                                    <label class="col-md-3 col-form-label" for="statut" ><?= lang('Label.status')?></label><span class="col-md-1 text-danger pull-right">*</span>
                                    <div class="col-md-8">
                                        <select class="form-control" id="statut" name="status" data-toggle="select2" data-width="100%">
                                            <option value="1" <?= isset($linkUser) && (int)$linkUser['status']===1 ? 'selected':set_select('status',1)?> ><?= lang('Values.active')?></option>
                                            <option value="0" <?= isset($linkUser) && (int)$linkUser['status']===0 ? 'selected':set_select('status',0)?> ><?= lang('Values.desactive')?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> <?php
                    endif;
                ?>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($linkUser) ? 'text-center':''?>" for="profile_id"><?= lang('Label.profile')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <select class="form-control" id="profile_id" name="profile_id" data-toggle="select2" data-width="100%" autocomplete="off" required>
                            <option label="<?= lang('Label.holder_choice')?>"></option>
                            <?php
                            if(isset($profilList) && is_array($profilList) && count($profilList)>0):
                                foreach($profilList as $item): ?>
                                    <option value="<?= $item->id?>" <?= isset($linkUser) && (int)$linkUser['profile_id']===(int)$item->id ? 'selected':''?> ><?= $item->label?></option> <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label <?= !isset($linkUser) ? 'text-center':''?>" for="profile_id"><?= lang('Label.agent')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <div class="col-md-8">
                        <select class="form-control" id="agent_id" name="agent_id" data-toggle="select2" data-width="100%" autocomplete="off" required>
                            <option label="<?= lang('Label.holder_choice')?>"></option>
                            <?php
                            if(isset($userList) && is_array($userList) && count($userList)>0):
                                foreach($userList as $item):
                                    if($item->agent_type!='S')
                                        continue;?>
                                    <option value="<?= $item->id.'_'.$item->email?>" <?= isset($linkUser) && (int)$linkUser['agent_id']===(int)$item->id ? 'selected':''?> ><?= $item->first_name.' '.$item->last_name?></option> <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <?php
                    if(isset($linkUser)): ?>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="change_pwd"><?= lang('Label.change_pwd')?></label><span class="col-md-1 text-danger pull-right">*</span>
                            <div class="col-md-8">
                                <select class="form-control" id="change_pwd" name="change_pwd" data-toggle="select2" data-width="100%" autocomplete="off" >
                                    <option label="<?= lang('label.holder_choice')?>"></option>
                                    <option value="yes" ><?= lang('Values.yes')?></option>
                                    <option value="no" selected><?= lang('Values.no')?></option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $linkUser['id']?>" > <?php
                    endif;
                ?>
            </div>
        </div>
    </div>
</div>