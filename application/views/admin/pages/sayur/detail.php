<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h1><?=$content->nama?></h1>
				<h3><?=$content->jenis?></h3>
				<p class="text-justify"><?=$content->deskripsi?></p>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-body float-left">
				<h4>Foto :</h4>
				<?php foreach ($foto as $item):?>
					<img src="<?=base_url("img/$item->jenis_foto")?>" alt="Foto" style="height: 150px;width: 150px; padding: 3px;">
				<?php endforeach;?>

			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4>Kandungan : </h4>
				<p><?=$content->deskripsi?></p>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4>Manfaat :</h4>
				<p><?=$content->manfaat?></p>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4>Klasifikasi :</h4>
				<p><?=$content->klasifikasi?></p>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-body">
				<h4>Sub Klasifikasi :</h4>
				<p><?=$content->sub_klasifikasi?></p>
			</div>
		</div>
	</div>
</div>
