<?php
if(in_array(900,session()->get('menus'))): ?>
    <li>
        <a href="<?= site_url('payment/dashboard')?>">
            <i class="fe-airplay"   <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?>  ></i>
            <span> <?= lang('Aside.menu_dashboard')?> </span>
        </a>
    </li>
    <li>
        <a href="<?= site_url('approvisionnent-compensation')?>">
            <i class="fe-folder-plus"   <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?>  ></i>
            <span> <?= lang('Aside.menu_appro_compense')?> </span>
        </a>
    </li>
    <li>
        <a href="#sidebarPush" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['payment/push-payment-request','push/list-request']) ? 'aria-expanded="true"':''?>>
            <i class="fe-dollar-sign" <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_push_payment_label')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['payment/push-payment-request','push/list-request']) ? 'collapse show':'collapse'?>" id="sidebarPush">
            <ul class="nav-second-level">
                <li <?= in_array(currentUrl(uri_string()),['payment/push-payment-request']) ? 'class="menuitem-active"':''?>>
                    <a <?= in_array(currentUrl(uri_string()),['payment/push-payment-request']) ? 'class="active"':''?> href="<?= site_url('payment/push-payment-request')?>"><?= lang('Aside.submenu_push_payment_init_label')?></a>
                </li>
                <li <?= in_array(currentUrl(uri_string()),['push/list-request']) ? 'class="menuitem-active"':''?>>
                    <a <?= in_array(currentUrl(uri_string()),['push/list-request']) ? 'class="active"':''?> href="<?= site_url('push/list-request')?>"><?= lang('Aside.submenu_push_payment_list_label')?></a>
                </li>
            </ul>
        </div>
    </li> <?php
endif;
if(in_array(910,session()->get('menus'))): ?>
    <li>
        <a href="<?= site_url('approvisionnent-compensation')?>">
            <i class="fe-folder-plus"   <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?>  ></i>
            <span> <?= lang('Aside.menu_appro_compense')?> </span>
        </a>
    </li>
    <li>
        <a href="#sidebarMass" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['payment/bulk-payment-request','payment/bulk-payment-list']) ? 'aria-expanded="true"':''?>>
            <i class="fe-share-2" <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
            <span> <?= lang('Aside.menu_mass_payment_label')?> </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="<?= in_array(currentUrl(uri_string()),['payment/bulk-payment-request','payment/bulk-payment-list']) ? 'collapse show':'collapse'?>" id="sidebarMass">
            <ul class="nav-second-level">
                <li <?= in_array(currentUrl(uri_string()),['payment/bulk-payment-request']) ? 'class="menuitem-active"':''?>>
                    <a <?= in_array(currentUrl(uri_string()),['payment/bulk-payment-request']) ? 'class="active"':''?> href="<?= site_url('payment/bulk-payment-request')?>"><?= lang('Aside.submenu_mass_init_payment')?></a>
                </li>
                <li <?= in_array(currentUrl(uri_string()),['payment/bulk-payment-list']) ? 'class="menuitem-active"':''?>>
                    <a <?= in_array(currentUrl(uri_string()),['payment/bulk-payment-list']) ? 'class="active"':''?> href="<?= site_url('payment/bulk-payment-list')?>"><?= lang('Aside.submenu_mass_list_payment')?></a>
                </li>
            </ul>
        </div>
    </li> <?php
endif; ?>
<li>
    <a href="#payReport" data-bs-toggle="collapse" <?= in_array(currentUrl(uri_string()),['paymentReport/transaction-statement', 'paymentReport/operation-statement']) ? 'aria-expanded="true"':''?>>
        <i class="fe-align-justify"  <?= get_global_value('iconColor')!='' ? "style='color:".get_global_value('iconColor').";'":''?> ></i>
        <span> <?= lang('Aside.submenu_history_comment')?> </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="<?= in_array(currentUrl(uri_string()),['payment/transaction-statement']) ? 'collapse show':'collapse'?>" id="payReport">
        <ul class="nav-second-level">
            <li <?= in_array(currentUrl(uri_string()),['payment/transaction-statement']) ? 'class="menuitem-active"':''?>>
                <a <?= in_array(currentUrl(uri_string()),['payment/transaction-statement']) ? 'class="active"':''?> href="<?= site_url('payment/transaction-statement')?>"><?= lang('Aside.transaction')?></a>
            </li>
            <li <?= in_array(currentUrl(uri_string()),['payment/operation-statement']) ? 'class="menuitem-active"':''?>>
                <a <?= in_array(currentUrl(uri_string()),['operation-statement']) ? 'class="active"':''?> href="<?= site_url('payment/operation-statement')?>"><?= lang('Aside.operation')?></a>
            </li>
        </ul>
    </div>
</li>