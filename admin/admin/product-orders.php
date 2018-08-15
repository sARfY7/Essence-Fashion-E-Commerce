<?php include("db_connection.php") ?>
<?php include("head.php") ?>

	<!-- vector map CSS -->
	<link href="../vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css"/>
	
	<!-- Custom Fonts -->
    <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
	<!-- Data table CSS -->
	<link href="../vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<?php include("body.php") ?>	
		
        
		<!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">product orders</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					  <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>e-commerce</span></a></li>
						<li class="active"><span>product-orders</span></li>
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
								<div class="panel-body row">
									<div class="table-wrap">
										<div class="table-responsive">
											<table class="table display responsive product-overview mb-30" id="myTable">
												<thead>
													<tr>
														<th>Name</th>
														<th>Order ID</th>
														<th>Photo</th>
														<th>Name</th>
														<th>Date</th>
														<th>Color</th>
														<th>Size</th>
														<th>Delivery Address</th>
													</tr>
												</thead>
												<tbody>
												<?php
													$get_orders = "SELECT   orders.id, 
																			orders.date,
																			orders.delivery_address,
																			users.first_name,
																			users.last_name,
																			ordered_products.prod_color,
																			ordered_products.prod_size,
																			products.prod_name,
																			products.prod_img
																	FROM 	orders
																	INNER JOIN ordered_products
																		ON ordered_products.order_id = orders.id
																	INNER JOIN products
																		ON products.id = ordered_products.prod_id
																	INNER JOIN users
																		ON users.id = orders.user_id";
													$get_orders_res = mysqli_query($conn, $get_orders);
													if (mysqli_num_rows($get_orders_res) > 0) {
														while($order = mysqli_fetch_assoc($get_orders_res)) {
												?>
													<tr>
														<td class="txt-dark"><?php echo $order["first_name"]." ".$order["last_name"]  ?></td>
														<td class="txt-dark"><?php echo $order["id"]  ?></td>
														<td>
															<img src="../../<?php echo $order["prod_img"]  ?>" alt="iMac" width="80">
														</td>
														<td><?php echo $order["prod_name"]  ?></td>
														<td><?php echo $order["date"]  ?></td>
														<td><?php echo $order["prod_color"]  ?></td>
														<td><?php echo $order["prod_size"]  ?></td>
														<td><?php echo $order["delivery_address"]  ?></td>
													</tr>
												<?php
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
    
	<!-- Data table JavaScript -->
	<script src="../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="dist/js/productorders-data.js"></script>
	
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
			$("#product-order").addClass("active-page");
		});
	</script>
	
</body>

</html>
