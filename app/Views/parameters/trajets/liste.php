<?= $this->extend('themes/themeforest'); $this->section('content'); ?>

    <!-- start page title -->
    <div class="row">
        <!-- Modal -->
        <!--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <?php /*= $this->include('parameters/trajets/ajout') */?>
                    </div>
                </div>
            </div>
        </div>-->
        <!--  End Modal -->
        <div class="col-12">
            <div class="card my-3">
                <!-- start page title -->
                <div class="card-header" style="background: #0b5394">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title text-white"><?/*= lang('Aside.submenu_trajet_label'); */?></h4>
                            <div>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a style="color: #A5B0BA" href="javascript: void(0);"><?/*= lang('Aside.menu_parametrages_comment')*/?></a></li>
                                    <li class="breadcrumb-item"><a style="color: #A5B0BA" href="javascript: void(0);"><?/*= lang("Aside.submenu_trajet_label") */?></a></li>
                                    <li class="breadcrumb-item active text-white"><?/*= lang("Label.title_liste") */?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="card-body">
                    <div class="row">
                        <div class="float-end">
                            <!-- Button trigger modal -->
                            <button class="btn btn-success shadow-lg float-end mb-2 mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fe-plus"></i>
                                <?/*= lang("Btn.add_route") */?>
                            </button>
                        </div>
                    </div>
                    <!-- Tableau de données -->
                    <table class="table shadow-lg rounded-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?/*= lang('Label.departure') */?></th>
                                <th><?/*= lang('Label.arrival') */?></th>
                                <th><?/*= lang('Label.zone') */?></th>
                                <th><?/*= lang('Aside.submenu_tarif_action') */?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($trajet) && !empty($trajet)) {
                            foreach ($trajet as $key) : ?>
                            <?php foreach ($key as $trajet) {
                                $zones = '';
                                foreach ($trajet->trajetZone as $key) :
                                    $zones .= $key->zoneLabel . ', ' ;
                                endforeach
                                ?>
                                <tr>
                                    <td><?= $trajet->trajetId ?></td>
                                    <td><?= $trajet->trajetStart ?></td>
                                    <td><?= $trajet->trajetEnd ?></td>
                                    <td><?= substr($zones, 0, -1) ?></td>
                                    <td>
                                        <button class="btn btn-soft-primary">
                                            <i class="fe-edit-2"></i>
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            <?php 
                            } 
                        endforeach; } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
<?php  $this->endSection();
