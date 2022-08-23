<?=
$this->extend('themes/themeforest');
$this->section('content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?= lang('Aside.menu_profile')?></h4>
                <div>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><?= lang('Aside.menu_profile')?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
        <?= isset($message) && !empty($message) ? $message:''?>
    <div class="card">
        <div class="card-header">
            <h4 class="header-title"><?= lang('Label.title_form')?></h4>
            <i class="sub-header font-13">
                <?= lang('Label.my_profile_title_comment')?>
            </i>
        </div>
        <form action="<?= site_url('my-profile')?>" method="post" >
            <input type="hidden" name="userId" value="<?= $userData->id?>" />
            <input type="hidden" name="userName" value="<?= $userData->username?>" />
            <input type="hidden" name="agentId" value="<?= $userData->agent_id?>" />
            <input type="hidden" name="userType" value="<?= $userData->user_type?>" />
            <input type="hidden" name="partnerType" value="<?= $userData->partner_type?>" />
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="firstName"><?= lang('Label.first_name')?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="firstName" name="firstName"  value="<?= $userData->first_name?>" placeholder="<?= lang('Label.holder_first_name')?>" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="lastName"><?= lang('Label.last_name')?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="lastName" name="lastName"  value="<?= $userData->last_name?>" placeholder="<?= lang('Label.holder_last_name')?>" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="phone"><?= lang('Label.mobile_number')?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="phone" name="phone"  value="<?= $userData->phone?>" placeholder="<?= lang('Label.holder_mobile_number')?>" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="address"><?= lang('Label.location')?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="address" name="address"  value="<?= $userData->address?>" placeholder="<?= lang('Label.holder_location')?>" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="identity"><?= lang('Label.piece')?></label>
                            <div class="col-md-8">
                                <select name="identity" id="identity" class="form-control"  data-toggle="select2" data-width="100%">
                                    <option label="<?= lang('Label.holder_choice')?>"></option>
                                    <?php
                                        if(isset($identities) && is_array($identities) && count($identities)>0):
                                            foreach($identities as $item): ?>
                                                <option value="<?= $item->id?>" <?= $userData->identity===$item->id ? 'selected':set_select('identity',$item->id) ?>><?= lang('Values.'.$item->libelle)?></option> <?php
                                            endforeach;
                                        endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="identity_number"><?= lang('Label.piece_number')?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="identity_number" name="identity_number"  value="<?= $userData->identity_number?>" placeholder="<?= lang('Label.holder_piece_number')?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label" for="email"><?= lang('Label.email')?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="email" name="email"  value="<?= $userData->email?>" placeholder="<?= lang('Label.holder_email')?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="header-title"><?= lang('Label.profile_title_form')?></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label" for="label_profile"><?= lang('Label.profile')?></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="label_profile" value="<?= $userData->profile_label?>" placeholder="<?= lang('Label.holder_profile')?>" autocomplete="off" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <label class="col-md-4 col-form-label" for="username"><?= lang('Label.username')?></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="username" value="<?= $userData->username?>" placeholder="<?= lang('Label.holder_username')?>" autocomplete="off" disabled>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="header-title"><?= lang('Label.password')?></h6>
                                <p class="sub-header font-13"><?= lang('Label.change_my_password')?></p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row mb-3">
                                            <label class="col-md-12 col-form-label" for="oldPassword"><?= lang('Label.old_password')?></label>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" id="oldPassword" name="oldPassword"  placeholder="<?= lang('Label.holder_old_password')?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row mb-3">
                                            <label class="col-md-12 col-form-label" for="newPassword"><?= lang('Label.new_password')?></label>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="<?= lang('Label.holder_new_password')?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row mb-3">
                                            <label class="col-md-12 col-form-label" for="confPassword"><?= lang('Label.conf_password')?></label>
                                            <div class="col-md-12">
                                                <input type="password" class="form-control" id="confPassword"  name="confPassword" placeholder="<?= lang('Label.holder_conf_password')?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success waves-effect waves-light fa-pull-right" type="submit"><i class="mdi mdi-check me-1"></i> <?= lang('Btn.btn_modify')?></button>
                <div class="clearfix"></div>
            </div>
        </form>
    </div> <!-- end card -->
<?php
$this->endSection();