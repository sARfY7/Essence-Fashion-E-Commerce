<?php include("head.php") ?>

	<!-- jquery-steps css -->
	<link rel="stylesheet" href="../vendors/bower_components/jquery.steps/demo/css/jquery.steps.css">

	<!-- bootstrap-touchspin CSS -->
	<link href="../vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"
	/>

<?php include("body.php") ?>


		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-dark">product detail</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li>
								<a href="index.html">Dashboard</a>
							</li>
							<li>
								<a href="#">
									<span>e-commerce</span>
								</a>
							</li>
							<li class="active">
								<span>product detail</span>
							</li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3">
											<div class="item-big">
												<!-- START carousel-->
												<div id="carousel-example-captions-1" data-ride="carousel" class="carousel slide">
													<ol class="carousel-indicators">
														<li data-target="#carousel-example-captions-1" data-slide-to="0" class="active"></li>
														<li data-target="#carousel-example-captions-1" data-slide-to="1"></li>
													</ol>
													<div role="listbox" class="carousel-inner">
														<div class="item active">
															<img src="../img/gallery/mock1.jpg" alt="First slide image"> </div>
														<div class="item">
															<img src="../img/gallery/mock4.jpg" alt="Second slide image"> </div>
													</div>
												</div>
												<!-- END carousel-->
											</div>
										</div>

										<div class="col-md-9">
											<div class="product-detail-wrap">
												<div class="product-rating inline-block mb-10">
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a>
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a>
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a>
													<a href="javascript:void(0);" class="zmdi zmdi-star"></a>
													<a href="javascript:void(0);" class="zmdi zmdi-star-outline"></a>
												</div>
												<div class="average-review inline-block mb-10">&nbsp;(
													<span class="review-count">5</span> customer review)</div>
												<h3 class="mb-20 weight-500">Pure Leather Handbag</h3>
												<div class="product-price head-font mb-30">$ 1234</div>
												<p class="mb-50">Lorem ipsum dolor sit amet, facer velit at per, possit accusamus vim an. Cu vel possit dolorum. Elit placerat
													molestiae mea ne.Ex has movet ornatus, ei usu latine scripta molestiae. Sea ex aeterno adversarium, te ferri
													errem noluisse quo, meis civibus ea est. Sit in quas nostrud.</p>

												<input class="vertical-spin" type="text" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default"
												    value="1" name="vertical-spin">

												<div class="btn-group mr-10">
													<button class="btn btn-success btn-anim">
														<i class="fa fa-shopping-cart"></i>
														<span class="btn-text">add to cart</span>
													</button>
												</div>
												<div class="btn-group wishlist">
													<button class="btn btn-warning btn-outline btn-anim">
														<i class="icon-heart"></i>
														<span class="btn-text">add to wishlist</span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Row -->

				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="tab-struct custom-tab-1 product-desc-tab">
										<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_7">
											<li class="active" role="presentation">
												<a aria-expanded="true" data-toggle="tab" role="tab" id="descri_tab" href="#descri_tab_detail">
													<span>Description</span>
												</a>
											</li>
											<li role="presentation" class="next">
												<a data-toggle="tab" id="adi_info_tab" role="tab" href="#adi_info_tab_detail" aria-expanded="false">
													<span>Aditional information</span>
												</a>
											</li>
											<li role="presentation" class="">
												<a data-toggle="tab" id="review_tab" role="tab" href="#review_tab_detail" aria-expanded="false">
													<span>Review
														<span class="inline-block">(
															<span class="review-count">0</span>)</span>
													</span>
												</a>
											</li>
										</ul>
										<div class="tab-content" id="myTabContent_7">
											<div id="descri_tab_detail" class="tab-pane fade active in pt-0" role="tabpanel">
												<p class="pt-15">Activist, criteria planned giving dignity, committed democratizing the global financial system progressive. Nelson
													Mandela equal opportunity change accelerate pathway to a better life invest our ambitions catalyst. Making progress
													contribution compassion Ford Foundation, cross-agency coordination Bill and Melinda Gates development. Overcome
													injustice tackling activism, promising development equality hack meaningful working families. Foundation; open
													source; organization volunteer, replicable think tank carbon emissions reductions.</p>
											</div>
											<div id="adi_info_tab_detail" class="tab-pane pt-0 fade" role="tabpanel">
												<div class="table-wrap">
													<div class="table-responsive">
														<table class="table  mb-0">
															<tbody>
																<tr>
																	<td class="border-none">SIZE</td>
																	<td class="border-none">31, 32, 33, 34, 35</td>
																</tr>
																<tr>
																	<td>COLOR</td>
																	<td>blue, red, rosa, white</td>
																</tr>
																<tr>
																	<td>TAGS</td>
																	<td>Diesel, shoe, stars</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div id="review_tab_detail" class="tab-pane pt-0 fade" role="tabpanel">
												<p class="muted review-tag pt-15">No reviews yet.</p>
												<div class="row mt-40">
													<div class="col-sm-6">
														<div class="form-wrap">
															<form>
																<div class="form-group">
																	<label class="control-label mb-10" for="review">Your rating</label>
																	<div class='product-rating starrr' id='star1'></div>
																</div>
																<div class="form-group">
																	<label class="control-label mb-10" for="review">Your review</label>
																	<textarea class="form-control" id="review" placeholder="add review"></textarea>
																</div>
																<div class="row">
																	<div class="col-sm-6">
																		<div class="form-group">
																			<label class="control-label mb-10" for="exampleInputuname_2">User Name</label>
																			<input type="text" class="form-control" id="exampleInputuname_2" placeholder="Username" />
																		</div>
																	</div>
																	<div class="col-sm-6">
																		<div class="form-group">
																			<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
																			<input type="email" class="form-control" id="exampleInputEmail_2" placeholder="Enter email">
																		</div>
																	</div>
																</div>

																<div class="form-group mb-0">
																	<button type="submit" class="btn btn-success  mr-10">Submit</button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
			</div>

		</div>
		<!-- /Main Content -->

	</div>
	<!-- /#wrapper -->

	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Form Wizard JavaScript -->
	<script src="../vendors/bower_components/jquery.steps/build/jquery.steps.min.js"></script>

	<!-- Bootstrap Touchspin JavaScript -->
	<script src="../vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

	<!-- Starrr JavaScript -->
	<script src="dist/js/starrr.js"></script>

	<!-- Product Detail Data JavaScript -->
	<script src="dist/js/product-detail-data.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- Owl JavaScript -->
	<script src="../vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

	<!-- Switchery JavaScript -->
	<script src="../vendors/bower_components/switchery/dist/switchery.min.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>

	<script>
		$(function () {
			$("#product-detail").addClass("active-page");
		});
	</script>

</body>

</html>