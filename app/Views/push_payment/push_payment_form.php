<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?= $titlePage?></h4>
                <div>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_dashboard') ?></a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_payment_request') ?></a></li>
                        <li class="breadcrumb-item active"><?= lang("Aside.submenu_push_payment_init_label") ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <?= isset($message) && !empty($message) ? $message : "" ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title"><?= lang('Label.title_form')?></h4>
                    <i class="sub-header font-13">
                        <?= $subTitlePage?>
                    </i>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-2">
                                <div class="card">
                                    <a href="<?= site_url('payment/push-payment-request/SN_PM_OM')?>" class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="<?= lang('Label.pay_by_om')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/orage.png" alt="ORANGE MONEY" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div>
                            <!--div class="col-2">
                                <div class="card">
                                    <a href="<?= site_url('payment/push-payment-request/SN_PM_FREE_MONEY')?>" class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="<?= lang('Label.pay_by_free')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/free.png" alt="FREE MONEY" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <a href="<?= site_url('payment/push-payment-request/SN_PM_EMONEY')?>" class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="<?= lang('Label.pay_by_emoney')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/emoney.png" alt="E-MONEY" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <a href="<?= site_url('payment/push-payment-request/SN_PM_WIZALL')?>" class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="<?= lang('Label.pay_by_wizall')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/wizall.png" alt="WIZALL" style="width: 175.36px; height: 121.9px">
                                    </a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <a href="<?= site_url('payment/push-payment-request/SN_PM_WAVE')?>" class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="<?= lang('Label.pay_by_wave')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/wave.jpg" alt="WAVE" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div-->
                            <div class="col-2">
                                <div class="card">
                                    <a href="<?= site_url('payme/card-payment-request/BANK_PAYMENT')?>" class="modal-link-edit btn" data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="<?= lang('Label.pay_by_card')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/bank-cards.png" style="width: 175.36px; height: 121.9px">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= lang('Label.title_form')?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="form-con-close-modal" enctype="multipart/form-data" onsubmit="document.getElementById('bPushPay').disabled=true;">
                    <div class="modal-body p-1">
                        <?= lang('Label.loading_waiting')?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect pull-left" data-bs-dismiss="modal"><?= lang('Btn.btn_cancel')?></button>
                        <button type="submit" id="bPushPay" class="btn btn-info waves-effect waves-light"><i class="fas fa-paper-plane"></i> <?= lang('Btn.btn_send')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
<?php
$this->endSection();

