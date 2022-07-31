<?php 
	include 'access.php'; 
?>
<?php  
	if (isset($_POST['addclient'])) {
		$telephone = $_POST['clientPhone'];
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
			$clientId = time();
			$createdDate = time();
			$insertclient = $db ->query("INSERT INTO `clients`(`clientId`, `clientNames`, `clientPhone`, `clientEmail`, `addedTime`, `firstBuy`, `latestBuy`) VALUES ('$clientId','$_POST[clientNames]','$cleanphone','$_POST[clientEmail]','$createdDate',NULL,NULL)");
			if ($insertclient) {
				?>
				<script type="text/javascript">
					alert("Umukiriya <?php echo $_POST['clientNames'] ?> yashyizwe muri system.");
					document.location.href = '<?php echo $baseurl; ?>clients';
				</script>
				<?php
			}
			else {
				?>
				<script type="text/javascript">
					alert("Umukiriya <?php echo $_POST['clientNames'] ?> ntabashije kujya muri system. ongera ugerageze.");
					document.location.href = '<?php echo $baseurl; ?>clients';
				</script>
				<?php
			}
		}
		else {
			?>
			<script type="text/javascript">
				alert("Numero y'umukiriya yanditse nabi. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>clients';
			</script>
			<?php
		}
	}
?>
<?php  
	if (isset($_POST['updateclient'])) {
		$telephone = $_POST['clientPhone'];
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
			$updateclient = $db ->query("UPDATE `clients` SET `clientNames`='$_POST[clientNames]',`clientPhone`='$cleanphone',`clientEmail`='$_POST[clientEmail]' WHERE `clientId`='$_POST[clientId]'");
			if ($updateclient) {
				?>
				<script type="text/javascript">
					alert("Umukiriya <?php echo $_POST['clientNames'] ?> yahinduriwe ibimuranga");
					document.location.href = '<?php echo $baseurl; ?>clients';
				</script>
				<?php
			}
			else {
				?>
				<script type="text/javascript">
					alert("Umukiriya <?php echo $_POST['clientNames'] ?> ntiyahinduriwe ibimuranga. ongera ugerageze.");
					document.location.href = '<?php echo $baseurl; ?>clients';
				</script>
				<?php
			}
		}
		else {
			?>
			<script type="text/javascript">
				alert("Numero y'umukiriya yanditse nabi. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>clients';
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Abakiriya</title>		
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
                                <a href="clients#clientfoarm" class="xs-hidden btn btn-sm btn-icon btn-circle btn-success"><i class="fa fa-plus"></i></a>
                            </div>
                            <h4 class="panel-title"><b>ABAKIRIYA BOSE</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Amazina</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Aheruka</th>
                                        <th>Ibyo yaguze</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php  
                                		$selectclients = $db ->query("SELECT * FROM `clients` ORDER BY `latestBuy` DESC");
                                		$n=0;
                                		while ($client = mysqli_fetch_array($selectclients)) {
                                			if ($client['latestBuy']!=NULL) {
                                				$latestBuy = date("d M Y",$client['latestBuy']);
                                			}
                                			else {
                                				$latestBuy = '------';
                                			}
                                			?>
		                                	<tr>
		                                		<td class="<?php echo $background ?>">
		                                			#<?php echo ++$n; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $client['clientNames']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $client['clientPhone']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $client['clientEmail']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $latestBuy; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
													<a class="btn btn-xs bg-green btn-curve text-white" href="clients#client<?php echo $client['clientId'] ?>" data-toggle="modal">
				                                    	Reba Ibyo Yaguze
					                                </a>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
													<a href="clients/updateclient/<?php echo $client['clientId']; ?>">
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
			    <div class="col-md-3" id="clientfoarm">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div> 
                            <?php
				     			if (isset($url[1]) && $url[1]=='updateclient' && isset($url[2]) && $url[2]!='') {
				     				$getclienttoedit = $db ->query("SELECT * FROM `clients` WHERE `clientId` = '$url[2]'");
				     				if (mysqli_num_rows($getclienttoedit)>0) {
				     					$editclient = mysqli_fetch_array($getclienttoedit);
				     					?>
                            			<h4 class="panel-title"><b>HINDURA <?php echo strtoupper($editclient['clientNames']) ?></b></h4>
				     					<?php
				     				}
				     				else {
				     					?>
										<script type="text/javascript">
											alert("Umukiriya mushaka guhindura ntari muri system yanyu.");
											document.location.href = 'clients';
										</script>
				     					<?php
				     				}
				     			}
				     			else {
			     					?>
                            		<h4 class="panel-title"><b>UMUKIRIYA MUSHYA</b></h4>
			     					<?php
								}
							?>
                        </div>
                        <div class="panel-body">
                            <?php
				     			if (isset($url[1]) && $url[1]=='updateclient' && isset($url[2]) && $url[2]!='') {
				     				$getclienttoedit = $db ->query("SELECT * FROM `clients` WHERE clientId = '$url[2]'");
				     				if (mysqli_num_rows($getclienttoedit)>0) {
				     					$editclient = mysqli_fetch_array($getclienttoedit);
				     					?>
										 	<form method="post">
										 		<div class="form-group">
								     				<label>Amazina*</label>
								     				<input type="text" id="clientNames" name="clientNames" class="form-control" value="<?php echo $editclient['clientNames'] ?>" required>
								     				<input type="hidden" id="clientId" name="clientId" value="<?php echo $editclient['clientId'] ?>" required>
								     			</div>
										 		<div class="form-group">
								     				<label>Telephone*</label>
								     				<input type="text" id="clientPhone" name="clientPhone" class="form-control" value="<?php echo $editclient['clientPhone'] ?>" required>
								     			</div>
										 		<div class="form-group">
								     				<label>Email (Sitegeko)</label>
								     				<input type="email" id="clientEmail" name="clientEmail" class="form-control" value="<?php echo $editclient['clientEmail'] ?>">
								     			</div>
										 		<div class="form-group" style="margin-top: 30px">
										 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="HINDURA IBIMURANGA" name="updateclient">
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
						     				<input type="text" id="clientNames" name="clientNames" class="form-control" placeholder="Ex: Aizo Kini" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Telephone*</label>
						     				<input type="text" id="clientPhone" name="clientPhone" class="form-control" placeholder="Ex: 0789754425" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Email (Sitegeko)</label>
						     				<input type="email" id="clientEmail" name="clientEmail" class="form-control" placeholder="Ex: aizokini@gmail.com">
						     			</div>
								 		<div class="form-group" style="margin-top: 30px">
								 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="ONGERAHO UMUKIRIYA" name="addclient">
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
			$getclients = $db ->query("SELECT * FROM `clients`");
			while ($client = mysqli_fetch_array($getclients)) {
				?>
					<div class="modal fade" id="client<?php echo $client['clientId']?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-green">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title text-white">IBYO YAGUZE</h4>
								</div>
								<div class="modal-body table-responsive">
		                            <table class="table table-striped table-bordered table-condensed">
		                                <thead>
		                                    <tr>
		                                    	<th>Kode</th>
		                                        <th>Ibicuruzwa</th>
		                                        <th>Ibyo yaguze</th>
		                                        <th>Agaciro</th>
		                                        <th>Ayishyuye</th>
		                                        <th>Atishyuye</th>
		                                        <th>Uburyo yishyuyemo</th>
		                                        <th>Uwo yishyuye</th>
		                                        <th>Igihe yaguriye</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
	                                	<?php  
	                                		$selecttranss = $db ->query("SELECT * FROM `outtransactions` WHERE `clientId`='$client[clientId]' ORDER BY `trId` DESC");
	                                		if (mysqli_num_rows($selecttranss)==0) {
	                                			?>
	                                			<tr>
		                                			<td colspan="9"><h5>Ntakintu aragura narimwe</h5></td>
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
		                                			<td><?php echo number_format($trans['trPayedAmount']).' Rwf'; ?></td>
		                                			<td><?php echo number_format($trans['trNonPaidAmount']).' Rwf'; ?></td>
		                                			<td><?php echo $trans['trPaymentMethod']; ?></td>
		                                			<td><?php echo $trans['userNames']; ?></td>
		                                			<td><?php echo date("d M Y",$trans['createdDate']); ?></td>
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
