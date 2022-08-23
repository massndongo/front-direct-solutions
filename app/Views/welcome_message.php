<?=
	$this->extend('themes/themeforest'); /* AIzaSyC62pVK1gSClETTJMwDCT0_vlvjpLbOC5o */
	$this->section('content'); ?>
		<style>
			#map{
				height: 75vh;
				width: 100%;
			}
		</style>
		<!-- start page title -->
		<!--div class="row">
			<div class="col-12">
				<div class="page-title-box">
					<h4 class="page-title"><-?= lang('Aside.menu_dashboard')?></h4>
					<div>
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item active"><-?= lang('Aside.menu_dashboard')?></li>
						</ol>
					</div>
				</div>
			</div>
		</div-->
		<div class="row"><div class="clearfix"></div><br /> </div>
		<div class="row mt-0">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h4 class="header-title"><?= lang('Label.title_search')?></h4>
						<p class="sub-header font-13" >
							<form method="post" action="<?= site_url('dashboard')?>" >
								<div class="row">
									<div class="col-md-3">
										<select class="form-control" id="busId" name="busId" data-toggle="select2" data-width="100%">
											<option label="<?= lang('Label.holder_bus')?>"></option>
											<?php
											if(isset($busList) && is_array($busList) && count($busList)>0):
												foreach($busList as $item): ?>
													<option value="<?= $item->busId?>" <?= isset($busId) && (int)$busId===(int)$item->busId ? 'selected':''?> ><?= $item->busRegistrationNumber?></option> <?php
												endforeach;
											endif;
											?>
										</select>
									</div>
									<div class="col-md-1">
										<button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> </button>
									</div>
								</div>
							</form>
						</p>
					</div>
					<div class="card-body">
						<!-- end page title -->
						<div class="row">
							<div class="col-md-12">
								<div id="map"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	 	<?php
	$this->endSection();
