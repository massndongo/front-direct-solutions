<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.expense_form_title')?></h4>
        </div>
        <?php
            if(isset($expenseEdit)): ?>
                <input type="hidden" name="typeExpenseId" value="<?= $expenseEdit['typeExpenseId']?>" >
                <?php
            endif;
        ?>
        <div class="card-body">
            <div class="row mb-4">
                <div class="mb-3">
                    <label class="form-label <?= !isset($expenseEdit) ? 'text-left':''?>" for="typeExpenseLibelle"><?= lang('Aside.submenu_expense')?></label><span class="col-md-1 text-danger pull-right">*</span>
                    <input type="text" class="form-control" id="typeExpenseLibelle" name="typeExpenseLibelle" data-parsley-type="text" data-parsley-type-message="<?= lang('Messages.form_message_error_expense') ?>" data-parsley-required-message="<?= lang('Messages.form_message_required') ?>" placeholder="<?= lang('Label.holder_expense')?>" value="<?= isset($expenseEdit) ? $expenseEdit['typeExpenseLibelle']:""?>" />
                </div>
            </div>
        </div>
    </div>
</div>