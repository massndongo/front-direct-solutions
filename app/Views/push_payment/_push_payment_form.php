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
        <div class="col-6">
            <?= isset($message) && !empty($message) ? $message : "" ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title"><?= lang('Label.title_form')?></h4>
                    <i class="sub-header font-13">
                        <?= $subTitlePage?>
                    </i>
                </div>
                <form action="<?= site_url("payment/push-payment-request") ?>" method="post">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="amount "><?= lang('Label.amount')?></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="amount " name="amount"  value="<?= isset($agent) ? $agent['amount']:set_value('amount')?>" placeholder="<?= lang('Label.holder_amount')?>" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="customerPhoneNumber"><?= lang('Label.mobile_number')?></label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="customerPhoneNumber" name="customerPhoneNumber"  value="<?= isset($agent) ? $agent['customerPhoneNumber']:set_value('customerPhoneNumber')?>" placeholder="<?= lang('Label.holder_mobile_number')?>" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-1">
                                <label class="col-md-12 col-form-label" for="serviceCode"><?= lang('Label.code_service')?></label>
                                <div class="col-md-12">
                                    <select name="serviceCode" id="serviceCode" class="form-control"  data-toggle="select2" data-width="100%" required>
                                        <option label="<?= lang('Label.holder_choice')?>"></option>
                                        <option value="SN_PM_WAVE" data-thumbnail="<?= base_url(); ?>assets/images/wave.jpg">WAVE</option>
                                        <option value="SN_PM_WIZALL" data-thumbnail="<?= base_url(); ?>assets/images/wizall.png">WIZALL MONEY</option>
                                        <option value="SN_PM_OM" data-thumbnail="<?= base_url(); ?>assets/images/orage.png">ORANGE MONEY</option>
                                        <option value="SN_PM_FREE_MONEY" data-thumbnail="<?= base_url(); ?>assets/images/free.png">FREE MONEY</option>
                                        <option value="SN_PM_EMONEY" data-thumbnail="<?= base_url(); ?>assets/images/emoney.png">E-MONEY</option>
                                        <option value="BANK_PAYMENT"  data-thumbnail="<?= base_url(); ?>assets/images/Carte.jpeg">PAIEMENT PAR CARTE</option>
                                        <option value="BANK_TRANSFER" data-thumbnail="<?= base_url(); ?>assets/images/virmt.png">VIREMENT BANQUAIRE</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <?php
                        if(isset($agent)):
                            if(in_array(4003,session()->get('options'))):?>
                                <button class="btn btn-primary waves-effect waves-light fa-pull-right" type="submit"><i class="mdi mdi-check me-1"></i> <?= lang('Btn.btn_send')?></button> <?php
                            endif;
                        else: ?>
                            <button class="btn btn-primary waves-effect waves-light fa-pull-right" type="submit"><i class="mdi mdi-check me-1"></i> <?= lang('Btn.btn_send')?></button> <?php
                        endif;
                        ?>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
$this->endSection();

