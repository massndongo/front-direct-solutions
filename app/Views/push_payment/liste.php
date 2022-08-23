<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?= lang('Aside.submenu_history_comment') ?></h4>
                <div>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_dashboard') ?></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_payment_request') ?></a></li>
                        <li class="breadcrumb-item active"><?= lang("Aside.submenu_push_payment_list_label") ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header mb-3">
                        <h4 class="header-title"><?= lang('Aside.submenu_push_payment_list_label')?></h4>
                        <i class="sub-header font-13">
                            <?= isset($subTitlePage) ?? "" ;?>
                        </i>
                    </div>
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?= lang('Label.date')?></th>
                            <th><?= lang('Label.reference')?></th>
                            <th><?= lang('Label.mobile_number')?></th>
                            <th><?= lang('Label.code_service')?></th>
                            <th><?= lang('Label.amount')?></th>
                            <th><?= lang('Label.status')?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($pay_list) && is_array($pay_list) && count($pay_list) > 0):
                                    $i=0;
                                    foreach($pay_list as $item):
                                        $status = explode("-", payment_status($item->status));
                                        ?>
                                        <tr>
                                            <td><?= $i += 1; ?></td>
                                            <td><?= date_en2fr($item->date, 3)?></td>
                                            <td><?= $item->reference?></td>
                                            <td><?= $item->phone?></td>
                                            <td><?= payment_method($item->pay_method) ?></td>
                                            <td><?= $item->amount?></td>
                                            <td>
                                                <span class="badge text-<?= $status[1] ?> border border-<?= $status[1] ?> btn-xs"><?= $status[0]; ?></span>
                                            </td>
                                        </tr><?php
                                    endforeach;
                                endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
$this->endSection();
