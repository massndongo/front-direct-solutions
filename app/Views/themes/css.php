<!-- Plugins css -->
<link href="<?= base_url()?>/assets/libs/nestable2/jquery.nestable.min.css" rel="stylesheet" />
<!-- Plugins css -->
<link href="<?= base_url()?>/assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>/assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
<!-- Sweet Alert-->
<link href="<?= base_url()?>/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<!-- Form-picker css -->
<link href="<?= base_url()?>/assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url()?>/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>/assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- third party css -->
<link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->
<!-- jsTree css-->
<link href="<?= base_url()?>/assets/vakata/jstree/dist/themes/default/style.min.css" rel="stylesheet" />

<!-- Plugins css -->
<link href="<?= base_url()?>/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url()?>/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="<?= base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
<link href="<?= base_url()?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

<link href="<?= base_url()?>/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
<link href="<?= base_url()?>/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
<!-- icons -->
<link href="<?= base_url()?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- INTL-->
<link rel="stylesheet" href="<?= base_url()?>/assets/build/css/intlTelInput.css">

<?php
    if(currentUrl(uri_string()) === "dashboard/"): ?>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <?php
    endif;