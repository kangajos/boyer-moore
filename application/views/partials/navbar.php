<style>
	.myshadow {
		box-shadow: 0px 15px 10px -13px yellowgreen !important;
	}
	.nav-link{
		color: white !important;
	}
	.navbar-brand:hover{
		text-shadow: 0px 2px 2px green;
		font-family: Consolas, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace;
	}
</style>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light myshadow" id="ftco-navbar"
	 style="top: unset; background: #23a26e !important; opacity: 0.8;">
	<div class="container">
		<style>
			.navbar-brand:hover {
				color: #0f6674 !important;
			}
		</style>
		<a class="navbar-brand" href="<?= base_url("") ?>"><h4 style="font-weight: bolder; color: yellow;
		font-family: Consolas, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace;">EnsiklopediA</h4></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
				aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item"><a href="<?= base_url() ?>" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="<?= base_url("auth/register") ?>" class="nav-link">Register</a></li>
				<li class="nav-item"><a href="<?= base_url("auth") ?>" class="nav-link">Login</a></li>
				<li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
			</ul>
		</div>
	</div>
</nav>
<!-- END nav -->

