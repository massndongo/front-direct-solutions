<?=
$this->extend('themes/themeforest');
$this->section('content'); ?>

    <!-- Table Container -->
    <div class="row my-4">
        <?= !empty(session()->getFlashdata('flash_message')) ? session()->getFlashdata('flash_message') : "" ?>

        <div class="col-sm-12">
            <div class="card">
                <!-- En-tête -->
                <div class="card-header" style="background: #0b5394">
                    <div class="page-title-box">
                        <h4 class="page-title text-white"><?= lang('Aside.submenu_terminus_label'); ?></h4>
                        <div>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a style="color: #A5B0BA" href="javascript: void(0);"><?= lang('Aside.menu_parametrages_comment')?></a></li>
                                <li class="breadcrumb-item"><a style="color: #A5B0BA" href="javascript: void(0);"><?= lang("Aside.submenu_terminus_label") ?></a></li>
                                <li class="breadcrumb-item active text-white"><?= lang("Label.title_liste") ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Tableau -->
                <div class="card-body">
                    <h4 class="header-title">
                        <span class="float-end mb-3">
                             <a class="modal-link-edit btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/terminus-add')?>" type="button"><i class="mdi mdi-plus me-1"></i><?= lang('Btn.add_terminus')?></a>
                        </span>
                    </h4>

                    <table class="table shadow-lg table-striped">
                        <thead>
                        <tr>
                            <th style="color: #0b5394;">#</th>
                            <th style="color: #0b5394;"><?= lang('Aside.submenu_terminus_label')?></th>
                            <th style="color: #0b5394;"><?= lang('Aside.submenu_terminus_lat')?></th>
                            <th style="color: #0b5394;"><?= lang('Aside.submenu_terminus_long')?></th>
                            <th style="color: #0b5394;" class="text-center"><?= lang('Aside.submenu_tarif_action')?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($terminus as $data) {
                            foreach ($data as $key => $value) { ?>
                                <tr>
                                    <th style="color: #0b5394;" scope="row"><?= $key+1 ?></th>
                                    <td><?= $value->termLibelle ?></td>
                                    <td><?= $value->termLat ?></td>
                                    <td><?= $value->termLng ?></td>
                                    <td class="text-center">
                                        <a class="modal-link-edit btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/terminus-edit/'.$value->termId)?>" type="button"><i class="fe-edit-2 px-1"></i><?= lang('Btn.btn_edit') ?></a>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table> <!-- end table-responsive-->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
    </div>
    <!-- end Row -->

    <!-- Modal ajout et modification Terminus -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url($action_url) ?>" method="post" class="parsley-examples" id="form-con-close-modal">
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?= lang('Btn.btn_cancel')?></button>
                        <button type="submit" class="btn btn-info waves-effect waves-light"><?= lang('Btn.btn_save')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  end modal -->
<?php
$this->endSection();
