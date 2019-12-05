<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<div class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="text-md-left footer-links d-none d-sm-block">
					<!--					Copyright © 2018 Concept. All rights reserved. Dashboard by-->
					<!--					<a-->
					<!--						href="https://colorlib.com/wp/">Colorlib</a>.-->
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<div class="text-md-right footer-links d-none d-sm-block">
					<a href="javascript: void(0);">About</a>
					<a href="javascript: void(0);">Support</a>
					<a href="javascript: void(0);">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- end footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<!-- jquery 3.3.1 -->
<script src="<?= base_url("back-end") ?>/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js -->
<script src="<?= base_url("back-end") ?>/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js -->
<script src="<?= base_url("back-end") ?>/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<!-- main js -->
<script src="<?= base_url("back-end") ?>/assets/libs/js/main-js.js"></script>
<!-- chart chartist js -->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/vendor/charts/chartist-bundle/chartist.min.js"></script>-->
<!-- sparkline js -->
<script src="<?= base_url("back-end") ?>/assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
<!-- morris js -->
<script src="<?= base_url("back-end") ?>/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
<script src="<?= base_url("back-end") ?>/assets/vendor/charts/morris-bundle/morris.js"></script>
<!-- chart c3 js -->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/vendor/charts/c3charts/c3.min.js"></script>-->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>-->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/vendor/charts/c3charts/C3chartjs.js"></script>-->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/libs/js/dashboard-ecommerce.js"></script>-->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/vendor/datatables/js/buttons.bootstrap4.min.js"></script>-->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>-->
<!--<script src="--><? //=base_url("back-end")?><!--/assets/vendor/datatables/js/data-table.js"></script>-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<?php
$uri = $this->uri->segment(2);

if ($uri == 'buah' || $uri == 'sayuran'):
	$cek = $this->db->select("nama")->where("cek", 0)->get("ensiklopedia_data")->row();
	if (!empty($cek)):
		?>
		<div class="modal fade" id="indexing" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle"
			 aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
				<div class="modal-content" style="background: whitesmoke!important;">
					<div class="modal-header bg-danger text-center header-append" style="align-items: center!important;">
						<h1 class="modal-title text-white text-center" style="align-items: center!important;">
							WARNING!!!!</h1>
						<img class="loading" height="70" width="70" style="border-radius: 5px" src="https://lbpost.com/staff-blog/wp-content/uploads/2014/09/avatar-red.gif" alt="">
<!--										<button class="close" data-dismiss="modal">&times;</button>-->
					</div>
					<div class="modal-body" style="height: 420px !important;">
						<div class="card">
							<div class="card-body res-indexing">
								<h2 class="text-danger">Mohon tunggu...</h2>
								<h3 class="text-primary">1.Sistem sedang melakukan <b>Preprocessing</b> data.</h3>
								<h3 class="text-danger">2.Jangan tutup modal ini sebelum selesai proses.</h3>
								<div class="text-center">
									<img class="loading" height="250" width="250" src="https://lbpost.com/staff-blog/wp-content/uploads/2014/09/avatar-red.gif" alt="">
								</div>
							</div>
						</div>


					</div>
					<div class="modal-footer">
						<button class="btn btn-danger btn-md btn-indexing" disabled data-dismiss="modal">Tutup Modal
						</button>
					</div>
				</div>
			</div>
		</div>
		<script>
            preprocessing();

            function preprocessing() {
                $("#indexing").modal({backdrop: 'static', keyboard: false});
                $.ajax({
					url : '<?=base_url("admin/home/tfidf")?>',
					method : "GET",
					dataType: 'HTML',
					success: function (data) {
						$(".res-indexing").html(data);
						$(".btn-indexing").removeAttr("disabled");
						$(".header-append").html("<h1 class='text-white'>PreProcessing selesai.</h1>")
						$(".loading").hide();
                    }
				})
            }
		</script>

	<?php endif; endif; ?>
<script>
    $(document).ready(function () {
        $('table').DataTable({
            "bProcessing": true,
            "bSort": true,
        });
    });

    //    my script ///

    $(".detail").on("click", function () {
        var id = $(this).data("id");

        $.ajax({
            url: "<?=base_url("admin/buah/detail/")?>" + id,
            method: "GET",
            dataType: "HTML",
            success: function (result) {
                $(".result").html(result);
            }
        })
    });

    $(".edit").on("click", function () {
        var id = $(this).data("id");

        $.ajax({
            url: "<?=base_url("admin/buah/edit/")?>" + id,
            method: "GET",
            dataType: "HTML",
            success: function (result) {
                $(".result_edit").html(result);
            }
        })
    })

    $(".edit_sayur").on("click", function () {
        var id = $(this).data("id");

        $.ajax({
            url: "<?=base_url("admin/sayuran/edit/")?>" + id,
            method: "GET",
            dataType: "HTML",
            success: function (result) {
                $(".result_edit").html(result);
            }
        })
    })
</script>

</body>

</html>
