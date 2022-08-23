<?=
    $this->extend('themes/themeforest');
    $this->section('content'); ?>
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title"><?= lang('Aside.submenu_profil_list_comment')?></h4>
                    <div>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?= lang('Aside.menu_gestion_profil_comment')?></a></li>
                            <li class="breadcrumb-item active"><?= lang('Aside.submenu_profil_list_comment')?></li>
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
                        <h4 class="header-title"><?= lang('Label.title_liste')?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('Label.profile_name')?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(isset($liste) && is_array($liste) && count($liste)>0):
                                    $c=0; $i= $paginate['page']>0 ? ($paginate['page']+1):1;
                                    foreach($liste as $item): ?>
                                        <tr class="<? $c%2==0 ? 'table-active':'row'?>">
                                            <th scope="row"><?= $i?></th>
                                            <td>
                                                <b><?= $item->label?></b>
                                                <a href="<?= site_url('profiles/profile-edit/'.$item->id)?>" class="btn btn-soft-danger fa-pull-right" ><i class="fe-alert-octagon" title="<?= lang('Btn.btn_edit')?>"></i> <?= lang('Btn.btn_edit')?></a>
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
                        <?= $pager->makeLinks($paginate['page'], $paginate['perPage'], $paginate['total'], $paginate['template'], 0, $paginate['group']);?>
                        <div class="clearfix"></div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end Row -->

        <?php
    $this->endSection();
