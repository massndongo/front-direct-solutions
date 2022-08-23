<form action="<?= site_url('agents/agent-redit')?>" method="post" id="form-con-close-modal">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="card-title text-light mb-0"><?= lang('Label.title_confirmation')?></h4>
            </div>
            <input type="hidden" name="id" value="<?= $tuple->id?>" />
            <input type="hidden" name="first_name" value="<?= $tuple->first_name?>" />
            <input type="hidden" name="last_name" value="<?= $tuple->last_name?>" />
            <input type="hidden" name="phone_number" value="<?= substr($tuple->phone_number,0,3)===get_global_value('indicatif') ? substr($tuple->phone_number,strlen(get_global_value('indicatif'))):$tuple->phone_number?>" />
            <input type="hidden" name="email" value="<?= $tuple->email?>" />
            <input type="hidden" name="location" value="<?= $tuple->location?>" />
            <input type="hidden" name="identity_type" value="<?= $tuple->identity_type?>" />
            <input type="hidden" name="identity_number" value="<?= $tuple->identity_number?>" />
            <input type="hidden" name="agent_type" value="<?= $tuple->agent_type?>" />
            <input type="hidden" name="merchant_id" value="<?= $tuple->merchant_id?>" />
            <input type="hidden" name="changePwd" value="Yes" />
            <div class="card-body">
                <div class="col-12">
                    <?= $message?>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect fa-pull-left" data-bs-dismiss="modal"><?= lang('Btn.btn_no')?></button>
        <button type="submit" class="btn btn-secondary waves-effect"><?= lang('Btn.btn_yes')?></button>
    </div>
</form>