<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><?= lang('Aside.submenu_expense_label') ?></h4>
            <div>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_parametrages_comment') ?></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.submenu_expense_comment') ?></a></li>
                    <li class="breadcrumb-item active"><?= lang("Label.title_liste") ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <!-- Message en cas de succès -->
        <?= !empty(session()->getFlashdata('flash_message')) ? session()->getFlashdata('flash_message') : "" ?>

        <div class="card">
            <div class="card-header">
                <h4 class="header-title">
                    <?= lang('Aside.submenu_expense_title') ?>
                    <span style="float: right" class="pull-right">
                        <a class="modal-link-edit btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/expense-add')?>" type="button"><i class="mdi mdi-plus me-1"></i><?= lang('Btn.add_expense')?></a>
                    </span>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center"><?= lang('Aside.submenu_expense_name') ?></th>
                                <th class="text-center"><?= lang('Label.option')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($depense as $key => $item) { ?>
                                        <tr>
                                            <th scope="row"><?= $key + 1 ?></th>
                                            <td class="text-center"><?= $item->typeExpenseLibelle ?></td>
                                            <td class="text-center">
                                                <a class="modal-link-edit btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/expense-edit/'.$item->typeExpenseId)?>" type="button"><i class="fe-edit-2 px-1"></i><?= lang('Btn.btn_edit') ?></a>
                                            </td>
                                        </tr>
                            <?php 
                            } ?>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
<!-- end row -->

<!-- New Price modal content -->

<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= lang('Label.title_form')?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url($action_url) ?>" method="post" class="parsley-examples" id="form-con-close-modal">
                <div class="modal-body p-1">
                    <?= $this->include('parameters/expenses/form') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?= lang('Btn.btn_cancel')?></button>
                    <button type="submit" class="btn btn-info waves-effect waves-light"><?= lang('Btn.btn_save')?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->




        <?php
    $this->endSection();
