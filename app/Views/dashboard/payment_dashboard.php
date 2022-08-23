<?= $this->extend('themes/themeforest'); $this->section('content'); ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><?= lang("Aside.menu_dashboard") ?></h4>
            <div>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active"><?= lang("Aside.menu_dashboard").' ' ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card bg-purple shadow-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-light">
                            <i class="fe-bar-chart-line- font-28 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h2 class="text-white mt-2">$<span data-plugin="counterup">92,847</span></h2>
                            <p class="text-white mb-0 text-truncate">Statistics</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card bg-info shadow-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-light">
                            <i class="fe-users font-28 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h2 class="text-white mt-2"><span data-plugin="counterup">56</span>k</h2>
                            <p class="text-white mb-0 text-truncate">Users Today</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card bg-pink shadow-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-light">
                            <i class="fe-shuffle font-28 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h2 class="text-white mt-2"><span data-plugin="counterup">2568</span></h2>
                            <p class="text-white mb-0 text-truncate">Request Per Minute</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card bg-success shadow-none">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-light">
                            <i class="fe-download font-28 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h2 class="text-white mt-2"><span data-plugin="counterup">523</span></h2>
                            <p class="text-white mb-0 text-truncate">New Downloads</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
</div>
<!-- end row-->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    </div>
                </div>

                <h4 class="header-title mb-3"><?= lang("Label.recent_trx") ?></h4>

                <div class="table-responsive">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>ASOS Ridley High Waist</td>
                            <td>$79.49</td>
                            <td>82</td>
                            <td><span class="badge text-success border border-success">Active</span></td>
                            <td>$6,518.18</td>
                        </tr>
                        <tr>
                            <td>Marco Lightweight Shirt</td>
                            <td>$128.50</td>
                            <td>37</td>
                            <td><span class="badge text-warning border border-warning">Pending</span></td>
                            <td>$4,754.50</td>
                        </tr>
                        <tr>
                            <td>Half Sleeve Shirt</td>
                            <td>$39.99</td>
                            <td>64</td>
                            <td><span class="badge text-primary border border-primary">Done</span></td>
                            <td>$2,559.36</td>
                        </tr>
                        <tr>
                            <td>Lightweight Jacket</td>
                            <td>$20.00</td>
                            <td>184</td>
                            <td><span class="badge text-info border border-info">Progress</span></td>
                            <td>$3,680.00</td>
                        </tr>
                        <tr>
                            <td>Marco Shoes</td>
                            <td>$28.49</td>
                            <td>69</td>
                            <td><span class="badge text-warning border border-warning">Pending</span></td>
                            <td>$1,965.81</td>
                        </tr>
                        <tr>
                            <td>ASOS Ridley High Waist</td>
                            <td>$79.49</td>
                            <td>82</td>
                            <td><span class="badge text-primary border border-primary">Done</span></td>
                            <td>$6,518.18</td>
                        </tr>
                        </tbody>
                    </table>
                </div> <!-- end table responsive-->
            </div>
        </div>
    </div>

</div>
<!-- end row -->
<?php
$this->endSection();