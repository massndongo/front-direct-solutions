<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= lang('Label.details_collecte_title')?></h4>
        </div>
        <div class="card-body">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label"><?= lang('Label.registration_number')?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $history['collectVehicleSession'].' ( '.lang('Label.ligne_numero',['number'=>$history['collectLigneSession']]).' )'?>"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label"><?= lang('Label.receveur')?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $history['collectReceiptSession']?>"  disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label"><?= lang('Label.zone')?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $history['collectZoneLabel']?>"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label"><?= lang('Label.section')?></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="<?= $history['collectSectionLabel']?>"  disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?= lang('Label.date')?></th>
                            <th><?= lang('Label.reference')?></th>
                            <th><?= lang('Label.amount')?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    if(isset($history['details']) && is_array($history['details']) && count($history['details'])>0):
                        $c=0;$i=1;
                        foreach($history['details'] as $item): ?>
                            <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                <td scope="row"><?= str_pad($i++,strlen(count($history['details'])),'0',STR_PAD_LEFT)?></td>
                                <td><?= date_en2fr($item->collectHistoryDetailDate,3) ?></td>
                                <td><?= $item->collectHistoryDetailReference ?></td>
                                <td>
                                    <span class="badge badge-outline-success float-end"> <?= number_format($item->collectHistoryDetailAmount,0,'',' ')?></span>
                                </td>
                            </tr>
                            <?php
                            $total+= $item->collectHistoryDetailAmount;
                            $c++;
                        endforeach;
                    endif;
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3"><?= lang('Label.total')?></th><th><span class="badge badge-outline-danger float-end"><?= number_format($total,0,'',' ')?></span></th>
                        </tr>
                    </tfoot>
                </table>
            </div> <!-- end table-responsive-->
        </div>
    </div>
</div>