<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_etat_collecte_depense_comment')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_etat_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_etat_collecte_depense_comment')?></li>
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
                        <form method="post" action="<?= site_url('collection/show-expense-history')?>" >
                            <div class="col-12">
                                <div class="row  mb-3">
                                    <div class="col-md-3">
                                        <select class="form-control" id="expenseTypeId" name="expenseTypeId" data-toggle="select2" data-width="100%">
                                            <option  label="<?= lang('Holder.expense_choice')?>" ></option>
                                            <?php
                                            if(isset($typeList) && is_array($typeList) && count($typeList)>0):
                                                foreach($typeList as $item): ?>
                                                    <option value="<?= $item->typeExpenseId?>" <?= isset($expenseTypeId) && (int)$expenseTypeId===(int)$item->typeExpenseId ? 'selected':''?> ><?= $item->typeExpenseLibelle?></option>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="colTrajetId" name="expenseLineId" data-toggle="select2" data-width="100%">
                                            <option label="<?= lang('Label.holder_line')?>"></option>
                                            <?php
                                            if(isset($ligneList) && is_array($ligneList) && count($ligneList)>0):
                                                foreach($ligneList as $item): ?>
                                                    <option value="<?= $item->lineId?>" <?= isset($expenseLineId) && (int)$expenseLineId===(int)$item->lineId ? 'selected':''?> ><?= lang('Label.ligne_numero',['number'=>$item->lineLabel])?></option>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="collectVehicleId" name="expenseVehicleId" data-toggle="select2" data-width="100%">
                                            <option  label="<?= lang('Holder.vehicle_choice')?>" ></option>
                                            <?php
                                            if(isset($busList) && is_array($busList) && count($busList)>0):
                                                foreach($busList as $item): ?>
                                                    <option value="<?= $item->busId?>" <?= isset($expenseVehicleId) && (int)$expenseVehicleId===(int)$item->busId ? 'selected':''?> ><?= $item->busRegistrationNumber?></option>
                                                <?php endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="colAgentId" name="expenseReceiptId" data-toggle="select2" data-width="100%">
                                            <option  label="<?= lang('Holder.receiver_choice')?>" ></option>
                                            <?php
                                            if(isset($agentList) && is_array($agentList) && count($agentList)>0):
                                                foreach($agentList as $item): ?>
                                                    <option value="<?= $item->agentId?>" class="<?= $item->lineId?>" <?= isset($expenseReceiptId) && (int)$expenseReceiptId===(int)$item->agentId ? 'selected':''?> ><?= $item->agentFullName?></option>
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
                                        <input class="form-control datePicker" id="colStartDate" name="expenseStartDate" placeholder="<?= lang('Label.holder_start_date')?>" value="<?= isset($expenseStartDate) ? $expenseStartDate:set_value('expenseStartDate')?>" >
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control datePicker" id="colEndDate" name="expenseEndDate" placeholder="<?= lang('Label.holder_end_date')?>" value="<?= isset($expenseEndDate) ? $expenseEndDate:set_value('expenseEndDate')?>" >
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
                                <a target="_blank" title="<?= lang('Label.format_excel')?>" href="<?= site_url('rapports/collecte-expense-history/x')?>" ><i style="color:green" class="fas fa-2x fa-file-excel"></i> </a>
                                &nbsp;&nbsp;-&nbsp;&nbsp;
                                <a target="_blank" title="<?= lang('Label.format_pdf')?>" href="<?= site_url('rapports/collecte-expense-history/p')?>" ><i style="color:red" class="fa fa-2x fa-file-pdf"></i> </a>
                            </i>
                        </h4>
                        <hr />
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('Label.date')?></th>
                                    <th><?= lang('Label.expense')?></th>
                                    <th><?= lang('Label.details')?></th>
                                    <th><?= lang('Label.amount')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($liste) && is_array($liste) && count($liste)>0):
                                            $c=0; $i= (int)$paginate['page']>1 ? ($paginate['perPage']+$paginate['page'])-1:1;
                                            foreach($liste as $item): ?>
                                                <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                                    <td scope="row"><?= str_pad($i++,strlen($paginate['total']),'0',STR_PAD_LEFT)?></td>
                                                    <td><?= date_en2fr($item->expenseDate,3) ?></td>
                                                    <td>
                                                        <b><?= $item->expenseTypeLibelle?></b><br />
                                                        <u><?= lang('Label.reference')?>:</u>&nbsp;<?= $item->expenseReference?><br />
                                                        <u><?= lang('Label.pj')?>:</u>&nbsp;<?= !empty($item->expenseUrl) ? '<a href="'.base_url($item->expenseUrl).'" target="_blank">'.lang('label.show').'</a>':''?>
                                                    </td>
                                                    <td>
                                                        <b><?= lang('Label.ligne_numero',['number'=>$item->expenseLineNumber])?></b><br />
                                                        <u><?= lang('Label.registration_number')?>:</u>&nbsp;<?= $item->expenseVehicleRegistrationNumber?><br />
                                                        <u><?= lang('Label.receveur')?>:</u>&nbsp;<?= $item->expenseReceiver?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-outline-success fa-pull-right"> <?= number_format($item->expenseAmount,0,'',' ')?></span>
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
                                    <th colspan="4" ><?= lang('Label.total')?></th>
                                    <th> <span class="badge badge-outline-success fa-pull-right"> <?= number_format($totalAmount,0,'',' ')?></span> </th>
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
