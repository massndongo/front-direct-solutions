<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_profil_add_comment')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_profil_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_profil_add_comment')?></li>
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
                    <?= lang('Label.profil_add_title_comment')?>
                </i>
            </div>
            <form action="<?= site_url($action_url)?>" method="post" id="form-profile-managers">
                <input type="hidden" name="privileges" id="privileges" value="" />
                <?php
                    if(isset($profile)): ?>
                        <input type="hidden" name="profile_id" value="<?= $profile?>" />
                        <?php
                    endif;
                ?>
                <div class="card-body">
                    <div class="row" style="text-align: center">
                        <div class="clearfix"></div>
                        <div id="jsTreeMessage" class="col col-lg-12 col-md-12 mb-4"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label" for="label"><?= lang('Label.profile_name')?></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="label" name="profile_name"  value="<?= isset($profile_name) ? $profile_name:set_value('profile_name')?>" placeholder="<?= lang('Label.profile_name_holder')?>" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                                if(isset($nestableList) && is_array($nestableList) && count($nestableList)>0):
                                    foreach($nestableList as $key => $item): ?>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title"><?= $item['libelle']?></h4>
                                                </div>
                                                <div class="card-body">
                                                    <div id="<?= 'nestableItem_'.$key?>"></div>
                                                </div>
                                            </div>
                                        </div> <?php
                                    endforeach;
                                endif;
                            ?>
                        </div><!-- end col -->
                    </div> <!-- end row -->
                </div>
                <div class="card-footer">
                    <button class="btnGetCheckedItem btn btn-success waves-effect waves-light fa-pull-right" type="button"><i class="mdi mdi-check me-1"></i> <?= isset($profile) ? lang('Btn.btn_modify'):lang('Btn.btn_save')?></button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div> <!-- end card -->
        <?php
    $this->endSection();