<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_line_comment')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_parametrages_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_line_comment')?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <?= isset($message) && !empty($message) ? $message:''?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">
                            <?= lang('Label.title_liste')?>
                            <span style="float: right" class="pull-right">
                                <a class="modal-link-edit btn btn-success float-end " data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/lines-add')?>" class="btn btn-outline-success" type="button"><i class="mdi mdi-plus me-1"></i><?= lang('Aside.submenu_line_add_comment')?></a>
                            </span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?= lang('Label.description')?></th>
                                        <th><?= lang('Label.zones')?></th>
                                        <th><?= lang('Label.option')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(isset($liste) && is_array($liste) && count($liste)>0):
                                        $c=0; $i= (int)$paginate['page']>1 ? ($paginate['page']+1):1;
                                        foreach($liste as $item): ?>
                                            <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                                <th scope="row"><?= $i?></th>
                                                <td>
                                                    <b><?= $item->lineLabel?></b>
                                                </td>
                                                <td>
                                                    <?= $item->lineDescription?>
                                                </td>
                                                <td>
                                                    <a class="modal-link-edit btn btn-soft-danger" data-bs-toggle="modal" data-bs-target="#con-close-modal" href="<?= site_url('parameters/lines-edit/'.$item->lineId)?>"> <i class="fe-edit-2 px-1" title="<?= lang('Btn.btn_edit')?>"></i> <?= lang('Btn.btn_edit')?></a>

                                                </td>
                                            </tr><?php
                                            $c++; $i++;
                                        endforeach;
                                    endif;
                                ?>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div>
                    <div class="card-footer">
                        <?= isset($pager) ? $pager->makeLinks($paginate['page'], $paginate['perPage'], $paginate['total'], $paginate['template'], 0, $paginate['group']):'';?>
                        <div class="clearfix"></div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end Row -->
        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= lang('Label.title_form')?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="form-con-close-modal">
                        <div class="modal-body p-1">
                            <?= lang('Label.loading_waiting')?>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><?= lang('Btn.btn_cancel')?></button>
                            <button type="submit" class="btn btn-info waves-effect waves-light"><?= lang('Btn.btn_save')?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal --><?php
    $this->endSection();

