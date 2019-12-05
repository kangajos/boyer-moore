<div class="card" style="width: 100% !important;">
	<div class="card-body">
		<div class="form-group">
			<a href="#" data-target="#tamabah" data-toggle="modal" class="btn btn-primary">Tambah Data</a>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="example2">
				<thead>
				<tr>
					<th>#</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Email</th>
					<th>Keahlian</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($content as $key => $item): ?>
					<tr>
						<td><?=$key+1?></td>
						<td><?=$item->nama?></td>
						<td><?=$item->username?></td>
						<td><?=$item->email?></td>
						<td><?=$item->keahlian?></td>
						<td>
							<a href="#" class="btn btn-block btn-primary">EDIT</a>
							<a href="#" class="btn btn-block btn-danger" onclick="return confirm('Yakin ?')">HAPUS</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
