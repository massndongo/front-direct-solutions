<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_session_list_comment')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_session_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_session_list_comment')?></li>
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
                            <form method="post" action="<?= site_url('activities/list-session')?>" >
                                <div class="row">
                                    <div class="col-md-2">
                                        <select class="form-control" id="ssStatut" name="ssStatut" data-toggle="select2" data-width="100%">
                                            <option label="<?= lang('Label.holder_statut')?>" <?= isset($ssStatut) && (int)$ssStatut==="" ? 'selected':''?>></option>
                                            <option value="0" <?= isset($ssStatut) && $ssStatut=="0" ? 'selected':''?>><?= lang('Values.0')?></option>
                                            <option value="1" <?= isset($ssStatut) && $ssStatut=="1" ? 'selected':''?>><?= lang('Values.1')?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="ssLineId" name="ssLineId" data-toggle="select2" data-width="100%">
                                            <option label="<?= lang('Label.holder_line')?>"></option>
                                            <?php
                                                if(isset($ligneList) && is_array($ligneList) && count($ligneList)>0):
                                                    foreach($ligneList as $item): ?>
                                                        <option value="<?= $item->lineId?>" <?= isset($ssLineId) && (int)$ssLineId===(int)$item->lineId ? 'selected':''?> ><?= lang('Label.ligne_numero',['number'=>$item->lineLabel])?></option> <?php
                                                    endforeach;
                                                endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control datePicker" id="ssStartDate" name="ssStartDate" placeholder="<?= lang('Label.holder_start_date')?>" value="<?= isset($ssStartDate) ? $ssStartDate:set_value('ssStartDate')?>" >
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control datePicker" id="ssEndDate" name="ssEndDate" placeholder="<?= lang('Label.holder_end_date')?>" value="<?= isset($ssEndDate) ? $ssEndDate:set_value('ssEndDate')?>" >
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
                            if(in_array(6002,session()->get('privileges'))): ?>
                                <span style="float: right" class="pull-right">
                                    <a class="modal-link-edit btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" title="<?= lang('Aside.submenu_session_add_comment')?>" href="<?= site_url('activities/define-session')?>" class="btn btn-outline-success" type="button"><?= lang('Aside.submenu_session_add_comment')?></a>
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
                                    <th><?= lang('Label.date')?></th>
                                    <th><?= lang('Label.details')?></th>
                                    <th><?= lang('Label.status')?></th>
                                    <th><?= lang('Label.option')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($liste) && is_array($liste) && count($liste)>0):
                                    $c=0; $i= (int)$paginate['page']>1 ? ($paginate['page']+1):1;
                                    foreach($liste as $item): ?>
                                        <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                            <th scope="row"><?= str_pad($i,strlen($paginate['total']),'0',STR_PAD_LEFT)?></th>
                                            <td>
                                                <?= date_en2fr($item->ssDateAt,3)?>
                                            </td>
                                            <td>
                                                <b><?= lang('Label.ligne_numero',['number'=>$item->ssLineLabel])?></b><br />
                                                <b><u><?= lang('Label.trajet')?>:</u></b>&nbsp;<?= $item->ssLineTrajet?><br />
                                                <b><u><?= lang('Label.bus')?>:</u></b>&nbsp;<?= !empty($item->ssBusLabel) && !is_null($item->ssBusLabel) ? $item->ssBusLabel.' ('.$item->ssBusMatricule.')':$item->ssBusMatricule?><br />
                                                <b><u><?= lang('Label.receveur')?>:</u></b>&nbsp;<?= $item->ssReceiptFirstName.' '.$item->ssReceiptLastName?><br />
                                                <b><u><?= lang('Label.chauffeur')?>:</u></b>&nbsp;<?= $item->ssDriverFirstName.' '.$item->ssDriverLastName?><br />
                                                <b><u><?= lang('Label.collecte_times')?>:</u></b>&nbsp;<?= $item->ssCollectionTime?><br />
                                                <b><u><?= lang('Label.qrcode')?>:</u></b>&nbsp;<?= lang('Values.'.$item->ssQrCodeStatus)?><br />
                                            </td>
                                            <td>
                                                <span class="label label-danger"><?= get_statut_session($item->ssStatut)?></span>
                                            </td>
                                            <td>
                                                <a class="modal-link-edit  btn btn-soft-danger float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('activities/edit-session/'.$item->ssId)?>"  ><i class="fe-edit-2 px-1" title="<?= lang('Btn.btn_edit')?>"></i> <?= lang('Btn.btn_edit')?></a>
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
