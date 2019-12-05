<footer class="ftco-footer ftco-section" id="contact">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Uptown</h2>
					<p>Far far away, behind the word mountains, far from the countries.</p>
					<ul class="ftco-footer-social list-unstyled mt-5">
						<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4 ml-md-4">
					<h2 class="ftco-heading-2">Community</h2>
					<ul class="list-unstyled">
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Search Properties</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>For Agents</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Reviews</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>FAQs</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4 ml-md-4">
					<h2 class="ftco-heading-2">About Us</h2>
					<ul class="list-unstyled">
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Our Story</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Meet the team</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Careers</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Company</h2>
					<ul class="list-unstyled">
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>About Us</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Press</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
						<li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Careers</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Have a Questions?</h2>
					<div class="block-23 mb-3">
						<ul>
							<li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span>
							</li>
							<li><a href="#"><span class="icon icon-phone"></span><span
										class="text">+2 392 3929 210</span></a></li>
							<li><a href="#"><span class="icon icon-envelope pr-4"></span><span class="text">info@yourdomain.com</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">

				<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>document.write(new Date().getFullYear());</script>
					All rights reserved | This template is made with <i class="icon-heart color-danger"
																		aria-hidden="true"></i> by <a
						href="https://colorlib.com" target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				<p><a href="#top" class="btn btn-outline-success mb-3" id="top">Scroll Top <i class="icon-arrow-circle-up"></i></a></p>
			</div>
		</div>
	</div>
</footer>


<!-- loader -->
<div id="ftco-loader" class="show fullscreen">
	<svg class="circular" width="48px" height="48px">
		<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
		<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00"/>
	</svg>
</div>
<script src="<?= base_url() ?>front-end/js/jquery.min.js"></script>
<script src="<?= base_url() ?>front-end/js/jquery-migrate-3.0.1.min.js"></script>
<script src="<?= base_url() ?>front-end/js/popper.min.js"></script>
<script src="<?= base_url() ?>front-end/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>front-end/js/jquery.easing.1.3.js"></script>
<script src="<?= base_url() ?>front-end/js/jquery.waypoints.min.js"></script>
<script src="<?= base_url() ?>front-end/js/jquery.stellar.min.js"></script>
<script src="<?= base_url() ?>front-end/js/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>front-end/js/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url() ?>front-end/js/aos.js"></script>
<script src="<?= base_url() ?>front-end/js/jquery.animateNumber.min.js"></script>
<script src="<?= base_url() ?>front-end/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>front-end/js/jquery.timepicker.min.js"></script>
<script src="<?= base_url() ?>front-end/js/scrollax.min.js"></script>
<!--<script src="--><? //=base_url()?><!--front-end/https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>-->
<!--<script src="--><? //=base_url()?><!--front-end/js/google-map.js"></script>-->
<script src="<?= base_url() ?>front-end/js/main.js"></script>
<?php if ($this->uri->segment(1) == "search"):?>
<script>
	$(".tf-idf").on("click", function (e) {
	    e.preventDefault();
	    var data_id = $(this).data("id");
	    var cosine = $(this).data("cosine");
        $("#modal-tf-id").modal("show");
        $(".res-tf-id").html('<h3 class="text-center text-danger"><em>Sedang mengambil data . . .</em></h3>');
        $.ajax({
			url : '<?=base_url("search/tf_idf/")?>'+data_id,
			method : 'GET',
			dataType : "HTML",
			success : function (html) {
			    $(".res-tf-id").html(html);
			    $(".cosine").html("<h2 class='text-success font-bold'>Cosine: "+cosine+"</h2>");
            }
		})
    })
</script>
<style>
	.modal-dialog {
		overflow-y: initial !important
		/*width: 800 !important;*/
	}

	.modal-body {
		height: 390px;
		overflow-y: auto;
	}
</style>
<div class="modal fade" role="dialog" id="modal-tf-id">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header text-center bg-success">
				<h2 class="modal-title text-white text-center">HASIL KOMPUTASI TF-IDF</h2>
				<button class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body res-tf-id">

			</div>
			<div class="modal-footer text-center" style="justify-content: center!important;">
				<button class="btn btn-outline-success btn-lg cosine"></button>
<!--				<button class="btn btn-success btn-lg" data-dismiss="modal">Tutup Modal</button>-->
			</div>
		</div>
	</div>
</div>
<?php endif;?>
</body>
</html>
