<div class="hero-wrap ftco-degree-bg" style="background-image: url('<?= base_url() ?>front-end/bg/bg-home.jpg');"
	 data-stellar-background-ratio="0.5">
	<div class=""></div>
	<div class="container">
		<div class="row no-gutters slider-text justify-content-center align-items-center">
			<div class="col-lg-8 col-md-6 ftco-animate d-flex align-items-end">
				<div class="text text-center">
					<h1 class="mb-4"
						style="background: #3cb371a6; border-top-right-radius: 50px; border-top-left-radius: 50px; color: greenyellow">
						<b>EnsiklopediA ???</b></h1>
					<p style="font-size: 18px;color: white;background: #3cb371a6; border-bottom-right-radius: 50px;border-bottom-left-radius: 50px;">
						EnsiklopediA adalah tempat sarana belajar online buah-buahan dan sayuran lokal Jember, Kamu
						dapat mempelajari jenis buah-buahan dan sayuran lokal Jember disini dengan <b style="color: red; background: greenyellow;border: 1px solid red; padding: 3px;border-radius: 5px; z-index: 999!important;">GRATIS!!!</b><br>
						Selain itu kamu bisa melakukan pencarian data buah dan sayuran dibawah ini.
					</p>
					<form action="<?= base_url("search#result") ?>" class="search-location mt-md-5">
						<div class="row justify-content-center">
							<div class="col-lg-10 align-items-end">
								<div class="form-group">
									<div class="form-field">
										<input type="text" class="form-control" name="q"
											   placeholder="Cari buah dan sayuran disini" required style="border: 1px solid #23a26e !important;">
										<button class="btn btn-primary"><span class="ion-ios-search"></span></button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="mouse">
		<a href="#" class="mouse-icon">
			<div class="mouse-wheel"><span class="ion-ios-arrow-round-down"></span></div>
		</a>
	</div>
</div>
<div class="mt-5"></div>
<section class="ftco-section ftco-no-pt">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<span class="subheading">Blog</span>
				<h2>Buah & Sayuran</h2>
			</div>
		</div>
		<div class="row d-flex">
			<?php foreach ($content as $key => $item): ?>
				<div class="col-md-3 d-flex ftco-animate mb-4">
					<div class="blog-entry justify-content-end">
						<div class="text">
							<h3 class="heading text-success flex-grow-1">
								<a
									href="<?= base_url("search/detail/$item->data_id") ?>"><?= strlen($item->nama)< 26 ? $item->nama : substr($item->nama, 0,29)."..." ?></a>
							</h3>

							<div class="meta mb-3">
								<div>
									<a href="<?= base_url("search/detail/$item->data_id") ?>"><?= $item->created_at ?></a>
								</div>
								<div><a href="<?= base_url("search/detail/$item->data_id") ?>">Admin</a></div>
								<div><a href="<?= base_url("search/detail/$item->data_id") ?>" class="meta-chat"><span
											class="icon-chat"></span> 3</a></div>
							</div>
							<?php
							$foto = $this->db->where("id_master", $item->data_id)->get("ensiklopedia_foto")->row();
							?>
							<a href="<?= base_url("search/detail/$item->data_id") ?>" class="block-20 img"
							   style="background-image: url('<?= base_url("img/$foto->jenis_foto") ?>');">
							</a>
							<p class="text-justify"><?= strlen($item->deskripsi) > 150 ? substr($item->deskripsi, 0, 150) . " ..." : $item->deskripsi ?></p>
							<a href="<?= base_url("search/detail/$item->data_id") ?>"
							   class="btn btn-primary btn-sm btn-block">Baca Selengkapnya <i
									class="icon-arrow-circle-right"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
