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
<div class="row">
    <div class="col-lg-12">
        <?= (isset($message) && !empty($message)) ? $message : ""; ?>
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"><?= lang('Aside.submenu_mass_init_payment') ?></h4>
                <hr/>
                <form class="" novalidate method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="serviceCode" class="form-label">Moyen de paiement</label>
                            <select name="payment_method" id="serviceCode" class="form-control"  data-toggle="select2" data-width="100%" required>
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
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01" class="form-label">Charger un fichier</label>
                            <input type="file" class="form-control" name="fichier" id="validationCustom01" placeholder="First name" required />
                        </div>
                        <div class="col-md-2 mt-3">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-desktop"></i> <?= lang("Label.preview") ?></button>
                        </div>
                    </div>
                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->

        <div class="card">
            <div class="card-body">
                <div class="row">
                <h4 class="header-title col-6"><?= lang("Aside.submenu_beneficiaire_title") ?></h4>
                <p class="text-muted font-13 col-5 text-right">
                    <?php if (isset($customer_list) && !empty($customer_list) && count($customer_list)>0) { ?>
                        <a href="<?= site_url("payment/send-bulk-payment") ?>" class="btn btn-outline-primary float-end"><i class="fa fa-check"></i> Envoyer</a>
                    <?php } ?>
                </p>
            </div>
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
        </div>
    </div> <!-- end col 12 -->
</div>
<?php $this->endSection();
