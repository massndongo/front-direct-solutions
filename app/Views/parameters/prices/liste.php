<?=
$this->extend('themes/themeforest');
$this->section('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><?= lang('Aside.submenu_tarif_label') ?></h4>
            <div>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_parametrages_comment') ?></a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.submenu_tarif_comment') ?></a></li>
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
                    <?= lang('Aside.submenu_tarif_title') ?>
                    <span style="float: right" class="pull-right">
                        <a class="modal-link-edit btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/pricing-add')?>" type="button"><i class="mdi mdi-plus me-1"></i><?= lang('Btn.add_rate')?></a>
                    </span>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?= lang('Aside.submenu_tarif_name') ?></th>
                                <th><?= lang('Aside.submenu_tarif_price') ?></th>
                                <th class="text-center"><?= lang('Label.option')?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rate as $data) {
                                foreach ($data as $value) {
                                    foreach ($value as $key => $val) { ?>
                                        <tr>
                                            <th scope="row"><?= $key + 1 ?></th>
                                            <td><?= lang('Label.tarif',['number'=>($key+=1)]) ?></td>
                                            <td><?= $val->rateAmount ?></td>
                                            <td class="text-center">
                                                <a class="modal-link-edit btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/pricing-edit/'.$val->rateId)?>" type="button"><i class="fe-edit-2 px-1"></i><?= lang('Btn.btn_edit') ?></a>
                                            </td>
                                        </tr>
                            <?php }
                                }
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
            <form action="<?= $action_url ?>" method="post" class="parsley-examples" id="form-con-close-modal">
                <div class="modal-body p-1">
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
