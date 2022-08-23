<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_profil_list_label')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_personnel_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_profil_list_label')?></li>
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
                        <form method="post" action="<?= site_url('agents/agent-list')?>" >
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" id="type" name="agentType" data-toggle="select2" data-width="100%">
                                        <option label="<?= lang('Label.holder_type')?>"></option>
                                        <?php
                                            foreach(agentMerchantType($agentPartnerType) as $key => $val): ?>
                                                <option value="<?= $key?>" <?= isset($type) && $type===$key ? 'selected':set_select('agentType',$key) ?>><?= $val?></option> <?php
                                            endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control datePicker" id="start_date" name="agentStartDate"  value="<?= isset($agentStartDate) ? $agentStartDate:set_value('agentStartDate')?>" placeholder="<?= lang('Label.holder_start_date')?>" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control datePicker" id="end_date" name="agentEndDate"  value="<?= isset($agentEndDate) ? $agentEndDate:set_value('agentEndDate')?>" placeholder="<?= lang('Label.holder_end_date')?>" >
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> </button>
                                </div>
                            </div>
                        </form>
                        </p>
                    </div>
                    <div class="card-body">
                        <h4 class="header-title"><?= lang('Label.title_liste')?></h4>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('Label.agent')?></th>
                                    <th><?= lang('Label.date_add')?></th>
                                    <th><?= lang('Label.type')?></th>
                                    <th><?= lang('Label.option')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($liste) && is_array($liste) && count($liste)>0):
                                    $c=0; $i= $paginate['page']>0 ? ($paginate['page']+1):1;
                                    foreach($liste as $item): ?>
                                    <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                        <th scope="row"><?= $i?></th>
                                        <td>
                                            <b><?= $item->last_name.' '.$item->first_name?></b><br />
                                            <b><u><?= lang('Label.mobile_number')?>:</u></b>&nbsp;<?= $item->phone_number?><br />
                                            <b><u><?= lang('Label.email')?>:</u></b>&nbsp;<?= $item->email?><br />
                                            <b><u><?= lang('Label.location')?>:</u></b>&nbsp;<?= $item->location?><br />
                                            <b><u><?= lang('Label.piece')?>:</u></b>&nbsp;<?= getPiece($item->identity_type).'/ '.$item->identity_number?>
                                        </td>
                                        <td>
                                            <?= date_en2fr($item->create_at,3)?>
                                        </td>
                                        <td>
                                            <?= getAgentMerchantType($agentPartnerType,$item->agent_type)?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('agents/agent-edit/'.$item->id)?>" class="btn  btn btn-soft-danger fa-pull-right m-1" ><i class="fe-edit-2 px-1" title="<?= lang('Btn.btn_edit')?>"></i> <?= lang('Btn.btn_edit')?></a>
                                            <?php
                                                if($item->agent_type==="R" || $item->agent_type==="C" ): ?>
                                                    <a data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('agents/agent-redit/'.$item->id)?>" class="modal-link-edit btn  btn btn-soft-success fa-pull-right m-1"  ><i class="fe-repeat px-1" title="<?= lang('Btn.btn_redit')?>"></i> <?= lang('Btn.btn_redit')?></a><?php
                                                endif;
                                            ?>
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
        <!-- end Row -->
        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= lang('Label.form_title_reinit_pass')?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-1">
                        <?= lang('Label.loading_waiting')?>
                    </div>
                </div>
            </div>
        </div><!-- /.modal --> <?php
    $this->endSection();
