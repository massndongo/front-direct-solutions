<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?= lang("Aside.submenu_history_comment") ?></h4>
                <div>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item "><?= lang("Aside.submenu_history_comment") ?></li>
                        <li class="breadcrumb-item active"><?= lang("Aside.operation") ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= isset($message) ? $message : '' ?>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"><?= lang('Btn.btn_search') ?></h4>
                    <hr/>
                    <form action="<?= site_url('payment/operation-statement') ?>" method="post" class=form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="start" class="form-label"><?= lang('Label.start_date') ?><span class="text-danger">*</span></label>
                                <input type="text" name="start" required class="form-control datePicker" readonly id="start" value="<?= ($start) ?  : set_value('start') ?>" />
                            </div>
                            <div class="col-md-3">
                                <label for="end" class="form-label"><?= lang('Label.end_date') ?><span class="text-danger">*</span></label>
                                <input id="end" type="text" name="end" required class="form-control datePicker" value="<?= ($end) ?  : set_value('end') ?>" />
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary waves-effect waves-light mt-3" type="submit"><i class="fa fa-search"></i> <?= lang('Btn.btn_search') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($operation) && !empty($operation)){ ?>
                        <div class="dropdown float-end">
                            <a href="<?= site_url("report/operation-report"); ?>" target="_blank" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Exporter en PDF">
                                <i class="mdi mdi-file-pdf"></i> PDF
                            </a>
                        </div>
                    <?php } ?>
                    <h4 class="header-title mb-3"><?= lang("Aside.operation") ?></h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('Label.date')?></th>
                                <th><?= lang('Label.reference')?></th>
                                <th><?= lang('Aside.operation')?></th>
                                <th><?= lang('Label.initial_balance')?></th>
                                <th><?= lang('Label.amount')?></th>
                                <th><?= lang('Label.final_balance')?></th>
                                <th><?= lang('Label.status')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($operation) && is_array($operation) && !empty($operation)):
                                $i=0;
                                foreach($operation as $item):
                                    $status = payment_status_2($item->status_trx);
                                    ?>
                                    <tr>
                                    <td><?= $i += 1; ?></td>
                                    <td><?= date_en2fr($item->date_trx, 3)?></td>
                                    <td><?= $item->related_trx ?></td>
                                    <td><?= $item->type_trx ?></td>
                                    <td style="text-align: center;"><?= $item->solde_initial ?></td>
                                    <td style="text-align: center;"><?= $item->amount_trx ?></td>
                                    <td style="text-align: center;"><?= $item->solde_finial ?></td>
                                    <td>
                                        <span class="badge text-<?= $status ?> border border-<?= $status ?> btn-xs"><?= $item->status_trx; ?></span>
                                    </td>
                                    </tr><?php
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div> <!-- end table responsive-->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
<?php
$this->endSection();