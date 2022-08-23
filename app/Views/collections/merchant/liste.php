<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_etat_collecte_ticket_comment')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_etat_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_etat_collecte_ticket_comment')?></li>
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
                        <form method="post" action="<?= site_url('collection/show-history')?>" >
                            <div class="col-12">
                                <div class="row  mb-3">
                                    <div class="col-md-3">
                                        <select class="form-control" id="colTrajetId" name="collectLineId" data-toggle="select2" data-width="100%">
                                            <option label="<?= lang('Label.holder_line')?>"></option>
                                            <?php
                                            if(isset($ligneList) && is_array($ligneList) && count($ligneList)>0):
                                                foreach($ligneList as $item): ?>
                                                    <option value="<?= $item->lineId?>" <?= isset($collectLineId) && (int)$collectLineId===(int)$item->lineId ? 'selected':''?> ><?= lang('Label.ligne_numero',['number'=>$item->lineLabel])?></option>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="collectZoneId" name="collectZoneId" data-toggle="select2" data-width="100%">
                                            <option  label="<?= lang('Holder.zone_choice')?>" ></option>
                                            <?php
                                            if(isset($zoneList) && is_array($zoneList) && count($zoneList)>0):
                                                foreach($zoneList as $item): ?>
                                                    <option value="<?= $item->zoneId?>" <?= isset($collectZoneId) && (int)$collectZoneId===(int)$item->zoneId ? 'selected':''?> ><?= $item->zoneLabel?></option>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="collectSectionId" name="collectSectionId" data-toggle="select2" data-width="100%">
                                            <option  label="<?= lang('Holder.section_choice')?>" ></option>
                                            <?php
                                            if(isset($sectionList) && is_array($sectionList) && count($sectionList)>0):
                                                foreach($sectionList as $item): ?>
                                                    <option value="<?= $item->sectionId?>" <?= isset($collectSectionId) && (int)$collectSectionId===(int)$item->sectionId ? 'selected':''?> ><?= $item->sectionLabel?></option>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="colAgentId" name="collectReceiptId" data-toggle="select2" data-width="100%">
                                            <option  label="<?= lang('Holder.receiver_choice')?>" ></option>
                                            <?php
                                            if(isset($agentList) && is_array($agentList) && count($agentList)>0):
                                                foreach($agentList as $item): ?>
                                                    <option value="<?= $item->agentId?>" class="<?= $item->lineId?>" <?= isset($collectReceiptId) && (int)$collectReceiptId===(int)$item->agentId ? 'selected':''?> ><?= $item->agentFullName?></option>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row  mb-3">
                                    <div class="col-md-3">
                                        <input class="form-control datePicker" id="colStartDate" name="collectStartDate" placeholder="<?= lang('Label.holder_start_date')?>" value="<?= isset($collectStartDate) ? $collectStartDate:set_value('collectStartDate')?>" >
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control datePicker" id="colEndDate" name="collectEndDate" placeholder="<?= lang('Label.holder_end_date')?>" value="<?= isset($collectEndDate) ? $collectEndDate:set_value('collectEndDate')?>" >
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> <?= lang('Btn.btnFilter')?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </p>
                    </div>
                    <div class="card-body">
                        <h4 class="header-title">
                            <?= lang('Label.title_liste')?>
                            <i class="sub-header font-13 float-end" >
                                <a target="_blank" title="<?= lang('Label.format_excel')?>" href="<?= site_url('rapports/collecte-history/x')?>" ><i style="color:green" class="fa fa-2x fa-file-excel"></i> </a>
                                &nbsp;&nbsp;-&nbsp;&nbsp;
                                <a target="_blank" title="<?= lang('Label.format_pdf')?>" href="<?= site_url('rapports/collecte-history/p')?>" ><i style="color:red" class="fa fa-2x fa-file-pdf"></i> </a>
                            </i>
                        </h4>
                        <hr />
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('Label.date')?></th>
                                    <th><?= lang('Label.details')?></th>
                                    <th><?= lang('Label.ticket')?></th>
                                    <th><?= lang('Label.qte')?></th>
                                    <th><?= lang('Label.total')?></th>
                                    <th><?= lang('Label.option')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($liste) && is_array($liste) && count($liste)>0):
                                            $c=0; $i= (int)$paginate['page']>1 ? ($paginate['perPage']+$paginate['page'])-1:1;
                                            foreach($liste as $item): ?>
                                                <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                                    <td scope="row"><?= str_pad($i++,strlen($paginate['total']),'0',STR_PAD_LEFT)?></td>
                                                    <td><?= date_en2fr($item->collectDate,3) ?></td>
                                                    <td>
                                                        <b><?= lang('Label.ligne_numero',['number'=>$item->collectLigneSession])?></b><br />
                                                        <u><?= lang('Label.trajet')?>:</u>&nbsp;<?= $item->collectLineLabelSession?><br />
                                                        <u><?= lang('Label.registration_number')?>:</u>&nbsp;<?= $item->collectVehicleSession?><br />
                                                        <u><?= lang('Label.receveur')?>:</u>&nbsp;<?= $item->collectReceiptSession?>
                                                    </td>
                                                    <td>
                                                        <b><?= $item->collectZoneLabel?></b><br />
                                                        <u><?= lang('Label.section')?>:</u>&nbsp;<?= $item->collectSectionLabel?><br />
                                                        <u><?= lang('Label.prix')?>:</u>&nbsp;<?= number_format(($item->collectTotal/$item->collectQte),0,'',' ')?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-outline-danger"> <?= number_format($item->collectQte,0,'',' ')?></span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-outline-success"> <?= number_format($item->collectTotal,0,'',' ')?></span>
                                                    </td>
                                                    <td>
                                                        <a class="modal-link-edit btn btn-soft-danger fa-pull-right"  data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('collection/show-details-history/'.$item->collectHistoryId)?>"><i class="fa fa-desktop" title="<?= lang('Btn.btn_details')?>"></i> <?= lang('Btn.btn_details')?></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $c++;
                                            endforeach;
                                        endif;
                                    ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="5" ><?= lang('Label.total')?></th>
                                    <th> <span class="badge badge-outline-success"> <?= number_format($totalAmount,0,'',' ')?></span> </th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                    <div class="card-footer">
                        <?= isset($pager) ? $pager->makeLinks($paginate['page'], $paginate['perPage'], $paginate['total'], $paginate['template'], 0, $paginate['group']):'';?>
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
                        <h4 class="modal-title"><?= lang('Label.details')?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="form-con-close-modal">
                        <div class="modal-body p-1">
                            <?= lang('Label.loading_waiting')?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?= lang('Btn.btn_close')?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal -->   <?php
    $this->endSection();
