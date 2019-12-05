<?php
$this->load->view("admin/partials/head");
$this->load->view("admin/partials/navbar");
$this->load->view("admin/partials/sidebar");
?>
<div class="dashboard-wrapper">
	<div class="dashboard-ecommerce">
		<div class="container-fluid dashboard-content ">
			<!-- ============================================================== -->
			<!-- pageheader  -->
			<!-- ============================================================== -->
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="page-header">
						<h2 class="pageheader-title"><?=$title?></h2>
<!--						<p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel-->
<!--							mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>-->
						<div class="page-breadcrumb">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Data</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?=$title?>
									</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- end pageheader  -->
			<!-- ============================================================== -->
			<div class="ecommerce-widget">

				<div class="row">
					<!--content-->
					<?php $this->load->view($page, $content); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view("admin/partials/footer");
?>

