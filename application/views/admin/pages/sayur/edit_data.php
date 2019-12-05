<div class="modal-header">
	<h3 class="modal-title">Edit Data</h3>
	<button class="close" data-dismiss="modal">&times;</button>
</div>
<form action="<?= base_url("admin/sayuran/update_post") ?>" method="post" enctype="multipart/form-data">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Nama Buah</label>
					<input type="hidden" name="data_id" value="<?= $content->data_id ?>" required>
					<input type="text" name="nama" value="<?= $content->nama ?>" class="form-control"
						   placeholder="Masukkan nama buah.."
						   required>
				</div>
				<div class="form-group">
					<label for="">Jenis Buah</label>
					<input type="text" name="jenis" value="<?= $content->jenis ?>" class="form-control"
						   placeholder="Masukkan jenis buah" autofocus="autofocus"
						   required>
				</div>
				<div class="form-group">
					<label for="">Deskripsi</label>
					<textarea name="deskripsi" id="" class="form-control" rows="8"
							  placeholder="Masukkan deskripsi"><?= $content->deskripsi ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<h4>Foto :</h4>
				<div class="form-group row">
					<?php foreach ($foto as $item): ?>
						<div class="col-md-6 text-center">
							<img src="<?= base_url("img/$item->jenis_foto") ?>" alt="Foto"
								 style="height: 150px;width: 150px; padding: 3px;"><br>
							<a href="#" onclick="return confirm('Yakin ?')" class="text-danger"><span class="badge badge-danger">Hapus</span></a>
						</div>

					<?php endforeach; ?>
				</div>

				<input type="file" name="userfile" multiple>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Kandungan</label>
					<textarea name="kandungan" id="" class="form-control" rows="8"
							  placeholder="Masukkan kandungan"><?= $content->kandungan ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Manfaat</label>
					<textarea name="manfaat" id="" class="form-control" rows="8"
							  placeholder="Masukkan manfaat"><?= $content->manfaat ?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Klasifikasi</label>
					<textarea name="klasifikasi" id="" class="form-control" rows="8"
							  placeholder="Masukkan klasifikasi"><?= $content->klasifikasi ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Sub Klasifikasi</label>
					<textarea name="sub_klasifikasi" id="" class="form-control" rows="8"
							  placeholder="Masukkan sub klasifikasi"><?= $content->sub_klasifikasi ?></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-primary btn-md">Simpan</button>
		<button type="reset" class="btn btn-danger btn-md">Reset</button>
		<button type="reset" class="btn btn-warning btn-md" data-dismiss="modal">Batal</button>
	</div>
</form>
