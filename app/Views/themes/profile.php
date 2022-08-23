<a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
    <img src="<?= base_url()?>/assets/images/users/user-profile-default-image.png" alt="user-image" class="rounded-circle">
    <span class="pro-user-name ms-1">
        <?= get_global_value('fullname')?><i class="mdi mdi-chevron-down"></i>
    </span>
</a>
<div class="dropdown-menu dropdown-menu-end profile-dropdown ">
    <!-- item-->
    <div class="dropdown-header noti-title">
        <h6 class="text-overflow m-0"><?= lang('Messages.profile_welcome')?></h6>
    </div>

    <!-- item-->
    <a href="<?= site_url('my-profile')?>" class="dropdown-item notify-item">
        <i class="fe-user"></i>
        <span><?= lang('Aside.menu_profile')?></span>
    </a>
    <div class="dropdown-divider"></div>

    <!-- item-->
    <a href="<?= site_url('log-out')?>" class="dropdown-item notify-item">
        <i class="fe-log-out"></i>
        <span><?= lang('Aside.menu_logout')?></span>
    </a>

</div>