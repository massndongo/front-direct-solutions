<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?= lang("Aside.menu_dashboard") ?></h4>
                <div>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><?= lang("Aside.menu_dashboard") ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card bg-purple shadow-none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-light">
                                <i class="fe-bar-chart-line- font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h2 class="text-white mt-2"><span data-plugin="counterup"><?= ($total_received) ?? 0 ?></span></h2>
                                <p class="text-white mb-0 text-truncate"><?= lang('Label.total'); ?></p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card bg-info shadow-none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-light">
                                <i class="mdi mdi-check-circle font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h2 class="text-white mt-2"><span data-plugin="counterup"><?= ($total_succeed) ?? 0 ?></span></h2>
                                <p class="text-white mb-0 text-truncate"><?= lang('Label.success'); ?></p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card bg-pink shadow-none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-light">
                                <i class="mdi mdi-progress-close font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h2 class="text-white mt-2"><span data-plugin="counterup"><?= ($total_failed) ?? 0 ?></span></h2>
                                <p class="text-white mb-0 text-truncate"><?= lang('Label.failed_2') ?></p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card bg-success shadow-none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-soft-light">
                                <i class="mdi mdi-cash-refund font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h2 class="text-white mt-2"><span data-plugin="counterup"><?= ($compensation_amount) ?? 0 ?></span></h2>
                                <p class="text-white mb-0 text-truncate"><?= lang('Label.compensate') ?></p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3"><?= lang("Label.recent_trx") ?></h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('Label.date'); ?></th>
                                <th><?= lang('Label.mobile_number') ?></th>
                                <th><?= lang('Label.full_name'); ?></th>
                                <th><?= lang('Label.amount'); ?></th>
                                <th><?= lang('Label.commission') ?></th>
                                <th><?= lang('Label.status'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($pay_list) && is_array($pay_list) && count($pay_list) > 0):
                                    $c=$i=0;
                                foreach($pay_list as $item):
                                    if ($c < 10){
                                        $status = explode("-", payment_status($item->status));
                                    ?>
                                        <tr>
                                            <td><?= $i += 1; ?></td>
                                            <td><?= date_en2fr($item->date, 3)?></td>
                                            <td><?= $item->phone?></td>
                                            <td><?= $item->firstname . ' ' . $item->lastname ?></td>
                                            <td style="text-align: center;"><?= $item->amount?></td>
                                            <td style="text-align: center;">0</td>
                                            <td>
                                                <span class="badge text-<?= $status[1] ?> border border-<?= $status[1] ?> btn-xs"><?= $status[0]; ?></span>
                                            </td>
                                        </tr><?php
                                    }
                                    $c++;
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