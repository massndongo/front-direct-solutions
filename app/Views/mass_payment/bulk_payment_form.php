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

                <form action="<?= site_url('payment/bulk-payment-request')?>" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">
                            <?= lang('Aside.submenu_mass_init_payment') ?>
                            <span class="float-end">
                                <a target="_blank" href="<?= site_url('payment/bulk-payment-request-file-download')?>" class="btn btn-outline-danger" ><i class="fa fa-download"></i> <?= lang('Btn.btn_download_file_model')?> </a>
                            </span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <input name="fichier" type="file" class="dropify"  />
                    </div> <!-- end card-body-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary float-end fa-pull-right"><span class="fa fa-upload"></span>&nbsp; <?= lang('Btn.btn_charge')?> </button>
                    </div>
                </div> <!-- end card-->

                </form>
            </div> <!-- end col 12 -->
        </div>
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
                                <th><?= lang("Label.code_service") ?></th>
                                <th><?= lang("Label.amount") ?></th>
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
                                        <td><?= payment_method($item['codeService']); ?></td>
                                        <td><?= $item['montant']; ?></td>
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
                                <a href="<?= site_url("payment/send-bulk-payment") ?>" class="btn btn-outline-primary float-end"><i class="fa fa-check"></i> <?= lang('Btn.btn_init')?></a>
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
