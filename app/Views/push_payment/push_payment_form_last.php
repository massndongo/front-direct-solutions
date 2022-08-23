<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
<!--?= $this->include('themes/select')?-->

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
                                    <a href="SN_PM_OM/orage.png" class="btn pushPaymentBnt" data-bs-container="#tooltip-container" data-toggle="tooltip" data-placement="bottom" title="<?= lang('Label.pay_by_om')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/orage.png" alt="ORANGE MONEY" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <a href="SN_PM_FREE_MONEY/free.png" class="btn pushPaymentBnt" data-bs-container="#tooltip-container" data-toggle="tooltip" data-placement="bottom" title="<?= lang('Label.pay_by_free')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/free.png" alt="FREE MONEY" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <a href="SN_PM_EMONEY/emoney.png" class="btn pushPaymentBnt"  data-bs-container="#tooltip-container" data-toggle="tooltip" data-placement="bottom" title="<?= lang('Label.pay_by_emoney')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/emoney.png" alt="E-MONEY" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <a href="SN_PM_WIZALL/wizall.png" class="btn pushPaymentBnt" data-bs-container="#tooltip-container" data-toggle="tooltip" data-placement="bottom" title="<?= lang('Label.pay_by_wizall')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/wizall.png" alt="WIZALL" style="width: 175.36px; height: 121.9px">
                                    </a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card">
                                    <a href="SN_PM_WAVE/wave.jpg" class="btn pushPaymentBnt" data-bs-container="#tooltip-container" data-toggle="tooltip" data-placement="bottom" title="<?= lang('Label.pay_by_wave')?>">
                                        <img class="card-img-top img-fluid" src="<?= base_url()?>/assets/images/wave.jpg" alt="WAVE" style="width: 175.36px; height: 121.9px">
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
$this->endSection();

