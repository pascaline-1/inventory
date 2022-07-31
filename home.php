<?php include 'access.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $loggedUser['userType']; ?> | Ahabanza</title>
	<?php include 'dashboardhead.php'; ?>
	
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		
		<!-- begin top bar  -->
		<?php include 'topheader.php'; ?>
		<!-- end top bar -->

		<!-- begin sidebar -->
		<?php include 'sidebar.php'; ?>
		<!-- end sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="./">Ahabanza</a></li>
				<li class="active">Incamake</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Shop <small>Uko iduka rihagaze muri make.</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-4 -->
				<div class="col-md-4">
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							</div>
							<h4 class="panel-title">Todays' Analytics Details</h4>
						</div>
						<div class="panel-body p-t-0">
							<table class="table table-valign-middle m-b-0">
								<thead>
									<tr>	
										<th>Item</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><label class="label label-primary">Ibyaranguwe byishyuwe</label></td>
										<td>
										 	<?php 
										 		$today = date('Y/m/d'); 
										 		$todaypaidpurchase = $db->query("SELECT SUM(trPayedAmount) AS total FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y/%m/%d') = '$today' AND `trOperation`='In'");
										 		$paidintransaction = mysqli_fetch_array($todaypaidpurchase);
										 		echo number_format($paidintransaction['total']).' Rwf';
										 	?>
										</td>
									</tr>
									<tr>
										<td><label class="label label-primary">Ibyaranguwe kw'idene</label></td>
										<td>
										 	<?php 
										 		$today = date('Y/m/d'); 
										 		$todayunpaidpurchase = $db->query("SELECT SUM(trNonPaidAmount) AS total FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y/%m/%d') = '$today' AND `trOperation`='In'");
										 		$unpaidintransaction = mysqli_fetch_array($todayunpaidpurchase);
										 		echo number_format($unpaidintransaction['total']).' Rwf';
										 	?>
										</td>
									</tr>
									<tr>
										<td><label class="label label-success">Ibyagurishijwe Byishyuwe</label></td>
										<td>
										 	<?php 
										 		$today = date('Y/m/d'); 
										 		$todaypaidsales = $db->query("SELECT SUM(trPayedAmount) AS total FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y/%m/%d') = '$today' AND `trOperation`='Out'");
										 		$paidouttransaction = mysqli_fetch_array($todaypaidsales);
										 		echo number_format($paidouttransaction['total']).' Rwf';
										 	?>
										</td>
									</tr>
									<tr>
										<td><label class="label label-success">Ibyagurishijwe kw'idene</label></td>
										<td>
										 	<?php 
										 		$today = date('Y/m/d'); 
										 		$todayunpaidsales = $db->query("SELECT SUM(trNonPaidAmount) AS total FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y/%m/%d') = '$today' AND `trOperation`='Out'");
										 		$unpaidouttransaction = mysqli_fetch_array($todayunpaidsales);
										 		echo number_format($unpaidouttransaction['total']).' Rwf';
										 	?>
										</td>
									</tr>
									<tr>
										<td>
											<?php  
												if ($paidintransaction['total'] < $paidouttransaction['total']) {
													$paidprofit =$paidouttransaction['total'] - $paidintransaction['total'];
													?>
													<label class="label label-success">Ayungutswe yishyuwe</label>
													<?php
												}
												else {
													$paidprofit = $paidintransaction['total'] - $paidouttransaction['total'];
													?>
													<label class="label label-danger">Ayahombwe yishyuwe</label>
													<?php
												}
											?>
										</td>
										<td><?php echo number_format($paidprofit) ?> Rwf <span class="text-success"><i class="fa fa-arrow-up"></i></span></td>
									</tr>
									<tr>
										<td>
											<?php  
												if ($unpaidintransaction['total'] < $unpaidouttransaction['total']) {
													$loanprofit = $unpaidouttransaction['total'] - $unpaidintransaction['total'];
													?>
													<label class="label label-success">Ayungutswe atishyuwe</label>
													<?php
												}
												else {
													$loanprofit = $unpaidintransaction['total'] - $unpaidouttransaction['total'];
													?>
													<label class="label label-danger">Ayahombwe atishyuwe</label>
													<?php
												}
											?>
										</td>
										<td><?php echo number_format($loanprofit) ?> Rwf</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- end col-4 -->
				<!-- begin col-8 -->
				<div class="col-md-8">
					<!-- begin row -->
					<div class="row">
						<!-- begin col-3 -->
						<div class="col-md-4 col-sm-6">
							<div class="widget widget-stats bg-green">
								<div class="stats-icon"><i class="fa fa-bar-chart-o"></i></div>
								<div class="stats-info">
									<h4>IBICURUZWA</h4>
									<p>
										<?php  
											$getallproducts = $db ->query("SELECT * FROM `products`");
											echo number_format(mysqli_num_rows($getallproducts));
										?>
									</p>	
								</div>
								<div class="stats-link">
									<a href="stock">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
						</div>
						<!-- end col-3 -->
						<!-- begin col-3 -->
						<div class="col-md-4 col-sm-6">
							<div class="widget widget-stats bg-red">
								<div class="stats-icon"><i class="fa fa-bank"></i></div>
								<div class="stats-info">
									<h4>AMADENE</h4>
									<h4>
										<?php  
											$getclientsloans = $db ->query("SELECT * FROM `transactions` WHERE `trPaymentStatus` != 'Full Paid' AND `trOperation`='Out'");
											$getourloans = $db ->query("SELECT * FROM `transactions` WHERE `trPaymentStatus` != 'Full Paid' AND `trOperation`='In'");
											?>
											<table>
												<tr>
													<td>Abakiriya</td>
													<td>: <?php echo number_format(mysqli_num_rows($getclientsloans)) ?></td>
												</tr>
												<tr>
													<td>Abaranguza</td>
													<td>: <?php echo number_format(mysqli_num_rows($getourloans)) ?></td>
												</tr>
											</table>
											<?php
										?>
									</h4>	
								</div>
								<div class="stats-link">
									<a href="loan">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
						</div>
						<!-- end col-3 -->
						<?php  
							if ($loggedUser['userType'] == 'Admin') {
								?>
									<!-- begin col-3 -->
									<div class="col-md-4 col-sm-6">
										<div class="widget widget-stats bg-blue">
											<div class="stats-icon"><i class="fa fa-database"></i></div>
											<div class="stats-info">
												<h4>AGACIRO KA SITOKE</h4>
												<p>
													<?php  
														$getstock = $db ->query("SELECT * FROM `products` INNER JOIN `intransactions` ON `products`.`productId` = `intransactions`.`inTrProductId`");
														$totalstockvalue = 0;
														while ($stock = mysqli_fetch_array($getstock)) {
															$transactionvalue = $stock['inTrQty']*$stock['productPrice'];
															$totalstockvalue = $totalstockvalue + $transactionvalue;
														}
														echo number_format($totalstockvalue).' Rwf';
													?>
												</p>	
											</div>
											<div class="stats-link">
												<a href="stock">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
											</div>
										</div>
									</div>
									<!-- end col-3 -->
									<!-- begin col-3 -->
									<div class="col-md-4 col-sm-6">
										<div class="widget widget-stats bg-black">
											<div class="stats-icon"><i class="fa fa-money"></i></div>
											<div class="stats-info">
												<h4>INYUNGU / IGIHOMBO</h4>
												<h6 class="text-white">
													<?php  
														$getpurchases = $db->query("SELECT * FROM `intransactionsview`");
														$totalpurchases = 0;
														while($purchase = mysqli_fetch_array($getpurchases)) {
															$payment = $purchase['trUnityPrice'] * $purchase['trQty'];
															$totalpurchases = $totalpurchases + $payment;
														} 

														$getsales = $db->query("SELECT * FROM `outtransactions`");
														$totalsales = 0;
														while($sale = mysqli_fetch_array($getsales)) {
															$payment = $sale['trUnityPrice'] * $sale['trQty'];
															$totalsales = $totalsales + $payment;
														}
													?>
													<table width="100%">
														<tr>
															<td>Ayarangujwe</td>
															<td>: <?php echo number_format($totalpurchases).' Rwf' ?></td>
														</tr>
														<tr>
															<td>Ayacurujwe</td>
															<td>: <?php echo number_format($totalsales).' Rwf' ?></td>
														</tr>
														<tr>
															<td>
																<?php  
																	if ($totalpurchases == $totalsales) {
																		echo "Zero";
																	}
																	elseif ($totalpurchases > $totalsales) {
																		echo "Igihombo";
																	}
																	else {
																		echo "Inyungu";
																	}
																?>
															</td>
															<td>
																<?php    
																	if ($totalpurchases == $totalsales) {
																		echo ": Zero";
																	}
																	elseif ($totalpurchases > $totalsales) {
																		echo ': '.number_format($totalpurchases-$totalsales).' Rwf';
																	}
																	else {
																		echo ': '.number_format($totalsales-$totalpurchases).' Rwf';
																	}
																?>
															</td>
														</tr>
													</table>
												</h6>	
											</div>
											<div class="stats-link">
												<a href="purchase">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
											</div>
										</div>
									</div>
									<!-- end col-3 -->
								<?php
							}
						?>
						<!-- begin col-3 -->
						<div class="col-md-4 col-sm-6">
							<div class="widget widget-stats bg-grey">
								<div class="stats-icon"><i class="fa fa-users"></i></div>
								<div class="stats-info">
									<h4>ABARANGUZA</h4>
									<p>
										<?php  
											$getallsuppliers = $db ->query("SELECT * FROM `suppliers`");
											echo number_format(mysqli_num_rows($getallsuppliers));
										?>
									</p>	
								</div>
								<div class="stats-link">
									<a href="suppliers">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
						</div>
						<!-- end col-3 -->
						<!-- begin col-3 -->
						<div class="col-md-4 col-sm-6">
							<div class="widget widget-stats bg-purple">
								<div class="stats-icon"><i class="fa fa-money"></i></div>
								<div class="stats-info">
									<h4>ABAKIRIYA</h4>
									<p>
										<?php  
											$getallclients = $db ->query("SELECT * FROM `clients`");
											echo number_format(mysqli_num_rows($getallclients));
										?>
									</p>	
								</div>
								<div class="stats-link">
									<a href="clients">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
						</div>
						<!-- end col-3 -->
					</div>
					<!-- end row -->
				</div>
				<!-- end col-8 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/dashboard.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			Dashboard.init();
		});
	</script>
</body>
</html>
