<div class="col-12">
    <div class="card">
        <div class="card-header bg-dark">
            <h4 class="card-title text-light mb-0"><?= $titleForm?></h4>
        </div>
        <div class="card-body">
            <?php
                if(isset($typeView) && $typeView === "APPRO"): ?>
                    <div class="row mb-4">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label text-left" for="bank">Banque</label><span class="col-md-1 text-danger pull-right">(*)</span>
                            <div class="col-md-8">
                                <select name="bank" id="bank" class="form-control select2">
                                    <option value="">Choisir ...</option>
                                    <?php
                                        if(isset($banks) && is_array($banks) && count($banks)>0){
                                            foreach($banks as $item){ ?>
                                                <option value="<?= $item->code?>"><?= $item->nom?></option>
                                            <?php }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label text-left" for="reference">R&eacute;ference</label><span class="col-md-1 text-danger pull-right">(*)</span>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="reference" name="reference" placeholder="Saisir la r&eacute;f&eacute;rence du d&eacute;p&ocirc;t ...">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label text-left" for="date">Date</label><span class="col-md-1 text-danger pull-right">(*)</span>
                            <div class="col-md-8">
                                <input type="text" class="form-control dateTimePicker" id="date" name="date" placeholder="Saisir la date du d&eacute;p&ocirc;t ...">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label text-left" for="amount">Montant</label><span class="col-md-1 text-danger pull-right">(*)</span>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="amount" name="montant" placeholder="Saisir le montant d&eacute;poser ...">
                            </div>
                        </div>
                    </div>
                <?php
            endif;
            if(isset($typeView) && $typeView === "COMPENSE"): ?>
                <div class="row mb-4">
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label text-left" for="amount">Montant</label><span class="col-md-1 text-danger pull-right">(*)</span>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="amount" name="montant" placeholder="Saisir le montant de la compensation ...">
                        </div>
                    </div>
                </div>
                <?php
            endif;
        ?>
        </div>
    </div>
</div>