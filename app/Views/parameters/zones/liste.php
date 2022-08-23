<?=
$this->extend('themes/themeforest');
$this->section('content'); ?>
    <!-- start page title -->

    <div class="row my-4">
        <div class="col-sm-12">
            <?= !empty(session()->getFlashdata('flash_message')) ? session()->getFlashdata('flash_message') : "" ?>

            <div class="card">
                <!-- En-tête -->
                <div class="card-header" style="background: #0b5394">
                    <div class="page-title-box">
                        <h4 class="page-title text-white"><?= lang('Aside.submenu_zone_label'); ?></h4>
                        <div>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a style="color: #A5B0BA" href="javascript: void(0);"><?= lang('Aside.menu_parametrages_comment')?></a></li>
                                <li class="breadcrumb-item"><a style="color: #A5B0BA" href="javascript: void(0);"><?= lang("Aside.submenu_zone_label") ?></a></li>
                                <li class="breadcrumb-item active text-white"><?= lang("Label.title_liste") ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Tableau -->
                <div class="card-body">
                    <h4 class="header-title">
                        <span class="float-end mb-3">
                             <a class="modal-link-edit btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/zone-add')?>" type="button"><i class="mdi mdi-plus me-1"></i><?= lang('Btn.add_zone')?></a>
                        </span>
                    </h4>

                    <table class="table table-striped mb-0 shadow-lg rounded-3">
                        <thead>
                        <tr>
                            <th style="color: #0b5394;">#</th>
                            <th style="color: #0b5394;"><?= lang("Label.label"); ?></th>
                            <th style="color: #0b5394;"><?= lang("Label.section"); ?></th>
                            <th style="color: #0b5394;"><?= lang("Label.start"); ?></th>
                            <th style="color: #0b5394;"><?= lang("Label.end"); ?></th>
                            <th style="color: #0b5394;" class="text-center"><?= lang('Label.option')?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; if (isset($zone) && !empty($zone))
                        {
                            foreach ($zone as $key) : ?>
                                <?php foreach ($key as $zone) { $i += 1;

                                    $sections = '';
                                    foreach ($zone->zoneSection as $key) : ?>
                                        <?php $sections .= $key->sectionLabel . ', ' ?>
                                    <?php endforeach ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $zone->zoneLabel ?></td>
                                        <td>
                                            <?= substr($sections, 0, -1); ?>
                                        </td>
                                        <td><?= $zone->zoneStart ?></td>
                                        <td><?= $zone->zoneEnd ?></td>
                                        <td class="text-center">
                                            <a class="modal-link-edit btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/zone-edit/'.$zone->zoneId)?>" type="button"><i class="fe-edit-2 px-1"></i><?= lang('Btn.btn_edit') ?></a>
                                        </td>
                                    </tr>
                                <?php } endforeach; } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

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
