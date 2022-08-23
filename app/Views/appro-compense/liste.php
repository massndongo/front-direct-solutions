<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?= lang("Aside.menu_appro_compense") ?></h4>
                <div>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_dashboard') ?></a></li>
                        <li class="breadcrumb-item active"><?= lang("Aside.menu_appro_compense") ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <?= isset($message) && !empty($message) ? $message : "" ?>
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">
                        FILTRE
                        <span class="float-end">
                            <a href="<?= site_url('approviser-compte')?>"  data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="Approvisionnement" class="btn btn-outline-success modal-link-edit">Approvisionnement</a>
                            <a href="<?= site_url('compenser-compte')?>"  data-bs-toggle="modal" data-bs-target="#con-close-modal"  title="Compensation" class="btn btn-outline-danger modal-link-edit">Compensation</a>
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <form action="<?= site_url('approvisionnent-compensation') ?>" method="post" class=form-horizontal">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="statut" class="form-label"><?= lang('Label.status') ?></label>
                                    <select id="statut" name="statut" class="form-select">
                                        <option value=""><?= lang('Label.holder_choice') ?></option>
                                        <option <?= (isset($statut) && $statut === 'I') ? 'selected':set_select('statut', 'I') ?> value="I">En attente</option>
                                        <option <?= (isset($statut) && $statut === 'V') ? 'selected':set_select('statut', 'V') ?> value="V">Valid&eacute;</option>
                                        <option <?= (isset($statut) && $statut === 'R') ? 'selected':set_select('statut', 'R') ?> value="R">Annul&eacute;</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select id="type" name="type" class="form-select">
                                        <option value=""><?= lang('Label.holder_choice') ?></option>
                                        <option <?= (isset($type) && $type === 'APPROVISIONNEMENT') ? 'selected':set_select('type', 'APPROVISIONNEMENT') ?> value="APPROVISIONNEMENT">APPRO</option>
                                        <option <?= (isset($type) && $type === 'COMPENSE') ? 'selected':set_select('type', 'COMPENSE') ?> value="COMPENSE">COMPENSE</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="start" class="form-label"><?= lang('Label.start_date') ?></label>
                                    <input type="text" name="start" required class="form-control datePicker" readonly id="start" value="<?= ($start) ?  : set_value('start') ?>" />
                                </div>
                                <div class="col-md-2">
                                    <label for="end" class="form-label"><?= lang('Label.end_date') ?></label>
                                    <input id="end" type="text" name="end" required class="form-control datePicker" value="<?= ($end) ?  : set_value('end') ?>" />
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary waves-effect waves-light mt-3" type="submit"><i class="fa fa-search"></i> <?= lang('Btn.btn_search') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Liste</h4>
                </div>
                <div class="card-body">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th><th>Date</th><th>Type</th><th>D&eacute;tails</th><th>Montant</th><th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($liste) && is_array($liste) && count($liste) > 0):
                                $i=1;
                                foreach($liste as $item): ?>
                                    <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= date_en2fr($item->date_at, 3)?></td>
                                    <td><?= $item->service_code?></td>
                                    <td>
                                        <b><?= $item->label.' ('.$item->short_label.')'?></b><br />
                                        <?php
                                            if($item->service_code === "APPROVISIONNEMENT"): ?>
                                                <u>R&eacute;f&eacute;rence:</u>&nbsp; <?= $item->reference?><br />
                                                <u>Date:</u>&nbsp; <?= $item->date?>
                                                <?php
                                            endif;
                                        ?>
                                    </td>
                                    <td><?= number_format($item->montant,0,'',' ') ?></td>
                                    <td>
                                        <?= $item->statut==="I" ? '<span class="badge badge-outline-info" style="font-size: 16px;">En attente</span>':''?>
                                        <?= $item->statut==="V" ? '<span class="badge badge-outline-success" style="font-size: 16px;">Valid&eacute;</span>':''?>
                                        <?= $item->statut==="R" ? '<span class="badge badge-outline-danger" style="font-size: 16px;">Annul&eacute;</span>':''?>
                                    </td>
                                    </tr><?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= lang('Label.title_form')?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="form-con-close-modal" onsubmit="document.getElementById('bPushPay').disabled=true;">
                    <div class="modal-body p-1">
                        <?= lang('Label.loading_waiting')?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect pull-left" data-bs-dismiss="modal"><?= lang('Btn.btn_cancel')?></button>
                        <button type="submit" id="bPushPay" class="btn btn-info waves-effect waves-light"><i class="fas fa-paper-plane"></i> <?= lang('Btn.btn_send')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal --> <?php
$this->endSection();
