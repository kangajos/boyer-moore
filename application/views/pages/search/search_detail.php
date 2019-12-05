<section class="ftco-section ftco-degree-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-8 order-md-last ftco-animate">
				<h2 class="mb-3"><?= $content->nama ?></h2>
				<?php
				$foto = $this->db->where("id_master", $content->data_id)->get("ensiklopedia_foto")->result();
				?>
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php foreach ($foto as $key => $item): ?>
							<li data-target="#carouselExampleIndicators"
								data-slide-to="<?= $key ?>" <?= $key == 0 ? 'class="active"' : '' ?>></li>
						<?php endforeach; ?>
					</ol>
					<div class="carousel-inner">

						<?php foreach ($foto as $key => $item): ?>
							<div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
								<img class="d-block w-100" src="<?= base_url("img/$item->jenis_foto") ?>"
									 alt="First slide">
							</div>
						<?php endforeach; ?>
					</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
				<div id="accordion">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h5 class="mb-0 text-center">
								<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
										aria-expanded="true" aria-controls="collapseOne">
									Deskripsi &nbsp;<i class="icon-arrow-down"></i>
								</button>
							</h5>
						</div>

						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
							 data-parent="#accordion">
							<div class="card-body">
								<p><?= $content->deskripsi ?></p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingTwo">
							<h5 class="mb-0 text-center">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
										aria-expanded="false" aria-controls="collapseTwo">
									Kandungan &nbsp;<i class="icon-arrow-down"></i>
								</button>
							</h5>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
							<div class="card-body">
								<p><?= $content->kandungan ?></p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingThree">
							<h5 class="mb-0 text-center">
								<button class="btn btn-link collapsed" data-toggle="collapse"
										data-target="#collapseThree" aria-expanded="false"
										aria-controls="collapseThree">
									Manfaat &nbsp;<i class="icon-arrow-down"></i>
								</button>
							</h5>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree"
							 data-parent="#accordion">
							<div class="card-body">
								<p><?= $content->manfaat ?></p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFor">
							<h5 class="mb-0 text-center">
								<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFor"
										aria-expanded="false" aria-controls="collapseFor">
									Klasifikasi &nbsp;<i class="icon-arrow-down"></i>
								</button>
							</h5>
						</div>
						<div id="collapseFor" class="collapse" aria-labelledby="headingFor" data-parent="#accordion">
							<div class="card-body">
								<p><?= str_replace("\n", "<br>", $content->klasifikasi) ?></p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingFive">
							<h5 class="mb-0 text-center">
								<button class="btn btn-link collapsed" data-toggle="collapse"
										data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
									Sub Klasifikasi &nbsp;<i class="icon-arrow-down"></i>
								</button>
							</h5>
						</div>
						<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
							<div class="card-body">
								<p><?= $content->sub_klasifikasi ?></p>
							</div>
						</div>
					</div>
				</div>

				<div class="tag-widget post-tag-container mb-5 mt-5">
					<div class="tagcloud">
						<a href="#" class="tag-cloud-link">Life</a>
						<a href="#" class="tag-cloud-link">Sport</a>
						<a href="#" class="tag-cloud-link">Tech</a>
						<a href="#" class="tag-cloud-link">Travel</a>
					</div>
				</div>

				<div class="pt-5 mt-5">
					<h3 class="mb-5">6 Comments</h3>
					<ul class="comment-list">
						<li class="comment">
							<div class="vcard bio">
								<img src="<?=base_url("front-end/images/person_1.jpg")?>" alt="Image placeholder">
							</div>
							<div class="comment-body">
								<h3>John Doe</h3>
								<div class="meta">October 03, 2018 at 2:21pm</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
									necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
									iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
								<p><a href="#" class="reply">Reply</a></p>
							</div>
						</li>

						<li class="comment">
							<div class="vcard bio">
								<img src="<?=base_url("front-end/images/person_1.jpg")?>" alt="Image placeholder">
							</div>
							<div class="comment-body">
								<h3>John Doe</h3>
								<div class="meta">October 03, 2018 at 2:21pm</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
									necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente
									iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
								<p><a href="#" class="reply">Reply</a></p>
							</div>
						</li>
					</ul>
					<!-- END comment-list -->

					<div class="comment-form-wrap pt-5">
						<h3 class="mb-5">Leave a comment</h3>
						<form action="#" class="p-5 bg-light">
							<div class="form-group">
								<label for="name">Name *</label>
								<input type="text" class="form-control" id="name">
							</div>
							<div class="form-group">
								<label for="email">Email *</label>
								<input type="email" class="form-control" id="email">
							</div>
							<div class="form-group">
								<label for="website">Website</label>
								<input type="url" class="form-control" id="website">
							</div>

							<div class="form-group">
								<label for="message">Message</label>
								<textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
							</div>

						</form>
					</div>
				</div>

			</div> <!-- .col-md-8 -->
			<div class="col-md-4 sidebar ftco-animate">
				<div class="sidebar-box">
					<form action="<?=base_url("search#result")?>" method="get" class="search-form">
						<div class="form-group">
							<span class="icon icon-search"></span>
							<input type="text" class="form-control" name="q" placeholder="Cari buah dan sayuran disini" required>
						</div>
					</form>
				</div>
				<div class="sidebar-box ftco-animate">
					<div class="categories">
						<h3>Categories</h3>
						<li><a href="#">Buah-buahan <span>(51)</span></a></li>
						<li><a href="#">Sayuran <span>(56)</span></a></li>
					</div>
				</div>

				<div class="sidebar-box ftco-animate">
					<h3>Blog Terkait</h3>
					<?php
					$data = $this->data->getAll(3,$content->data_id);
					foreach ($data as $key => $val) :?>
						<div class="block-21 mb-4 d-flex">
							<?php
							$foto = $this->db->where("id_master", $val->data_id)->get("ensiklopedia_foto")->row();
							?>
							<a class="blog-img mr-4" style="background-image: url('<?=base_url("img/$foto->jenis_foto")?>');"></a>
							<div class="text">
								<h3 class="heading"><a href="<?=base_url("search/detail/$val->data_id")?>"><?=$val->nama?></a></h3>
								<div class="meta">
									<div><a href="<?=base_url("search/detail/$val->data_id")?>"><span class="icon-calendar"></span> <?=$val->created_at?></a></div>
									<div><a href="<?=base_url("search/detail/$val->data_id")?>"><span class="icon-person"></span> Admin</a></div>
									<div><a href="<?=base_url("search/detail/$val->data_id")?>"><span class="icon-chat"></span> 19</a></div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="sidebar-box ftco-animate">
					<h3>Tag Cloud</h3>
					<div class="tagcloud">
						<a href="#" class="tag-cloud-link">buah</a>
						<a href="#" class="tag-cloud-link">buah-buahan</a>
						<a href="#" class="tag-cloud-link">sayuran</a>
						<a href="#" class="tag-cloud-link">sayur</a>
						<a href="#" class="tag-cloud-link">buah-segar</a>
						<a href="#" class="tag-cloud-link">sayur-segar</a>
					</div>
				</div>

				<div class="sidebar-box ftco-animate">
					<h3>Paragraph</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus
						voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur
						similique, inventore eos fugit cupiditate numquam!</p>
				</div>
			</div>

		</div>
	</div>
</section> <!-- .section -->
