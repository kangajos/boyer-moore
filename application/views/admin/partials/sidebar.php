<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
	<div class="menu-list">
		<nav class="navbar navbar-expand-lg navbar-light">
			<a class="d-xl-none d-lg-none" href="#">Dashboard</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav flex-column">
					<li class="nav-divider">
						Menu
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url("admin")?>"><i class="fa fa-fw fa-user-circle"></i> Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url("admin/buah")?>"><i class="fa fa-fw fa-database"></i> Data Buah</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url("admin/sayuran")?>"><i class="fa fa-fw fa-database"></i> Data Sayur</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url("admin/user")?>"><i class="fa fa-fw fa-user-plus"></i> Data User</a>
					</li>
					<li class="nav-item">
<!--						<a class="nav-link" href="--><?//=base_url("admin/user/ganti_password")?><!--"><i class="fa fa-fw fa-lock"></i> Ganti Password</a>-->
					</li>
<!--					<li class="nav-item ">-->
<!--						<a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>-->
<!--						<div id="submenu-1" class="collapse submenu" style="">-->
<!--							<ul class="nav flex-column">-->
<!--								<li class="nav-item">-->
<!--									<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">E-Commerce</a>-->
<!--									<div id="submenu-1-2" class="collapse submenu" style="">-->
<!--										<ul class="nav flex-column">-->
<!--											<li class="nav-item">-->
<!--												<a class="nav-link" href="index.html">E Commerce Dashboard</a>-->
<!--											</li>-->
<!--											<li class="nav-item">-->
<!--												<a class="nav-link" href="ecommerce-product.html">Product List</a>-->
<!--											</li>-->
<!--											<li class="nav-item">-->
<!--												<a class="nav-link" href="ecommerce-product-single.html">Product Single</a>-->
<!--											</li>-->
<!--											<li class="nav-item">-->
<!--												<a class="nav-link" href="ecommerce-product-checkout.html">Product Checkout</a>-->
<!--											</li>-->
<!--										</ul>-->
<!--									</div>-->
<!--								</li>-->
<!---->
<!--							</ul>-->
<!--						</div>-->
<!--					</li>-->
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url("auth/out")?>" onclick="return confirm('Yakin ingin keluar ?')"><i class="fa fa-fw fa-power-off"></i> Logout</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
