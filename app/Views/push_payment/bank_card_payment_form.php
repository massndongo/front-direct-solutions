<input type="hidden" name="serviceCode" value="<?= $service_code ?? ''?>" />
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title text-center">Demande de paiement par carte bancaire</h4>
            <hr/>
            <div class="row">
                <div class="mb-2 col-md-6">
                    <label for="firstname" class="form-label"><?= lang('Label.first_name'); ?></label>
                    <input type="text" class="form-control" name="client_firstname" autocomplete="off" id="firstname" placeholder="<?= lang('Label.holder_first_name') ?>" required>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="lastname" class="form-label"><?= lang('Label.last_name'); ?></label>
                    <input type="text" class="form-control" name="client_lastname" id="lastname" placeholder="<?= lang('Label.holder_last_name') ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 col-md-6">
                    <label for="phone_number" class="form-label"><?= lang('Label.mobile_number') ?></label>
                    <input type="text" class="form-control" name="numeroBeneficiaire" id="phone_number" autocomplete="off" placeholder="<?= lang('Label.holder_mobile_number') ?>" required>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="email" class="form-label"><?= lang('Label.email') ?></label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="<?= lang('Label.holder_email') ?>" autocomplete="off" required>
                </div>
            </div>
            <div class="mb-2">
                <label for="amount" class="form-label"><?= lang('Label.amount_to_pay') ?></label>
                <input type="text" class="form-control autonumber" name="montant" id="amount" placeholder="<?= lang('Label.holder_amount') ?>" autocomplete="off" data-digit-group-separator=" " data-decimal-character="," required>
            </div>

        </div> <!-- end card-body -->
    </div> <!-- end card-->
</div> <!-- end col -->
<!-- Plugins js -->
<script src="<?= base_url()?>/assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="<?= base_url()?>/assets/libs/autonumeric/autoNumeric.min.js"></script>
<!-- Init js-->
<script src="<?= base_url()?>/assets/js/pages/form-masks.init.js"></script>
