<?php 
	include 'access.php'; 
?>
<?php  
	if (isset($_POST['addsupplier'])) {
		$telephone = $_POST['supplierPhone'];
	    if (substr(preg_replace('/[^0-9]/', '', $telephone),0,4)=='2507' && strlen($telephone)==12) {
	        $cleanphone = $telephone;
	        $rightphone = true;
	    }
	    else {
	        if (substr(preg_replace('/[^0-9]/', '', $telephone),0,2)=='07' && strlen($telephone)==10) {
	            $cleanphone = '25'.$telephone;
	            $rightphone = true;
	        }
	        else {
	            $rightphone = false;
	        }
	    }
	    if ($rightphone) {
			$supplierId = time();
			$createdDate = time();
			$insertsupplier = $db ->query("INSERT INTO `suppliers`(`supplierId`, `supplierNames`, `supplierPhone`, `supplierEmail`, `supplierDetails`, `addedDate`, `firstSupply`, `latestSupply`) VALUES ('$supplierId','$_POST[supplierNames]','$cleanphone','$_POST[supplierEmail]','$_POST[supplierDetails]','$createdDate',NULL,NULL)");
			if ($insertsupplier) {
				?>
				<script type="text/javascript">
					alert("Uranguza <?php echo $_POST['supplierNames'] ?> yashyizwe muri system.");
					document.location.href = '<?php echo $baseurl; ?>suppliers';
				</script>
				<?php
			}
			else {
				?>
				<script type="text/javascript">
					alert("Uranguza <?php echo $_POST['supplierNames'] ?> ntabashije kujya muri system. ongera ugerageze.");
					document.location.href = '<?php echo $baseurl; ?>suppliers';
				</script>
				<?php
			}
		}
		else {
			?>
			<script type="text/javascript">
				alert("Numero y'uranguza yanditse nabi. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>suppliers';
			</script>
			<?php
		}
	}
?>
<?php  
	if (isset($_POST['updatesupplier'])) {
		$telephone = $_POST['supplierPhone'];
	    if (substr(preg_replace('/[^0-9]/', '', $telephone),0,4)=='2507' && strlen($telephone)==12) {
	        $cleanphone = $telephone;
	        $rightphone = true;
	    }
	    else {
	        if (substr(preg_replace('/[^0-9]/', '', $telephone),0,2)=='07' && strlen($telephone)==10) {
	            $cleanphone = '25'.$telephone;
	            $rightphone = true;
	        }
	        else {
	            $rightphone = false;
	        }
	    }
	    if ($rightphone) {
			$updatesupplier = $db ->query("UPDATE `suppliers` SET `supplierNames`='$_POST[supplierNames]',`supplierPhone`='$cleanphone',`supplierEmail`='$_POST[supplierEmail]',`supplierDetails`='$_POST[supplierDetails]' WHERE `supplierId`='$_POST[supplierId]'");
			if ($updatesupplier) {
				?>
				<script type="text/javascript">
					alert("Uranguza <?php echo $_POST['supplierNames'] ?> yahinduriwe ibimuranga");
					document.location.href = '<?php echo $baseurl; ?>suppliers';
				</script>
				<?php
			}
			else {
				?>
				<script type="text/javascript">
					alert("Uranguza <?php echo $_POST['supplierNames'] ?> ntiyahinduriwe ibimuranga. ongera ugerageze.");
					document.location.href = '<?php echo $baseurl; ?>suppliers';
				</script>
				<?php
			}
		}
		else {
			?>
			<script type="text/javascript">
				alert("Numero y'uranguza yanditse nabi. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>suppliers';
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Abaranguza</title>		
	<?php include 'dashboardhead.php'; ?>
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
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
			    <!-- begin col-9 -->
			    <div class="col-md-9">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="suppliers#supplierfoarm" class="xs-hidden btn btn-sm btn-icon btn-circle btn-success"><i class="fa fa-plus"></i></a>
                            </div>
                            <h4 class="panel-title"><b>ABARANGUZA BOSE</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Amazina</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Ibyaranguza</th>
                                        <th>Aheruka</th>
                                        <th>Ibyo Yaranguje</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php  
                                		$selectsuppliers = $db ->query("SELECT * FROM `suppliers` ORDER BY `latestSupply` DESC");
                                		$n=0;
                                		while ($supplier = mysqli_fetch_array($selectsuppliers)) {
                                			if ($supplier['latestSupply']!=NULL) {
                                				$latestSupply = date("d M Y",$supplier['latestSupply']);
                                			}
                                			else {
                                				$latestSupply = '------';
                                			}
                                			?>
		                                	<tr>
		                                		<td class="<?php echo $background ?>">
		                                			#<?php echo ++$n; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $supplier['supplierNames']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $supplier['supplierPhone']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $supplier['supplierEmail']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $supplier['supplierDetails']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $latestSupply; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
													<button class="btn btn-xs bg-green btn-curve text-white" data-target="#supplier<?php echo $supplier['supplierId'] ?>" data-toggle="modal">
				                                    	Reba Ibyo Yaranguje
					                                </button>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
													<a href="suppliers/updatesupplier/<?php echo $supplier['supplierId']; ?>">
				                                    	<center class="action">
					                                    	<i class="fa fa-edit text-green" style="font-size: 20px;cursor:pointer"></i>
					                                    </center>
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
			    <!-- end col-9 -->
			    <!-- begin col-3 -->
			    <div class="col-md-3" id="supplierfoarm">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div> 
                            <?php
				     			if (isset($url[1]) && $url[1]=='updatesupplier' && isset($url[2]) && $url[2]!='') {
				     				$getsuppliertoedit = $db ->query("SELECT * FROM `suppliers` WHERE `supplierId` = '$url[2]'");
				     				if (mysqli_num_rows($getsuppliertoedit)>0) {
				     					$editsupplier = mysqli_fetch_array($getsuppliertoedit);
				     					?>
                            			<h4 class="panel-title"><b>HINDURA <?php echo strtoupper($editsupplier['supplierNames']) ?></b></h4>
				     					<?php
				     				}
				     				else {
				     					?>
										<script type="text/javascript">
											alert("Uranguza mushaka guhindura ntari muri system yanyu.");
											document.location.href = 'suppliers';
										</script>
				     					<?php
				     				}
				     			}
				     			else {
			     					?>
                            		<h4 class="panel-title"><b>URANGUZA MUSHYA</b></h4>
			     					<?php
								}
							?>
                        </div>
                        <div class="panel-body">
                            <?php
				     			if (isset($url[1]) && $url[1]=='updatesupplier' && isset($url[2]) && $url[2]!='') {
				     				$getsuppliertoedit = $db ->query("SELECT * FROM `suppliers` WHERE supplierId = '$url[2]'");
				     				if (mysqli_num_rows($getsuppliertoedit)>0) {
				     					$editsupplier = mysqli_fetch_array($getsuppliertoedit);
				     					?>
										 	<form method="post">
										 		<div class="form-group">
								     				<label>Amazina*</label>
								     				<input type="text" id="supplierNames" name="supplierNames" class="form-control" value="<?php echo $editsupplier['supplierNames'] ?>" required>
								     				<input type="hidden" id="supplierId" name="supplierId" value="<?php echo $editsupplier['supplierId'] ?>" required>
								     			</div>
										 		<div class="form-group">
								     				<label>Telephone*</label>
								     				<input type="text" id="supplierPhone" name="supplierPhone" class="form-control" value="<?php echo $editsupplier['supplierPhone'] ?>" required>
								     			</div>
										 		<div class="form-group">
								     				<label>Email (Sitegeko)</label>
								     				<input type="email" id="supplierEmail" name="supplierEmail" class="form-control" value="<?php echo $editsupplier['supplierEmail'] ?>">
								     			</div>
										 		<div class="form-group">
								     				<label>Ibyaranguza (Sitegeko)</label>
								     				<input type="text" id="supplierDetails" name="supplierDetails" class="form-control" value="<?php echo $editsupplier['supplierDetails'] ?>">
								     			</div>
										 		<div class="form-group" style="margin-top: 30px">
										 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="HINDURA IBIMURANGA" name="updatesupplier">
										 			<input type="reset" class="btn-curve custom-card form-control bg-red text-white m-t-10" value="TANGIRA BUSHYA" />
								     			</div>
										 	</form>
				     					<?php
				     				}
				     			}
				     			else {
			     					?>
								 	<form method="post">
								 		<div class="form-group">
						     				<label>Amazina*</label>
						     				<input type="text" id="supplierNames" name="supplierNames" class="form-control" placeholder="Ex: Aizo Kini" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Telephone*</label>
						     				<input type="text" id="supplierPhone" name="supplierPhone" class="form-control" placeholder="Ex: 0789754425" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Email (Sitegeko)</label>
						     				<input type="email" id="supplierEmail" name="supplierEmail" class="form-control" placeholder="Ex: aizokini@gmail.com">
						     			</div>
								 		<div class="form-group">
						     				<label>Ibyaranguza (Sitegeko)</label>
						     				<input type="text" id="supplierDetails" name="supplierDetails" class="form-control" value="<?php echo $editsupplier['supplierDetails'] ?>">
						     			</div>
								 		<div class="form-group" style="margin-top: 30px">
								 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="ONGERAHO UMUKIRIYA" name="addsupplier">
								 			<input type="reset" class="btn-curve custom-card form-control bg-red text-white m-t-10" value="TANGIRA BUSHYA" />
						     			</div>
								 	</form>
			     					<?php
								}
							?>
						</div>
					</div>
			    </div>
			    <!-- end col-3 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
		<?php  
			$getsuppliers = $db ->query("SELECT * FROM `suppliers`");
			while ($supplier = mysqli_fetch_array($getsuppliers)) {
				?>
					<div class="modal fade" id="supplier<?php echo $supplier['supplierId']?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-green">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title text-white">Ibyo yaranguje</h4>
								</div>
								<div class="modal-body table-responsive">
		                            <table class="table table-striped table-bordered table-condensed">
		                                <thead>
		                                    <tr>
		                                    	<th>Kode</th>
		                                        <th>Ibicuruzwa</th>
		                                        <th>Ibyo yaranguje</th>
		                                        <th>Agaciro</th>
		                                        <th>Ayishyuye</th>
		                                        <th>Atishyuye</th>
		                                        <th>Uburyo yishyuwemo</th>
		                                        <th>Uwamwishyuye</th>
		                                        <th>Igihe byaranguriwe</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                            	<?php  
		                            		$selecttranss = $db ->query("SELECT * FROM `intransactionsview` WHERE `supplierId`='$supplier[supplierId]' ORDER BY `trId` DESC");
		                            		if (mysqli_num_rows($selecttranss)==0) {
		                            			?>
		                            			<tr>
		                                			<td colspan="9"><h5>Ntakintu araranguza narimwe</h5></td>
		                                		</tr>
		                            			<?php
		                            		}
		                            		$n=1;
		                            		while ($trans = mysqli_fetch_array($selecttranss)) {
		                            			?>
		                            			<tr>
		                                			<td>#<?php echo $n++; ?></td>
		                                			<td><?php echo $trans['productName']; ?></td>
		                                			<td><?php echo $trans['productUnit'].' '.$trans['trQty']; ?></td>
		                                			<td><?php echo number_format($trans['trUnityPrice']*$trans['trQty']).' Rwf'; ?></td>
		                                			<td><?php echo number_format($trans['trPayedAmount']). ' Rwf'; ?></td>
		                                			<td><?php echo number_format($trans['trNonPaidAmount']). ' Rwf'; ?></td>
		                                			<td><?php echo $trans['trPaymentMethod']; ?></td>
		                                			<td><?php echo $trans['userNames']; ?></td>
		                                			<td><?php echo date("d M Y",$trans['doneDate']); ?></td>
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
				<?php
			}
		?>

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
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageCombine.init();
		});
	</script>
</body>
</html>
