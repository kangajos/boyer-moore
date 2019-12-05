<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url("back-end")?>/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link href="<?=base_url("back-end")?>/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
	<link rel="stylesheet" href="<?=base_url("back-end")?>/assets/libs/css/style.css">
	<link rel="stylesheet" href="<?=base_url("back-end")?>/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
	<style>
		html,
		body {
			height: 100%;
		}

		body {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
		}
	</style>
</head>

<body>
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<div class="splash-container">
	<div class="card ">
		<div class="card-header text-center"><a href="<?=base_url()?>"><h2>EnsiklopediA</h2></a><span class="splash-description">Please enter your user information.</span>

			<h4 class="text-danger text-center"><?=$this->session->flashdata("msg")?></h4>
		</div>
		<div class="card-body">
			<form action="<?=base_url("auth/login_post")?>" method="post">
				<div class="form-group">
					<input class="form-control form-control-lg" name="username" id="username" type="text" placeholder="Username" autocomplete="off">
				</div>
				<div class="form-group">
					<input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Password">
				</div>
				<div class="form-group">
					<label class="custom-control custom-checkbox">
						<input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
					</label>
				</div>
				<button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
			</form>
		</div>
		<div class="card-footer bg-white p-0  ">
			<div class="card-footer-item card-footer-item-bordered">
				<a href="<?=base_url("auth/register")?>" class="footer-link"><i class="fa fa-user"></i> Create An Account</a></div>
			<div class="card-footer-item card-footer-item-bordered">
				<a href="<?=base_url()?>" class="footer-link"><i class="fa fa-home"></i> Home </a>
			</div>
		</div>
	</div>
</div>

<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<script src="<?=base_url("back-end")?>/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="<?=base_url("back-end")?>/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>
