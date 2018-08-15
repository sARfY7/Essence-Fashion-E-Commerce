<?php require("db_connection.php") ?>
<?php include("head.php") ?>

	<!--alerts CSS -->
	<link href="../vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
	
	<!-- Custom Fonts -->
    <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
	<!-- Calendar CSS -->
	<link href="../vendors/bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>

	<!-- Data table CSS -->
	<link href="../vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<?php include("body.php") ?>
		
        
        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">product catalog</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.php">Dashboard</a></li>
						<li><a href="#"><span>e-commerce</span></a></li>
						<li class="active"><span>products</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<!-- Product Row -->
				<div class="row">
					<!-- Responsive Table -->
					<div class="col-lg-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Products </h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">	
									<div class="table-wrap mt-5">
										<div class="table-responsive">
											<table class="table mb-0">
											<thead>
													<tr>
														<th>ID</th>
														<th>Name</th>
														<th>Category</th>
														<th>Price</th>
														<th>Color</th>
														<th>Size</th>
														<th>Brand</th>
													</tr>
												</thead>
												<tbody id="products">
													<?php
														$get_prod = "SELECT products.id, products.prod_name, product_category.prod_cat_name, products.prod_price, brands.brand_name
																		FROM products
																		INNER JOIN product_category ON products.prod_cat_id = product_category.id
																		INNER JOIN product_detail ON products.id = product_detail.prod_id
																		INNER JOIN brands ON product_detail.prod_brand_id = brands.id";
														$exec_qry = mysqli_query($conn, $get_prod);
														if (mysqli_num_rows($exec_qry) > 0) {
															while($product = mysqli_fetch_assoc($exec_qry)) {
																echo '<tr>';
																	echo '<td>'. $product["id"] .'</td>';
																	echo '<td>'. $product["prod_name"] .'</td>';
																	echo '<td>'. $product["prod_cat_name"] .'</td>';
																	echo '<td>&#x20B9; '. $product["prod_price"] .'</td>';
																	echo '<td>';
																	$p_id = $product["id"];
																	$get_color = "SELECT * FROM product_colors WHERE prod_id = \"$p_id\"";
																	$get_color_res = mysqli_query($conn, $get_color);
																	if (mysqli_num_rows($get_color_res) > 0) {
																		while($color = mysqli_fetch_assoc($get_color_res)) {
																			echo '<ul>';
																			echo '<li>'. $color["color"] .'</li>';
																			echo '</li>';
																		}
																	}
																	echo '</td>';
																	echo '<td>';
																	$get_size = "SELECT * FROM product_sizes WHERE prod_id = \"$p_id\"";
																	$get_size_res = mysqli_query($conn, $get_size);
																	if (mysqli_num_rows($get_size_res) > 0) {
																		while($size = mysqli_fetch_assoc($get_size_res)) {
																			echo '<ul>';
																			echo '<li>'. $size["size"] .'</li>';
																			echo '</li>';
																		}
																	}
																	echo '</td>';
																	echo '<td>'. $product["brand_name"] .'</td>';
																echo '</tr>';
															}
														} else {
															echo "0 results";
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Row -->
				
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
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="../vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Sweet-Alert  -->
	<script src="../vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
	<script src="dist/js/sweetalert-data.js"></script>
		
	<!-- Switchery JavaScript -->
	<script src="../vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
		
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>

	<!-- Data table JavaScript -->
	<script src="../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

	<script>
		$(function () {
			$("#product").addClass("active-page");
		});
	</script>
	
</body>

</html>
