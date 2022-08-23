<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= $titlePage?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_personnel_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= $titlePage?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title --> <?= isset($message) && !empty($message) ? $message:''?>
        <div class="card">
            <div class="card-header">
                <h4 class="header-title"><?= lang('Label.title_form')?></h4>
                <i class="sub-header font-13">
                    <?= $subTitlePage?>
                </i>
            </div>
            <form action="<?= site_url($action_url)?>" method="post">
                <?php
                    if(isset($agent)): ?>
                        <input type="hidden" name="id" value="<?= $agent['id']?>" /> <?php
                    endif;
                ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="first_name"><?= lang('Label.first_name')?></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="first_name" name="first_name"  value="<?= isset($agent) ? $agent['first_name']:set_value('first_name')?>" placeholder="<?= lang('Label.holder_first_name')?>" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="last_name"><?= lang('Label.last_name')?></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="last_name" name="last_name"  value="<?= isset($agent) ? $agent['last_name']:set_value('last_name')?>" placeholder="<?= lang('Label.holder_last_name')?>" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="phone_number"><?= lang('Label.mobile_number')?></label>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><?= get_global_value('indicatif')?></span>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"  value="<?= isset($agent) ? (substr($agent['phone_number'],0,3)===get_global_value('indicatif') ? substr($agent['phone_number'],strlen(get_global_value('indicatif'))):$agent['phone_number']):set_value('phone_number')?>" placeholder="<?= lang('Label.holder_mobile_number')?>" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="email"><?= lang('Label.email')?></label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" id="email" name="email"  value="<?= isset($agent) ? $agent['email']:set_value('email')?>" placeholder="<?= lang('Label.holder_email')?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="location"><?= lang('Label.location')?></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="location" name="location"  value="<?= isset($agent) ? $agent['location']:set_value('location')?>" placeholder="<?= lang('Label.holder_location')?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="agent_type"><?= lang('Label.type')?></label>
                                <div class="col-md-12">
                                    <select name="agent_type" id="agent_type" class="form-control"  data-toggle="select2" data-width="100%">
                                        <option label="<?= lang('Label.holder_choice')?>"></option>
                                        <?php
                                            foreach(agentMerchantType($partnerType) as $key => $val): ?>
                                                <option value="<?= $key?>" <?= isset($agent) && $agent['agent_type']===$key ? 'selected':set_select('agent_type',$key) ?>><?= $val?></option> <?php
                                            endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="identity_type"><?= lang('Label.piece')?></label>
                                <div class="col-md-12">
                                    <select name="identity_type" id="identity_type" class="form-control"  data-toggle="select2" data-width="100%">
                                        <option label="<?= lang('Label.holder_choice')?>"></option>
                                        <?php
                                            if(isset($identities) && is_array($identities) && count($identities)>0):
                                                foreach($identities as $item): ?>
                                                    <option value="<?= $item->id?>" <?= isset($agent) && $agent['identity_type']===$item->id ? 'selected':set_select('identity_type',$item->id) ?>><?= lang('Values.'.$item->libelle)?></option> <?php
                                                endforeach;
                                            endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="identity_number"><?= lang('Label.piece_number')?></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="identity_number" name="identity_number"  value="<?= isset($agent) ? $agent['identity_number']:set_value('identity_number')?>" placeholder="<?= lang('Label.holder_piece_number')?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <?php
                        if(isset($agent)):
                            if(in_array(4003,session()->get('options'))):?>
                                <button class="btn btn-success waves-effect waves-light fa-pull-right" type="submit"><i class="mdi mdi-check me-1"></i> <?= lang('Btn.btn_save')?></button> <?php
                            endif;
                        else: ?>
                            <button class="btn btn-success waves-effect waves-light fa-pull-right" type="submit"><i class="mdi mdi-check me-1"></i> <?= lang('Btn.btn_save')?></button> <?php
                        endif;
                    ?>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <?php
    $this->endSection();