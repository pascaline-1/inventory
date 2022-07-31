<?php 
	include 'access.php'; 
?>
<?php  
	if (isset($_POST['payloan'])) {    
		$gettrtopay = $db ->query("SELECT * FROM `transactions` WHERE `trId` = '$url[2]'");
		$trtopay = mysqli_fetch_array($gettrtopay);
		$newpaid = $trtopay['trPayedAmount'] + $_POST['paidamount'];
		$newnonpaid = $trtopay['trNonPaidAmount'] - $_POST['paidamount'];
		if ($newnonpaid == 0) {
			$newpaystatus = 'Full Paid';
		}
		else {
			$newpaystatus = 'Partial Paid';
		}
		$pay = $db ->query("UPDATE `transactions` SET `trPayedAmount`='$newpaid', `trNonPaidAmount`='$newnonpaid',`trPaymentStatus`='$newpaystatus' WHERE `trId` = '$url[2]'");
		if ($pay) {
			?>
			<script type="text/javascript">
				alert("Idene ryishyuwe ryashyizwe muri system");
				document.location.href = '<?php echo $baseurl; ?>loan';
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("Iri dene ntiribashije kwishyurwa muri system. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>loan';
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>
		AMADENE
    	<?php 
        	if ($url[1] == 'shop') {
        		?>
				Y'IDUKA 
        		<?php
        	}
    		else {
                ?>
        		Y'ABAKIRIYA
        		<?php
        	}
    	?>
	</title>		
	<?php include 'dashboardhead.php'; ?>
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css" rel="stylesheet" />
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php  
			include 'topheader.php';
		?>
		<!-- end #header -->
		
		<!-- begin sidebar -->
		<?php include 'sidebar.php'; ?>
		<!-- end sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			   <!--  <div class="col-md-2">
			        <div class="hidden-sm hidden-xs">
                        <ul class="nav nav-pills nav-stacked nav-inbox">
                            <li class="
							<?php if ($url[1] != 'shop'): ?>
								active
							<?php endif ?>
						">
							<a href="loan/clients"><i class="fa fa-money"></i> Abakiriya</a></li>
                            <li class="
							<?php if ($url[1] == 'shop'): ?>
								active
							<?php endif ?>
						">
							<a href="loan/shop"><i class="fa fa-users"></i> Abaranguza</a></li>
                        </ul>
                    </div>
			    </div> -->
			    <!-- end col-2 -->
			    <!-- begin col-9 -->
			    <div class="col-md-9">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <h4 class="panel-title">
                            	<b>AMADENE 
                            	<?php 
                                	if ($url[1] == 'shop') {
                                		?>
										Y'IDUKA 
                                		<?php
                                	}
                            		else {
		                                ?>
		                        		Y'ABAKIRIYA
		                        		<?php
                                	}
			                	?>
			                	</b>
			                </h4>
                        </div>
                        <div class="panel-body">
                        	<div class="row m-b-10">
                        		<div class="col-md-2"></div>
                        		<div class="col-md-3">
                        			<select class="form-control" onchange="changeloan()" id="selectloantype">
                        				<option value="clients" 
			                            	<?php 
			                                	if ($url[1] != 'shop') {
			                                		echo "selected";
			                                	}
						                	?>
						                >
						            		Ayabakiriya
						            	</option>
                        				<option value="shop" 
			                            	<?php 
			                                	if ($url[1] == 'shop') {
			                                		echo "selected";
			                                	}
						                	?>
						                >
						            		Ayiduka
						            	</option>
                        			</select>
                        		</div>
								<div class="flexedspaced col-md-6">
									<input type="date" class="form-control" id="startdate" max="<?php
								         echo date('Y-m-d');
								     	?>" 
								     onchange="minchange()" />
									<div style="padding-right: 10px;padding-left: 10px;padding-top: 10px">Kugeza</div>
									<input type="date" class="form-control" id="enddate" onchange="maxchange()" />
								</div>
	                        </div>
	                        <?php                              	
	                        	if ($url[1] == 'shop') {
                            		$table = 'intransactionsview';
                            		?>
                            		<input type="text" id="loantype" value="In" hidden>
                            		<?php
                            	} 
                            	else {
                            		$table = 'outtransactions';
                            		?>
                            		<input type="text" id="loantype" value="Out" hidden>
                            		<?php
                            	}
	                        ?>
                        	<div id="tablespace">
	                            <table id="data-table" class="table table-striped table-bordered table-condensed">
	                                <thead>
	                                    <tr>
											<th>#</th>
											<th>Itariki</th>
											<th>Icyakozwe</th>
											<th>Ingano</th>
											<th>Igiciro</th>
											<th>Yose Hamwe</th>
											<th>Ayishyuye</th>
											<th>Atishyuye</th>
											<?php                             	
					                        	if ($url[1] == 'shop') {
				                            		?>
				                            		<th>Uranguza</th>
				                            		<?php
				                            	} 
				                            	else {
				                            		?>
				                            		<th>Umukiriya</th>
				                            		<?php
				                            	}
											?>
											<th>Uburyo</th>
											<th>Uwabikoze</th>
											<th>Ishyura</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                <?php 
	                                	$selectedtrans = $db->query("SELECT * FROM `$table` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') ORDER BY `trId` DESC");
	                                	$n=1;
	                                	while ($trans = mysqli_fetch_array($selectedtrans)) {
	                                		?>
	                                		<tr>
	                                			<td><?php echo $n++; ?></td>
	                                			<td><?php echo date("d M Y",$trans['doneDate']); ?></td>
	                                			<td>Kurangura</td>
	                                			<td><?php echo $trans['productUnit'].' '.number_format($trans['trQty']); ?></td>
	                                			<td><?php echo number_format($trans['trUnityPrice']); ?> Rwf</td>
	                                			<td><?php echo number_format($trans['trUnityPrice']*$trans['trQty']); ?> Rwf</td>
	                                			<td><?php echo number_format($trans['trPayedAmount']); ?> Rwf</td>
	                                			<td><?php echo number_format($trans['trNonPaidAmount']); ?> Rwf</td>
	                                			<?php                             	
						                        	if ($url[1] == 'shop') {
					                            		echo '<td>'.$trans['supplierNames'].'</td>';
					                            	}                             	
						                        	else {
					                            		echo '<td>'.$trans['clientNames'].'</td>';
					                            	} 
	                                			?>
	                                			<td><?php echo $trans['trPaymentMethod']; ?></td>
	                                			<td><?php echo $trans['userNames']; ?></td>
	                                			<td>
													<a href="loan/pay/<?php echo $trans['trId'] ?>" class="btn btn-success btn-sm btn-curve w-100">
					                                    <i class="fa fa-money text-white"></i> Pay
					                                </a>
								                </td>
	                                		</tr>
	                                		<?php
	                                	}
	                                ?>
	                            	</tbody>
	                            </table>
	                        </div>
                        </div>
                    </div>
			    </div>
			    <!-- end col-9 -->
			    <!-- begin col-3 -->
			    <div class="col-md-3" id="payform"> 
                    <?php
		     			if (isset($url[1]) && $url[1]=='pay' && isset($url[2]) && $url[2]!='') {
		     				$gettrtopay = $db ->query("SELECT * FROM `transactions` WHERE `trId` = '$url[2]'");
		     				if (mysqli_num_rows($gettrtopay)>0) {
		     					$trtopay = mysqli_fetch_array($gettrtopay);
		     					if ($trtopay['trOperation'] == 'In') {
		     						$getsupplier = $db ->query("SELECT * FROM `suppliers` WHERE `supplierId`='$trtopay[clientorsupplierId]'");
		     						$payerorpayee = mysqli_fetch_array($getsupplier);
		     						$payerorpayeename = $payerorpayee['supplierNames'];
		     						$payerorpayeecaption =  'Uwaranguje';
		     						$amountcaption =  'Ayo yishyuwe';
		     						$btncaption =  'ISHYURA IDENE';
		     					}
		     					else {
		     						$getclient = $db ->query("SELECT * FROM `clients` WHERE `clientId`='$trtopay[clientorsupplierId]'");
		     						$payerorpayee = mysqli_fetch_array($getclient);
		     						$payerorpayeename = $payerorpayee['clientNames'];
		     						$payerorpayeecaption =  'Umukiriya';
		     						$amountcaption =  'Ayo yishyuye';
		     						$btncaption =  'YISHYUYE IDENE';
		     					}
		     					?>
			                    <div class="panel panel-topborder-green">
			                        <div class="panel-heading">
			                            <div class="panel-heading-btn">
			                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
			                            </div> 
                    					<h4 class="panel-title"><b>UZUZA IBIKURIKIRA</b></h4>
			                        </div>
			                        <div class="panel-body">
									 	<form method="post">
									 		<div class="form-group">
							     				<label><?php echo $payerorpayeecaption; ?></label>
							     				<input 
							     					type="text" 
							     					class="form-control" 
							     					value="<?php echo $payerorpayeename?>" 
							                        disabled
							                    />
							     				<input type="hidden" name="trId" value="<?php echo $trtopay['trId'] ?>" required>
							     			</div>
									 		<div class="form-group">
							     				<label><?php echo $amountcaption; ?></label>
							     				<input type="number" min="1" id="paidamount" name="paidamount" class="form-control" value="<?php echo $trtopay['trNonPaidAmount'] ?>" autofocus required>
							     			</div>
									 		<div class="form-group" style="margin-top: 30px">
									 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="ISHYURA IDENE" name="payloan">
									 			<a href="loan" class="btn btn-curve custom-card form-control bg-red text-white m-t-10">
										 			NTIRIRISHYURWA
										 		</a>
							     			</div>
									 	</form>
									</div>
								</div>
		     					<?php
		     				}
		     				else {
		     					?>
								<script type="text/javascript">
									alert("iri dene ushaka kwishyura ntariri muri system yanyu.");
									document.location.href = 'loan';
								</script>
		     					<?php
		     				}
		     			}
					?>
			    </div>
			    <!-- end col-3 -->
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
	<?php include 'js.php'; ?>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
	<script src="assets/js/table-manage-combine.demo.min.js"></script>


	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
    <script src="assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
    <script src="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="assets/js/form-plugins.demo.min.js"></script>

	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageCombine.init();
			FormPlugins.init();
		});
	</script>
	<script type="text/javascript">
		function minchange() {
			var startdate = document.getElementById('startdate');
			var enddate = document.getElementById('enddate');
			var loantype = document.getElementById('loantype').value;
			enddate.setAttribute("min", startdate.value);

			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 		: 'getloans',
					from 		: startdate.value,
					to 			: enddate.value,
					loantype 	: loantype
				},
				success : function(html, textStatus){
					$("#tablespace").html(html);
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				}
			});
		}
		function maxchange() {
			var startdate = document.getElementById('startdate');
			var enddate = document.getElementById('enddate');
			var loantype = document.getElementById('loantype').value;
			startdate.setAttribute("max", enddate.value);

			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 		: 'getloans',
					from 		: startdate.value,
					to 			: enddate.value,
					loantype 	: loantype
				},
				success : function(html, textStatus){
					$("#tablespace").html(html);
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				}
			});
		}
		function changeloan() {
			var selectloantype = document.getElementById('selectloantype').value;
			document.location.href = 'loan/'+selectloantype;
		}
	</script>
</body>
</html>
