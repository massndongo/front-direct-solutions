<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title> <?= get_global_value('partnerName')?>&nbsp;|&nbsp;DIRECT SOLUTIONS </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url()?>/assets/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url()?>/assets/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url()?>/assets/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url()?>/assets/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url()?>/assets/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url()?>/assets/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url()?>/assets/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url()?>/assets/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>/assets/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url()?>/assets/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url()?>/assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url()?>/assets/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>/assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?= base_url()?>/assets/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?= base_url()?>/assets/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <?= $this->include('themes/css')?>
    </head>
    <!-- body start -->
    <body class="menuitem-active" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>
        <!-- Begin page -->
        <div id="wrapper" class="show">
            <!-- Topbar Start -->
            <div class="navbar-custom"  <?= !empty(get_global_value('headerColor')) ? 'style="background-color:'.get_global_value('headerColor').';"':'' ?>>
                <div class="container-fluid" style="<?= !empty(get_global_value('headerColor')) ? 'background-color:'.get_global_value('headerColor'):'' ?>">
                    <ul class="list-unstyled topnav-menu float-end mb-0" <?= !empty(get_global_value('headerColor')) ? 'style="background-color:'.get_global_value('headerColor').'"':'' ?>>
                        <li class="dropdown mt-3 d-lg-inline-block m-1">
                            <h3 class="card-title bold font-22 text-white"><span class="font-14"><?= lang('Label.current_balance'); ?>:</span> <?= current_balance(); ?> <sup>Fcfa</sup></h3>
                        </li>
                        <li class="dropdown notification-list topbar-dropdown"  <?= !empty(get_global_value('headerColor')) ? 'style="background-color:'.get_global_value('headerColor').'"':'' ?>>
                            <?= $this->include('themes/profile') ?>
                        </li>
                    </ul>
                    <!-- LOGO -->
                    <div class="logo-box" style="background-color: whitesmoke">
                        <?= $this->include('themes/logo')?>
                    </div>
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">
            <div class="h-100" data-simplebar>
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul id="side-menu">
                        <?= $this->include('themes/aside') ?>
                    </ul>
                </div>
                <!-- End Sidebar -->
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div> <!-- container -->

            </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <!--script>document.write(new Date().getFullYear())</script--><?= gmdate('Y')?> &copy; Platform by <a href="">DIRECT SOLUTIONS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>

        <!-- END wrapper -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <?= $this->include('themes/js')?>

    </body>
</html>