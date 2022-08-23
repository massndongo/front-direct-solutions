<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_profil_compte_user_comment')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_profil_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_profil_compte_user_comment')?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <?= isset($message) && !empty($message) ? $message:''?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title"><?= lang('Label.title_search')?></h4>
                        <p class="sub-header font-13" >
                        <form method="post" action="<?= site_url('profiles/profile-compte-user')?>" >
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" id="type" name="type" data-toggle="select2" data-width="100%">
                                        <option label="<?= lang('Label.holder_type')?>"></option>
                                        <?php
                                        foreach(agentMerchantType($partnerType) as $key => $val): ?>
                                            <option value="<?= $key?>" <?= isset($type) && $type===$key ? 'selected':set_select('type',$key) ?>><?= $val?></option> <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="profile_id" name="profile_id" data-toggle="select2" data-width="100%">
                                        <option label="<?= lang('Label.holder_profil')?>"></option>
                                        <?php
                                        foreach($profilList as $item): ?>
                                            <option value="<?= $item->id?>" <?= isset($profile_id) && (int)$item->id===(int)$profile_id ? 'selected':set_select('profile_id',$item->id) ?>><?= $item->label?></option> <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> </button>
                                </div>
                            </div>
                        </form>
                        </p>
                    </div>
                    <div class="card-body">
                        <h4 class="header-title">
                            <?= lang('Label.title_liste')?>
                            <?php
                                if(in_array(5005,session()->get('options'))): ?>
                                    <span style="float: right" class="pull-right">
                                        <a class="modal-link-edit btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('profiles/profile-compte-user-add')?>" class="btn btn-outline-success" type="button"><?= lang('Aside.submenu_profil_compte_user_add_comment')?></a>
                                    </span> <?php
                                endif;
                            ?>
                        </h4>
                        <hr />
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('Label.type')?></th>
                                    <th><?= lang('Label.agent')?></th>
                                    <th><?= lang('Label.profile')?></th>
                                    <th><?= lang('Label.option')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(isset($liste) && is_array($liste) && count($liste)>0):
                                        $c=0; $i= (int)$paginate['page']>1 ? ($paginate['page']+1):1;
                                        foreach($liste as $item): ?>
                                            <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                                <th scope="row"><?= $i?></th>
                                                <td>
                                                    <?= getAgentMerchantType($partnerType,$item->agent_type)?>
                                                </td>
                                                <td>
                                                    <b><?= $item->last_name.' '.$item->first_name?></b><br />
                                                    <b><u><?= lang('Label.mobile_number')?>:</u></b>&nbsp;<?= $item->phone_number?><br />
                                                    <b><u><?= lang('Label.email')?>:</u></b>&nbsp;<?= $item->email?><br />
                                                    <b><u><?= lang('Label.location')?>:</u></b>&nbsp;<?= $item->location?><br />
                                                    <b><u><?= lang('Label.piece')?>:</u></b>&nbsp;<?= getPiece($item->identity_type).'/ '.$item->identity_number?>
                                                </td>
                                                <td>
                                                    <b><?= $item->profile_label?></b><br />
                                                    <b><u><?= lang('Label.username')?>:</u></b>&nbsp;<?= $item->username?><br />
                                                    <b><u><?= lang('Label.status')?>:</u></b>&nbsp;<?= (int)$item->status===1 ? lang('Values.active'):lang('Values.desactive')?><br />
                                                </td>
                                                <td>
                                                    <a class="modal-link-edit btn btn-soft-danger float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('profiles/profile-compte-user-edit/'.$item->userID)?>"><i class="fe-edit-2 px-1" title="<?= lang('Btn.btn_edit')?>"></i> <?= lang('Btn.btn_edit')?></a>
                                                </td>
                                            </tr><?php
                                            $c++; $i++;
                                        endforeach;
                                    endif;
                                ?>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                    <div class="card-footer">
                        <?= $pager->makeLinks($paginate['page'], $paginate['perPage'], $paginate['total'], $paginate['template'], 0, $paginate['group']);?>
                        <div class="clearfix"></div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end Row -->
        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= lang('Label.title_form')?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="form-con-close-modal">
                        <div class="modal-body p-1">
                            <?= lang('Label.loading_waiting')?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?= lang('Btn.btn_cancel')?></button>
                            <button type="submit" class="btn btn-info waves-effect waves-light"><?= lang('Btn.btn_save')?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->   <?php
    $this->endSection();
