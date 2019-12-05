<div class="card" style="border: unset!important;">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
				<tr>
					<th>NO</th>
					<th>TERM</th>
					<th>TF</th>
					<th>IDF</th>
					<th>WEIGHTING</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($tfidf as $key => $item):?>
					<tr>
						<td><?=$key+1?></td>
						<td><?=$item->term?></td>
						<td><?=$item->tf?></td>
						<td><?=$item->idf?></td>
						<td><?=$item->w?></td>
					</tr>
				<?php endforeach;?>
				<tr></tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
