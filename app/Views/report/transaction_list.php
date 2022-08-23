<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?= lang("Aside.submenu_history_comment") ?></h4>
                <div>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item "><?= lang("Aside.submenu_history_comment") ?></li>
                        <li class="breadcrumb-item active"><?= lang("Aside.transaction") ?></li>
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
                    <form action="<?= site_url('payment/transaction-statement') ?>" method="post" class=form-horizontal">
                        <div class="row">
                        <div class="col-md-2">
                            <label for="statut" class="form-label"><?= lang('Label.status') ?></label>
                            <select id="statut" name="statut" class="form-select">
                                <option value=""><?= lang('Label.holder_choice') ?></option>
                                <option <?= (isset($statut) && $statut === 'INITIATED') ? 'selected':set_select('statut', 'INITIATED') ?> value="INITIATED"><?= lang('Label.initiated') ?></option>
                                <option <?= (isset($statut) && $statut === 'PENDING') ? 'selected':set_select('statut', 'PENDING') ?> value="PENDING"><?= lang('Label.pending') ?></option>
                                <option <?= (isset($statut) && $statut === 'FINISHED') ? 'selected':set_select('statut', 'FINISHED') ?> value="FINISHED"><?= lang('Label.finished') ?></option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="tag" class="form-label"><?= lang('Aside.operation') ?></label>
                            <select id="tag" name="tag" class="form-select">
                                <option value=""><?= lang('Label.holder_choice') ?></option>
                                <option <?= (isset($tag) && $tag === 'SUCCESS') ? 'selected':set_select('tag', 'SUCCESS') ?> value="SUCCESS"><?= lang('Label.success') ?></option>
                                <option <?= (isset($tag) && $tag === 'FAILED') ? 'selected':set_select('tag', 'FAILED') ?> value="FAILED"><?= lang('Label.failed_2') ?></option>
                            </select>
                        </div>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                     <?php if (isset($transaction) && !empty($transaction)){ ?>
                        <div class="dropdown float-end">
                            <a href="<?= site_url("report/transaction-report"); ?>" target="_blank" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Exporter en PDF">
                                <i class="mdi mdi-file-pdf"></i> PDF
                            </a>
                        </div>
                    <?php } ?>
                    <h4 class="header-title mb-3"><?= lang("Aside.transaction") ?></h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('Label.date')?></th>
                                <th><?= lang('Label.reference')?></th>
                                <th><?= lang('Label.mobile_number')?></th>
                                <th><?= lang('Label.code_service')?></th>
                                <th><?= lang('Label.amount')?></th>
                                <th><?= lang('Label.commission')?></th>
                                <th><?= lang('Label.status')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($transaction) && is_array($transaction) && count($transaction) > 0):
                                $i=0;
                                foreach($transaction as $item):
                                    $status = payment_status_2($item->status_trx);
                                    ?>
                                    <tr>
                                        <td><?= $i += 1; ?></td>
                                        <td><?= date_en2fr($item->date_trx, 3)?></td>
                                        <td><?= $item->related_id ?></td>
                                        <td><?= $item->beneficiaire_number ?></td>
                                        <td><?= payment_method($item->type_trx) ?></td>
                                        <td style="text-align: center;"><?= $item->amount_trx ?></td>
                                        <td style="text-align: center;"><?= $item->commission_trx ?></td>
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