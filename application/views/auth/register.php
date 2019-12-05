<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>EnsiklopediA| Register</title>
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
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->
<form class="splash-container" action="<?=base_url("auth/register_post")?>" method="post">
	<div class="card">
		<div class="card-header">
			<h3 class="mb-1">Registrations Form <b>EnsiklopediA</b></h3>
			<p>Please enter your user information.</p>
		</div>
		<div class="card-body">
			<h4 class="text-danger"><?=$this->session->flashdata("msg")?></h4>
			<div class="form-group">
				<input class="form-control form-control-lg" type="text" name="nama" required placeholder="Full Name" autocomplete="off">
			</div>
			<div class="form-group">
				<input class="form-control form-control-lg" type="text" name="username" required="" placeholder="Username" autocomplete="off">
			</div>
			<div class="form-group">
				<input class="form-control form-control-lg" type="email" name="email" required="" placeholder="E-mail" autocomplete="off">
			</div>
			<div class="form-group">
				<input class="form-control form-control-lg" id="pass1" type="password" name="password1" required="" placeholder="Password">
			</div>
			<div class="form-group">
				<input class="form-control form-control-lg" required="" name="password2" placeholder="Confirm">
			</div>
			<div class="form-group pt-2">
				<button class="btn btn-block btn-primary" type="submit">Register My Account</button>
				<a href="<?=base_url()?>" class="btn btn-block btn-info"><i class="fa fa-home"></i> Home </a>
			</div>
			<!-- <div class="form-group">
				<label class="custom-control custom-checkbox">
					<input class="custom-control-input" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
				</label>
			</div> -->
			<!-- <div class="form-group row pt-0">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
					<button class="btn btn-block btn-social btn-facebook " type="button">Facebook</button>
				</div>
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="btn  btn-block btn-social btn-twitter" type="button">Twitter</button>
				</div>
			</div> -->
		</div>
		<div class="card-footer bg-white">
			<p>Already member? <a href="<?=base_url("auth")?>" class="text-secondary">Login Here.</a></p>
		</div>
	</div>
</form>
</body>


</html>
