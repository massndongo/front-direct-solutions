<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><?= lang('Aside.menu_mass_payment_label') ?></h4>
            <div>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_dashboard') ?></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_mass_payment_label') ?></a></li>
                    <li class="breadcrumb-item active"><?= lang("Aside.submenu_mass_init_payment") ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php
    if(!isset($view_step)):  ?>
        <div class="row">
            <div class="col-lg-12">
                <?= (isset($message) && !empty($message)) ? $message : ""; ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title"><?= lang('Aside.submenu_mass_init_payment') ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="card">
                                            <a class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('payment/bulk-payment-request/SN_PM_OM')?>" title="<?= lang('Label.pay_by_om')?>">
                                                <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/orage.png" alt="ORANGE MONEY" style="width: 175.36px; height: 121.9px">
                                            </a>

                                        </div>
                                    </div>
                                    <!--div class="col-2">
                                        <div class="card">
                                            <a class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('payment/bulk-payment-request/SN_PM_FREE_MONEY')?>" title="<?= lang('Label.pay_by_free')?>">
                                                <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/free.png" alt="FREE MONEY" style="width: 175.36px; height: 121.9px">
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <a class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('payment/bulk-payment-request/SN_PM_EMONEY')?>" title="<?= lang('Label.pay_by_emoney')?>">
                                                <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/emoney.png" alt="E-MONEY" style="width: 175.36px; height: 121.9px">
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <a class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('payment/bulk-payment-request/SN_PM_WIZALL')?>" data-bs-container="#tooltip-container" title="<?= lang('Label.pay_by_wizall')?>">
                                                <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/wizall.png" alt="WIZALL" style="width: 175.36px; height: 121.9px">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="card">
                                            <a class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('payment/bulk-payment-request/SN_PM_WAVE')?>" title="<?= lang('Label.pay_by_wave')?>">
                                                <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/wave.jpg" alt="WAVE" style="width: 175.36px; height: 121.9px">
                                            </a>

                                        </div>
                                    </div-->
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col 12 -->
        </div>
         <!-- Modal -->
         <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= lang('Label.title_form')?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="form-con-close-modal" enctype="multipart/form-data">
                        <div class="modal-body p-1">
                            <?= lang('Label.loading_waiting')?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?= lang('Btn.btn_cancel')?></button>
                            <button type="submit" class="btn btn-info waves-effect waves-light"><?= lang('Label.preview')?></button>
                        </div>
                    </form>
                </div>
            </div>
         </div><!-- /.modal -->
        <?php
    else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title"><?= lang("Aside.submenu_beneficiaire_title") ?></h4>
                    </div>
                    <div class="card-body">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang("Label.amount") ?></th>
                                <th><?= lang("Label.code_service") ?></th>
                                <th><?= lang("Label.mobile_number") ?></th>
                                <th><?= lang("Label.first_name") .' et '. lang("Label.last_name") ?></th>
                                <th><?= lang("Label.email") ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($customer_list) && !empty($customer_list) && count($customer_list)>0) :
                                $ct = 0;
                                foreach($customer_list as $item): ?>
                                    <tr>
                                        <td><?= $ct += 1; ?></td>
                                        <td><?= $item['montant']; ?></td>
                                        <td><?= payment_method($item['codeService']); ?></td>
                                        <td><?= $item['numeroBeneficiaire']; ?></td>
                                        <td><?= $item['prenomBeneficiaire'] .' '. $item['nomBeneficiaire']; ?></td>
                                        <td><?= $item['mailBeneficiaire']; ?></td>
                                    </tr>
                                <?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <p>
                            <?php if (isset($customer_list) && !empty($customer_list) && count($customer_list)>0) { ?>
                                <a href="<?= site_url("payment/send-bulk-payment") ?>" class="btn btn-outline-primary float-end"><i class="fa fa-check"></i> <?= lang('Btn.btn_save')?></a>
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endif;
?>
<?php $this->endSection();
