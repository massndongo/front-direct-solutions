<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= lang('Messages.login_title')?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PLATEFORME DIRECT SOLUTIONS" name="description" />
    <meta content="direct-solution" name="author" />
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
	
    <!-- App css -->
    <link href="<?= base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?= base_url()?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="<?= base_url()?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="<?= base_url()?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="<?= base_url()?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg"  style="background-color: #D02428">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card shadow-none">

                    <div class="card-body p-3">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="<?= base_url()?>" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="<?= base_url()?>/assets/images/apps/logo-dp.png" alt="" height="44">
                                    </span>
                                </a>

                                <a href="<?= base_url()?>" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="<?= base_url()?>/assets/images/apps/logo-dp.png" alt="" height="44">
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3"><?= lang('Messages.login_welcome')?></p>
                        </div>

                        <form action="<?= site_url('authenticate/sign-in')?>" method="post">
                            <div class="mb-3">
                                <div class="form-check">
                                    <?= isset($message) && !empty($message) ? $message:''?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="change_langue" class="form-label"><?= lang('Label.langue')?></label>
                                <select class="form-control" id="change_langue" name="change_langue"  data-toggle="select2" data-width="100%">
                                    <option label="<?= lang('Holder.choice')?>"></option>
                                    <option value="<?= site_url('change-langue/fr')?>" <?= session()->has('lang') && session()->get('lang')==='fr' ? 'selected':''?> ><?= lang('Values.fr')?></option>
                                    <option value="<?= site_url('change-langue/en')?>" <?= session()->has('lang') && session()->get('lang')==='en' ? 'selected':''?> ><?= lang('Values.en')?></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label"><?= lang('Label.username')?></label>
                                <input class="form-control" type="text" id="username" name="username" required="" placeholder="<?= lang('Holder.username')?>" autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label"><?= lang('Label.password')?></label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="<?= lang('Holder.password')?>" autocomplete="off">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center d-grid">
                                <button class="btn btn-danger" style="background-color: #D02428;" type="submit"><?= lang('Btn.log_in')?></button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->


<footer class="footer footer-alt">
    <script>document.write(new Date().getFullYear())</script> &copy; Platform by <a href="http://directpayaccess.com" class="link-dark text-decoration-underline">DIRECT SOLUTIONS</a>
</footer>

<!-- Vendor js -->
<script src="<?= base_url()?>/assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="<?= base_url()?>/assets/js/app.min.js"></script>
<script>
    $("#change_langue").change(function(){
        var _linkUrl = $("#change_langue").val();
        window.location.assign(_linkUrl);
    });
</script>
</body>
</html>