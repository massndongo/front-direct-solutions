<?php
if(in_array(400,session()->get('menus'))): ?>
    <li>
        <a href="#personnelForms" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['requestPayment/requestPayment-add']) ? 'aria-expanded="true"':''?>>
            <i class="fe-user"  <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_payment_request')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['requestPayment/requestPayment-add']) ? 'collapse show':'collapse'?>" id="personnelForms">
            <ul class="nav-second-level">
                <?php
                if(in_array(4001,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['requestPayment/requestPayment-add']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['requestPayment/requestPayment-add']) ? 'class="active"':''?> href="<?= site_url('requestPayment/requestPayment-add')?>"><?= lang('Aside.submenu_request_new')?></a>
                    </li> <?php
                endif;
                ?>
            </ul>
        </div>
    </li> <?php
endif;

if(in_array(300,session()->get('menus'))): ?>
    <li>
        <a href="#sidebarForms" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['parameters/pricing-list','parameters/section-list','parameters/zone-list','parameters/trajet-list','parameters/expense-list','parameters/terminus-list','parameters/bus-list','parameters/lines-list']) ? 'aria-expanded="true"':''?>>
            <i class="fe-disc" <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_parametrages_comment')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['parameters/pricing-list','parameters/section-list','parameters/zone-list','parameters/trajet-list','parameters/expense-list','parameters/terminus-list','parameters/bus-list','parameters/lines-list']) ? 'collapse show':'collapse'?>" id="sidebarForms">
            <ul class="nav-second-level">
                <?php
                if(in_array(3001,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/pricing-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/pricing-list']) ? 'class="active"':''?> href="<?= site_url('parameters/pricing-list')?>"><?= lang('Aside.submenu_tarif_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(3002,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/section-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/section-list']) ? 'class="active"':''?> href="<?= site_url('parameters/section-list')?>"><?= lang('Aside.submenu_section_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(3003,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/zone-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/zone-list']) ? 'class="active"':''?> href="<?= site_url('parameters/zone-list')?>"><?= lang('Aside.submenu_zone_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(3007,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/terminus-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/terminus-list']) ? 'class="active"':''?> href="<?= site_url('parameters/terminus-list')?>"><?= lang('Aside.submenu_terminus_comment')?></a>
                    </li> <?php
                endif;
                /*if(in_array(3004,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/trajet-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/trajet-list']) ? 'class="active"':''?> href="<?= site_url('parameters/trajet-list')?>"><?= lang('Aside.submenu_trajet_comment')?></a>
                    </li> <?php
                endif;*/
                if(in_array(3005,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/bus-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/bus-list']) ? 'class="active"':''?> href="<?= site_url('parameters/bus-list')?>"><?= lang('Aside.submenu_bus_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(3006,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/lines-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/lines-list']) ? 'class="active"':''?> href="<?= site_url('parameters/lines-list')?>"><?= lang('Aside.submenu_line_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(3008,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['parameters/expense-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['parameters/expense-list']) ? 'class="active"':''?> href="<?= site_url('parameters/expense-list')?>"><?= lang('Aside.submenu_expense_comment')?></a>
                    </li> <?php
                endif;
                ?>
            </ul>
        </div>
    </li> <?php
endif;
if(in_array(400,session()->get('menus'))): ?>
    <li>
        <a href="#personnelForms" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['agents/agent-add','agents/agent-list','agents/agent-edit']) ? 'aria-expanded="true"':''?>>
            <i class="fe-user"  <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_gestion_personnel_comment')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['agents/agent-add','agents/agent-list','agents/agent-edit']) ? 'collapse show':'collapse'?>" id="personnelForms">
            <ul class="nav-second-level">
                <?php
                if(in_array(4001,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['agents/agent-add','agents/agent-edit']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['agents/agent-add','agents/agent-edit']) ? 'class="active"':''?> href="<?= site_url('agents/agent-add')?>"><?= lang('Aside.submenu_agent_add_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(4002,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['agents/agent-list']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['agents/agent-list']) ? 'class="active"':''?> href="<?= site_url('agents/agent-list')?>"><?= lang('Aside.submenu_agent_list_comment')?></a>
                    </li> <?php
                endif;
                ?>
            </ul>
        </div>
    </li> <?php
endif;

if(in_array(500,session()->get('menus'))): ?>
    <li>
        <a href="#profilForms" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['profiles/profile-add','profiles/profile-list','profiles/profile-edit','profiles/compte-user']) ? 'aria-expanded="true"':''?>>
            <i class="fe-share-2"  <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_gestion_profil_comment')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['profiles/profile-add','profiles/profile-list','profiles/profile-edit','profiles/compte-user']) ? 'collapse show':'collapse'?>" id="profilForms">
            <ul class="nav-second-level">
                <?php
                if(in_array(5001,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['profiles/profile-add']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['profiles/profile-add']) ? 'class="active"':''?> href="<?= site_url('profiles/profile-add')?>"><?= lang('Aside.submenu_profil_add_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(5002,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['profiles/profile-list','profiles/profile-edit']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['profiles/profile-list','profiles/profile-edit']) ? 'class="active"':''?> href="<?= site_url('profiles/profile-list')?>"><?= lang('Aside.submenu_profil_list_comment')?></a>
                    </li> <?php
                endif;
                if(in_array(5004,session()->get('privileges')) || in_array(5005,session()->get('options'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['profiles/profile-compte-user','profiles/profile-compte-user-add']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['profiles/profile-compte-user','profiles/profile-compte-user-add']) ? 'class="active"':''?> href="<?= site_url('profiles/profile-compte-user')?>"><?= lang('Aside.submenu_profil_compte_user_comment')?></a>
                    </li> <?php
                endif;
                ?>
            </ul>
        </div>
    </li> <?php
endif;
if(in_array(600,session()->get('menus'))): ?>
    <li>
        <a href="#activityForms" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['activities/define-session','activities/list-session']) ? 'aria-expanded="true"':''?>>
            <i class="fe-activity"  <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_gestion_session_comment')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['activities/define-session','activities/list-session']) ? 'collapse show':'collapse'?>" id="activityForms">
            <ul class="nav-second-level">
                <?php
                /*if(in_array(6001,session()->get('privileges'))): ?>
                    <li <?= in_array(currentUrl(uri_string()),['activities/define-session']) ? 'class="menuitem-active"':''?>>
                        <a <?= in_array(currentUrl(uri_string()),['activities/define-session']) ? 'class="active"':''?> href="<?= site_url('activities/define-session')?>"><?= lang('Aside.submenu_session_add_comment')?></a>
                    </li> <?php
                endif;*/
                if(in_array(6001,session()->get('privileges')) || in_array(6002,session()->get('privileges'))) { ?>
                    <li <?= in_array(currentUrl(uri_string()), ['activities/define-session', 'activities/list-session']) ? 'class="menuitem-active"' : '' ?>>
                        <a <?= in_array(currentUrl(uri_string()), ['activities/define-session', 'activities/list-session']) ? 'class="active"' : '' ?>
                            href="<?= site_url('activities/list-session') ?>"><?= lang('Aside.submenu_session_list_comment') ?></a>
                    </li> <?php
                }
                ?>
            </ul>
        </div>
    </li> <?php
endif;
if(in_array(700,session()->get('menus'))): ?>
    <li>
        <a href="#collectForms" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['collection/show-history','collection/show-expense-history']) ? 'aria-expanded="true"':''?>>
            <i class="fe-shopping-cart"  <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_gestion_etat_comment')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['collection/show-history','collection/show-expense-history']) ? 'collapse show':'collapse'?>" id="collectForms">
            <ul class="nav-second-level">
                <?php
                if(in_array(7001,session()->get('privileges'))) { ?>
                    <li <?= in_array(currentUrl(uri_string()), ['collection/show-history']) ? 'class="menuitem-active"' : '' ?>>
                        <a <?= in_array(currentUrl(uri_string()), ['collection/show-history']) ? 'class="active"' : '' ?>
                            href="<?= site_url('collection/show-history') ?>"><?= lang('Aside.submenu_etat_collecte_ticket_comment') ?></a>
                    </li> <?php
                }
                if(in_array(7002,session()->get('privileges'))) { ?>
                    <li <?= in_array(currentUrl(uri_string()), ['collection/show-expense-history']) ? 'class="menuitem-active"' : '' ?>>
                        <a <?= in_array(currentUrl(uri_string()), ['collection/show-expense-history']) ? 'class="active"' : '' ?>
                            href="<?= site_url('collection/show-expense-history') ?>"><?= lang('Aside.submenu_etat_collecte_depense_comment') ?></a>
                    </li> <?php
                }
                ?>
            </ul>
        </div>
    </li> <?php
endif;