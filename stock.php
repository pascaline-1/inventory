<?php 
	include 'access.php'; 
?>
<?php  
	if (isset($_POST['addproduct'])) {
		$productId = time();
		$createdDate = time();
		$productName = addslashes($_POST['productName']);
		$insertproduct = $db ->query("INSERT INTO `products`(`productId`, `productName`, `productPrice`, `productUnit`, `productType`, `productMixed`, `createdBy`, `createdDate`, `deletedDate`, `deletedBy`) VALUES ('$productId','$productName','$_POST[productPrice]','$_POST[productUnit]','Single',NULL,$loggedUser[userId],'$createdDate',NULL,NULL)");
		if ($insertproduct) {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa <?php echo $_POST['productName'] ?> cyashyizwe muri system");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa <?php echo $_POST['productName'] ?> ntikibashije gushyirwa muri system. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
	}
?>
<?php  
	if (isset($_POST['updateproduct'])) {
		$productName = addslashes($_POST['productName']);
		$updateproduct = $db ->query("UPDATE `products` SET `productName`='$productName', `productPrice`='$_POST[productPrice]', `productUnit`='$_POST[productUnit]' WHERE `productId`='$_POST[productId]'");
		if ($updateproduct) {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa <?php echo $_POST['productName'] ?> cyahinduwe");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa <?php echo $_POST['productName'] ?> ntikibashije guhindurwa. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
	}
?>
<?php  
	if (isset($url[1]) && isset($url[2]) && $url[1] == 'disableproduct') {
		$deletedDate = time();
		$disableproduct = $db ->query("UPDATE `products` SET `deletedDate`='$deletedDate', `deletedBy`='$loggedUser[userId]' WHERE `productId`='$url[2]'");
		if ($disableproduct) {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa cyafunzwe");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa ntikibashije gufungwa. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
	}
?>
<?php  
	if (isset($url[1]) && isset($url[2]) && $url[1] == 'enableproduct') {
		$deletedDate = time();
		$enableproduct = $db ->query("UPDATE `products` SET `deletedDate`=NULL, `deletedBy`=NULL WHERE `productId`='$url[2]'");
		if ($enableproduct) {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa cyafunguwe");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("Igicuruzwa ntikibashije gufungurwa. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>stock';
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sitoke</title>		
	<?php include 'dashboardhead.php'; ?>
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/ColReorder/css/colReorder.bootstrap.min.css" rel="stylesheet" />
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
			<div class="row">
				<div class="col-md-9">
					<div class="flexedspaced">
						<button class="btn btn-curve btn-sm btn-success text-white w-100" data-toggle="modal" data-target="#purchase">RANGURA</button>
						<button class="btn btn-curve btn-sm btn-primary text-white w-100" data-toggle="modal" data-target="#sell">CURUZA</button>
						<button class="btn btn-curve btn-sm btn-info text-white w-150" data-toggle="modal" data-target="#mix">KORA IMVANGE</button>
					</div>
				</div>
			</div>
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-9 -->
			    <div class="col-md-9">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="stock#productfoarm" class="xs-hidden btn btn-sm btn-icon btn-circle btn-success"><i class="fa fa-plus"></i></a>
                            </div>
                            <h4 class="panel-title"><b>IBICURUZWA BYOSE</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Izina</th>
                                        <th>Ibiri muri sitoke</th>
                                        <th>Igiciro ugurishaho</th>
                                        <th>Ayavamo</th>
                                        <th>Sitoke</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php  
                                		$selectedproducts = $db->query("SELECT * FROM `products` ORDER BY `productId` DESC");
                                		$n=0;
                                		while ($product = mysqli_fetch_array($selectedproducts)) {
											$getAllInTrans = $db ->query("SELECT SUM(inTrQty) AS inTrQty FROM `intransactions` WHERE `inTrProductId` = '$product[productId]'");
											$thisItem = mysqli_fetch_array($getAllInTrans);
											$itemQty = $thisItem['inTrQty'];
											if ($product['deletedDate'] != NULL) {
												$background = 'bg-red';
											}
											else {
												$background = '';
											}
                                			?>
		                                	<tr>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo ++$n; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $product['productName']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<p style="text-align: center;">
		                                				<?php echo $product['productUnit'].' '.number_format($itemQty); ?><br>
		                                				<button class="btn btn-curve btn-xs btn-info text-white w-100" data-toggle="modal" data-target="#adjust<?php echo $product['productId'] ?>">KURAMO</button>
		                                			</p>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo number_format($product['productPrice']); ?> Rwf
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo number_format($product['productPrice']*$itemQty); ?> Rwf
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<button class="btn btn-curve btn-sm btn-success text-white w-100" data-toggle="modal" data-target="#product<?php echo $product['productId'] ?>">REBA</button>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
													<a href="stock/updateproduct/<?php echo $product['productId']; ?>">
				                                    	<center class="action">
					                                    	<i class="fa fa-edit pull-left text-green" style="font-size: 20px;cursor:pointer"></i>
					                                    </center>
					                                </a>
					                                <?php  
														if ($product['deletedDate'] == NULL) {
															?>
																<a href="javascript:;" onclick="return disableproduct('<?php echo $product['productId']; ?>')">
							                                    	<center class="action">
								                                    	<i class="fa fa-trash pull-right text-danger" style="font-size: 20px;cursor:pointer"></i>
								                                    </center>
								                                </a>
															<?php
														}
														else {
															?>
																<a href="javascript:;" onclick="return enableproduct('<?php echo $product['productId']; ?>')">
							                                    	<center class="action">
								                                    	<i class="fa fa-check pull-right text-success" style="font-size: 20px;cursor:pointer"></i>
								                                    </center>
								                                </a>
															<?php
														}
					                                ?>

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
			    <div class="col-md-3" id="productfoarm">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div> 
                            <?php
				     			if (isset($url[1]) && $url[1]=='updateproduct' && isset($url[2]) && $url[2]!='') {
				     				$getproducttoedit = $db ->query("SELECT * FROM `products` WHERE `productId` = '$url[2]'");
				     				if (mysqli_num_rows($getproducttoedit)>0) {
				     					$editproduct = mysqli_fetch_array($getproducttoedit);
				     					?>
                            			<h4 class="panel-title"><b>HINDURA <?php echo strtoupper($editproduct['productName']) ?></b></h4>
				     					<?php
				     				}
				     				else {
				     					?>
										<script type="text/javascript">
											alert("Igicuruzwa mushaka guhindura ntakiri muri system yanyu.");
											document.location.href = 'products';
										</script>
				     					<?php
				     				}
				     			}
				     			else {
			     					?>
                            		<h4 class="panel-title"><b>IGICURUZWA GISHYA</b></h4>
			     					<?php
								}
							?>
                        </div>
                        <div class="panel-body">
                            <?php
				     			if (isset($url[1]) && $url[1]=='updateproduct' && isset($url[2]) && $url[2]!='') {
				     				$getproducttoedit = $db ->query("SELECT * FROM `products` WHERE productId = '$url[2]'");
				     				if (mysqli_num_rows($getproducttoedit)>0) {
				     					$editproduct = mysqli_fetch_array($getproducttoedit);
				     					?>
									 	<form method="post">
									 		<div class="form-group">
							     				<label>Izina</label>
							     				<input type="text" id="productName" name="productName" class="form-control" value="<?php echo $editproduct['productName'] ?>" autofocus required>
							     				<input type="hidden" name="productId" value="<?php echo $editproduct['productId'] ?>" required>
							     			</div>
									 		<div class="form-group">
							     				<label>Urugero Fatizo</label>
							     				<input type="text" id="productUnit" name="productUnit" class="form-control" value="<?php echo $editproduct['productUnit'] ?>" required>
							     			</div>
									 		<div class="form-group">
							     				<label>Igiciro ugurishaho</label>
							     				<input type="number" min="1" id="productPrice" name="productPrice" class="form-control" value="<?php echo $editproduct['productPrice'] ?>" required>
							     			</div>
									 		<div class="form-group" style="margin-top: 30px">
									 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="HINDURA IGICURUZWA" name="updateproduct">
									 			<a href="stock" class="btn btn-curve custom-card form-control bg-red text-white m-t-10">
										 			WIBIHINDURA
										 		</a>
							     			</div>
									 	</form>
				     					<?php
				     				}
				     			}
				     			else {
			     					?>
								 	<form method="post">
								 		<div class="form-group">
						     				<label>Izina</label>
						     				<input type="text" id="productName" name="productName" class="form-control" placeholder="Ex: Amasaka" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Urugero Fatizo</label>
						     				<input type="text" id="productUnit" name="productUnit" class="form-control" placeholder="Ex: Ibiro" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Igiciro ugurishaho</label>
						     				<input type="number" min="1" id="productPrice" name="productPrice" class="form-control" placeholder="Ex: 230" required>
						     			</div>
								 		<div class="form-group" style="margin-top: 30px">
								 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="ONGERAHO IGICURUZWA" name="addproduct">
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
		

		<!-- Purchase model -->
		<div id="purchase" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
		      		<div class="modal-header bg-green">
		        		<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
		        		<h4 class="modal-title text-white">RANGURIRA HANO</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form id="purchaseform" onsubmit="return insertItem()">
			      			<div class="row">
								<div class="col-xs-12 col-xs-6 col-sm-4 col-md-3">
									<div class="form-group"> 
										<label>Igicuruzwa:</label>
									    <select class="default-select2 form-control" name="productId" id="productId" onchange="getItemsDet()">
	                                        <optgroup label="Hitamo igicuruzwa urangura">
	                                        	<option value="">HITAMO</option>
												<?php
													$getallproducts = $db->query("SELECT * FROM `products` ORDER BY `productName` ASC");
													while($product = mysqli_fetch_array($getallproducts))
													{
														echo'<option value="'.$product['productId'].'">'.$product['productName'].'</option>';
													}
												?>
	                                        </optgroup>
	                                    </select>
									</div>
								</div>
								<div id="otherpurchaseinfo">
								</div>
							</div>
						</form>	
						<div id="instatus">
						</div>
						<div id="itamePlace">
						</div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
		      		</div>
		    	</div>
		    </div>
		</div>

		<!-- Sell model -->
		<div id="sell" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
		      		<div class="modal-header bg-blue">
		        		<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
		        		<h4 class="modal-title text-white">GURISHIRIZA HANO</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form id="sellform" onsubmit="return sellItem()">
			      			<div class="row">
								<div class="col-xs-12 col-xs-6 col-sm-4 col-md-3">
									<div class="form-group"> 
										<label>Igicuruzwa:</label>
									    <select class="default-select2 form-control" name="soldproductId" id="soldproductId" onchange="getItemsellDet()">
	                                        <optgroup label="Hitamo igicuruzwa ugurisha">
	                                        	<option value="">HITAMO</option>
												<?php
													$getallproducts = $db->query("SELECT * FROM `products` ORDER BY `productName` ASC");
													while($product = mysqli_fetch_array($getallproducts))
													{
														echo'<option value="'.$product['productId'].'">'.$product['productName'].'</option>';
													}
												?>
	                                        </optgroup>
	                                    </select>
									</div>
								</div>
								<div id="othersellinfo">
								</div>
							</div>
						</form>	
						<div id="outstatus">
						</div>
						<div id="outItemsPlace">
						</div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
		      		</div>
		    	</div>
		    </div>
		</div>

		<!-- Mix model -->
		<div id="mix" class="modal fade small-modal" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
		      		<div class="modal-header bg-blue">
		        		<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
		        		<h4 class="modal-title text-white">KORA IMVANGE HANO</h4>
		      		</div>
		      		<div class="modal-body">
		      			<form id="mixform" onsubmit="return makemixture()">
		      				<h5>Hitamo ibyo ugiye kuvanga</h5>
		      				<input type="number" name="totalitems" id="totalitems" value="1" required hidden>
			      			<div class="row mixitem">
								<div class="col-xxs-8 col-xs-8 col-sm-8 col-md-8">
									<div class="form-group"> 
										<label>Igicuruzwa</label>
									    <select class="default-select2 form-control selectableitem" name="mixproduct1" id="mixproduct1">
	                                        <optgroup label="Hitamo igicuruzwa">
	                                        	<option value="">HITAMO</option>
												<?php
													$getallproducts = $db->query("SELECT * FROM `products` ORDER BY `productName` ASC");
													while($product = mysqli_fetch_array($getallproducts))
													{
														$getAllInTrans = $db ->query("SELECT SUM(inTrQty) AS inTrQty FROM `intransactions` WHERE `inTrProductId` = '$product[productId]'");
														$thisItem = mysqli_fetch_array($getAllInTrans);
														$itemQty = $thisItem['inTrQty'];
														if (!is_null($itemQty)) {
															echo'<option value="'.$product['productId'].'/'.$itemQty.'">'.$product['productName'].' hari '.$product['productUnit'].' '.$itemQty.'</option>';
														}
													}
												?>
	                                        </optgroup>
	                                    </select>
									</div>
								</div>
								<div class="col-xxs-4 col-xs-4 col-sm-4 col-md-4">
									<div class="form-group"> 
										<label>Ingano</label>
										<input type="number" class="selectableitem form-control" name="mixqty1" id="mixqty1">
									</div>
								</div>
							</div>
							<div id="othermixitems"></div>
							<div class="form-group"> 
								<label>Igiciro</label>
								<input type="number" class="form-control" name="mixprice" id="mixprice">
							</div>
			      			<div class="row mixitem">
								<div class="col-md-12">
									<center>
										<button type="button" class="btn btn-success btn-md btn-circle m-b-5" id="newmixitem" onclick="getmixitem()"><i class="fa fa-plus text-white"></i></button>
									</center>
								</div>
							</div>
							<div id="messageplace"></div>
							<button type="button" onclick="makemixture()" name="mix" id="mix" class="btn btn-success btn-sm btn-curve form-control">Vanga</button>
						</form>	
						<div id="mixstatus">
						</div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
		      		</div>
		    	</div>
		    </div>
		</div>

		<?php  
			$getproducts = $db ->query("SELECT * FROM `products`");
			while ($product = mysqli_fetch_array($getproducts)) {
				?>
					<div id="product<?php echo $product['productId'] ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
					      		<div class="modal-header bg-green">
					        		<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
					        		<h4 class="modal-title text-white">UKO <?php echo strtoupper($trans['productName']); ?>BYAGIYE BYANAVUYE MURI SITOKE</h4>
					      		</div>
					      		<div class="modal-body table-responsive">
						      		<table class="table table-bordered table-striped table-condensed">
		                                <thead>
		                                    <tr>
												<th>#</th>
												<th>Itariki</th>
												<th>Icyakozwe</th>
												<th>Ingano</th>
												<th>Igiciro</th>
												<th>Ayishuye</th>
												<th>Atishyuye</th>
												<th>Uwabikoze</th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                <?php  
		                                	$selectedtrans = $db->query("SELECT * FROM `transactions` INNER JOIN `system_users` ON `transactions`.`doneBy`=`system_users`.`userId` INNER JOIN `products` ON `transactions`.`trProductId`=`products`.`productId` WHERE `trProductId` = '$product[productId]' ORDER BY `trId` DESC");
		                                	$n=1;
		                                	while ($trans = mysqli_fetch_array($selectedtrans)) {
		                                		if ($trans['trOperation']=='Out') {
		                                			$trOperation = 'Gucuruza';
		                                		}
		                                		elseif($trans['trOperation']=='In') {
		                                			$trOperation = 'Kurangura';
		                                		}
		                                		elseif($trans['trOperation']=='Wasted') {
		                                			$trOperation = 'Impfabusa:'.$trans['trComment'];
		                                		}
		                                		else {
		                                			$trOperation = 'Gukora imvange';
		                                		}
		                                		?>
		                                		<tr>
		                                			<td><?php echo $n++; ?></td>
		                                			<td><?php echo date("d M Y",$trans['doneDate']); ?></td>
		                                			<td><?php echo $trOperation; ?></td>
		                                			<td><?php echo $trans['productUnit'].' '.number_format($trans['trQty']); ?></td>
		                                			<td><?php echo number_format($trans['trUnityPrice']); ?> Rwf</td>
		                                			<td><?php echo number_format($trans['trPayedAmount']); ?> Rwf</td>
		                                			<td><?php echo number_format($trans['trNonPaidAmount']); ?> Rwf</td>
		                                			<td><?php echo $trans['userNames']; ?></td>
		                                		</tr>
		                                		<?php
		                                	}
		                                	if (mysqli_num_rows($selectedtrans)==0) {
		                                		?>
		                                		<tr>
		                                			<td colspan="8">
		                                				<center>Ntakirakorwa nakimwe muri sitoke kuriki gicuruzwa</center>
		                                			</td>
		                                		</tr>
		                                		<?php
		                                	}
		                                ?>
		                            	</tbody>
		                            </table>
					      		</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
					      		</div>
					    	</div>
					    </div>
					</div>
					<div id="adjust<?php echo $product['productId'] ?>" class="modal fade small-modal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
					      		<div class="modal-header bg-green">
					        		<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
					        		<h4 class="modal-title text-white"><?php echo strtoupper($product['productName']); ?></h4>
					      		</div>
					      		<div class="modal-body">
					      			<form id="adjustform<?php echo $product['productId'] ?>" onsubmit="return adjustproduct(<?php echo $product['productId'] ?>)">
					      				<h5>Kuramo ibyabaye imfabusa</h5>
										<div class="form-group"> 
											<label>Ingano y'impfabusa</label>
											<input type="number" class="form-control" name="lostqty<?php echo $product['productId'] ?>" id="lostqty<?php echo $product['productId'] ?>">
										</div>
										<div class="form-group"> 
											<label>Impamvu byapfuyubusa</label>
											<textarea placeholder="Eg: Byaburiye mugukora imvange." maxlength="100" id="comment<?php echo $product['productId'] ?>" name="comment<?php echo $product['productId'] ?>" class="form-control"></textarea>
										</div>
										<div id="adjuststatus<?php echo $product['productId'] ?>"></div>
										<button type="button" onclick="adjustproduct(<?php echo $product['productId'] ?>)" name="adjust" id="adjust" class="btn btn-success btn-sm btn-curve form-control">Kuramo</button>
									</form>	
					      		</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn btn-default" data-dismiss="modal">Funga</button>
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
	<script type="text/javascript">
		function disableproduct(productId) {
			var confirming = confirm("Urashaka gufunga iki gicuruzwa?");
			if (!confirming) {
				alert('Ok! Igicuruzwa kiracyarimo!');
				return false;
			}
			else {
				document.location.href = 'stock/disableproduct/'+productId;
			}
		}

		function enableproduct(productId) {
			var confirming = confirm("Urashaka gufungura iki gicuruzwa?");
			if (!confirming) {
				alert('Ok! iki gicuruzwa kiracyafunze!');
				return false;
			}
			else {
				document.location.href = 'stock/enableproduct/'+productId;
			}
		}

		// Number Format
		Number.prototype.formatMoney = function(c, d, t) {
			var n = this, 
		    c = isNaN(c = Math.abs(c)) ? 2 : c, 
		    d = d == undefined ? "." : d, 
		    t = t == undefined ? "," : t, 
		    s = n < 0 ? "-" : "", 
		    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
		    j = (j = i.length) > 3 ? j % 3 : 0;
		   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		};
		
		// BEGIN PURCHASE FUNCTIONS
		function getItemsDet() {
			var productId = document.getElementById('productId').value;
			$("#otherpurchaseinfo").html('<p class="text-success">Processing...</p>');
			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 		: 'selectpurchase',
					productId 	: productId
				},
				success : function(html, textStatus){
					$("#otherpurchaseinfo").html(html);
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
					$("#otherpurchaseinfo").html(errorThrown);
				}
			});
		}

		function purchaseTotal() {
			var productQty = document.getElementById('Qty').value;
			var productUnitPrice = document.getElementById('unityPrice').value;
			var purchaseTotalPrice = productQty * productUnitPrice;
			var paymentStatus = document.getElementById('paymentStatus').value;
			document.getElementById('purchaseTotalPrice').value = (purchaseTotalPrice).formatMoney(0);
			if (paymentStatus == 'Full Paid') {
				document.getElementById('purchasePaidPrice').value = purchaseTotalPrice;
				document.getElementById("purchasePaidPrice").readOnly = true;
			}
			else if (paymentStatus == 'Partial Paid') {
				document.getElementById('purchasePaidPrice').value = 0;
				document.getElementById("purchasePaidPrice").readOnly = false;
			}
			else {
				document.getElementById('purchasePaidPrice').value = 0;
				document.getElementById("purchasePaidPrice").readOnly = true;
			}
		}

		function paidamountchange() {
			var paymentStatus = document.getElementById('paymentStatus').value;
			var productQty = document.getElementById('Qty').value;
			var productUnitPrice = document.getElementById('unityPrice').value;
			var purchaseTotalPrice = productQty * productUnitPrice;
			if (paymentStatus == 'Full Paid') {
				document.getElementById('purchasePaidPrice').value = purchaseTotalPrice;
				document.getElementById("purchasePaidPrice").readOnly = true;
			}
			else if (paymentStatus == 'Partial Paid') {
				document.getElementById('purchasePaidPrice').value = 0;
				document.getElementById("purchasePaidPrice").readOnly = false;
			}
			else {
				document.getElementById('purchasePaidPrice').value = 0;
				document.getElementById("purchasePaidPrice").readOnly = true;
			}
		}
		
		function insertItem() {
			var productId = document.getElementById('productId').value;
			var supplierId = document.getElementById('supplierId').value;
			var unityPrice = document.getElementById('unityPrice').value;
			var Qty = document.getElementById('Qty').value;
			var purchasePaidPrice = document.getElementById('purchasePaidPrice').value;
			var paymentMethod = document.getElementById('paymentMethod').value;
			var paymentStatus = document.getElementById('paymentStatus').value;
			if (unityPrice < 1) {
				alert("Shyiramo ayo uranguyeho");
				return false;
			}
			if (Qty < 1) {
				alert("Shyiramo ingano y'ibyo uranguye");
				return false;
			}
			if (paymentStatus != 'Zero Paid' && paymentMethod == '') {
				alert("Shyiramo uburyo wakoresheje wishyura");
				return false;
			}
			if (paymentStatus == '') {
				alert("Hitamo niba wishyuye yose cg igice cg aridene");
				return false;
			}
			if (paymentStatus == 'Partial Paid' && purchasePaidPrice <= 100) {
				alert("Shyiramo ayo wishyuye");
				return false;
			}
			if (purchasePaidPrice > (Qty*unityPrice)) {
				alert("Wishyuye Menshi! Reba neza");
				return false;
			}
			if (supplierId == '') {
				var confirming = confirm("Ntago ushaka gushyiraho uwuranguyeho?");
				if (!confirming) {
					alert("Muhitemo ntakibazo");
					return false;
				}
				else {
					alert("ntakibazo");
				}
			}
			$("#instatus").html('<p class="text-success">Saving transaction...</p>');
			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 				: 'intransaction',
					productId 			: productId,
					supplierId 			: supplierId,
					unityPrice 			: unityPrice,
					Qty 				: Qty,
					purchasePaidPrice 	: purchasePaidPrice,
					paymentMethod 		: paymentMethod,
					paymentStatus 		: paymentStatus
				},
				success : function(html, textStatus){
					document.getElementById("purchaseform").reset();
					$("#otherpurchaseinfo").html("");
					$("#instatus").html(html);
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
					$("#instatus").html(errorThrown);
				}
			});
		}
		// END OF PURCHASE FUNCTIONS
		
		// BEGIN SELL FUNCTIONS
		function getItemsellDet() {
			var productId = document.getElementById('soldproductId').value;
			$("#othersellinfo").html('<p class="text-success">Processing...</p>');
			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 		: 'selectsell',
					productId 	: productId
				},
				success : function(html, textStatus){
					$("#othersellinfo").html(html);
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
					$("#othersellinfo").html(errorThrown);
				}
			});
		}

		function sellTotal() {
			var productQty = document.getElementById('soldQty').value;
			var productUnitPrice = document.getElementById('soldUnityPrice').value;
			var sellTotalPrice = productQty * productUnitPrice;
			var paymentStatus = document.getElementById('soldpaymentStatus').value;
			document.getElementById('sellTotalPrice').value = (sellTotalPrice).formatMoney(0);
			if (paymentStatus == 'Full Paid') {
				document.getElementById('sellPaidPrice').value = sellTotalPrice;
				document.getElementById("sellPaidPrice").readOnly = true;
			}
			else if (paymentStatus == 'Partial Paid') {
				document.getElementById('sellPaidPrice').value = 0;
				document.getElementById("sellPaidPrice").readOnly = false;
			}
			else {
				document.getElementById('sellPaidPrice').value = 0;
				document.getElementById("sellPaidPrice").readOnly = true;
			}
		}

		function soldpaidamountchange() {
			var paymentStatus = document.getElementById('soldpaymentStatus').value;
			var productQty = document.getElementById('soldQty').value;
			var productUnitPrice = document.getElementById('soldUnityPrice').value;
			var sellTotalPrice = productQty * productUnitPrice;
			if (paymentStatus == 'Full Paid') {
				document.getElementById('sellPaidPrice').value = sellTotalPrice;
				document.getElementById("sellPaidPrice").readOnly = true;
			}
			else if (paymentStatus == 'Partial Paid') {
				document.getElementById('sellPaidPrice').value = 0;
				document.getElementById("sellPaidPrice").readOnly = false;
			}
			else {
				document.getElementById('sellPaidPrice').value = 0;
				document.getElementById("sellPaidPrice").readOnly = true;
			}
		}
		
		function sellItem() {
			var productId = document.getElementById('soldproductId').value;
			var supplierId = document.getElementById('clientId').value;
			var unityPrice = document.getElementById('soldUnityPrice').value;
			var Qty = document.getElementById('soldQty').value;
			var maxsoldqty = document.getElementById('maxsoldqty').value;
			var sellPaidPrice = document.getElementById('sellPaidPrice').value;
			var paymentMethod = document.getElementById('soldpaymentMethod').value;
			var paymentStatus = document.getElementById('soldpaymentStatus').value;
			if (maxsoldqty == 0) {
				alert("Banza urangure kuko byashize muri sitoke");
				return false;
			}
			if (Number(maxsoldqty) < Number(Qty)) {
				alert("Warengeje umubare wibiri muri sitoke");
				return false;
			}
			if (unityPrice < 1) {
				alert("Shyiramo igiciro ugurishijeho");
				return false;
			}
			if (Qty < 1) {
				alert("Shyiramo ingano y'ibyo aguze");
				return false;
			}
			if (paymentStatus != 'Zero Paid' && paymentMethod == '') {
				alert("Shyiramo uburyo yakoresheje yishyura");
				return false;
			}
			if (paymentStatus == '') {
				alert("Hitamo niba wishyuwe yose cg igice cg aridene");
				return false;
			}
			if (paymentStatus == 'Partial Paid' && sellPaidPrice <= 100) {
				alert("Shyiramo ayo wishyuwe");
				return false;
			}
			if (sellPaidPrice > (Qty*unityPrice)) {
				alert("Wishyuwe Menshi! Reba neza");
				return false;
			}
			if (supplierId == '') {
				var confirming = confirm("Ntabwo uhitamo umukiriya? sitegeko wakomeza utabishaka");
				if (!confirming) {
					alert("Muhitemo ntakibazo");
					return false;
				}
				else {
					alert("Ntakibazo");
				}
			}
			$("#outstatus").html('<p class="text-success">Saving transaction...</p>');
			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 				: 'outtransaction',
					productId 			: productId,
					clientId 			: supplierId,
					soldUnityPrice 		: Number(unityPrice),
					soldQty 			: Number(Qty),
					sellPaidPrice 		: Number(sellPaidPrice),
					paymentMethod 		: paymentMethod,
					paymentStatus 		: paymentStatus
				},
				success : function(html, textStatus){
					document.getElementById("sellform").reset();
					$("#outstatus").html(html);
					$("#othersellinfo").html("");
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
					$("#outstatus").html(errorThrown);
				}
			});
		}
		// END OF SELL FUNCTIONS

		// MAKE MIXTURE FUNCTIONS
		function getmixitem() {
			var totalitems = document.getElementById('totalitems').value;
			var selectableitems = document.getElementsByClassName('selectableitem');
			var productsarray = [];
			var foundunfilled = false;
			var maxqtyviolet = false;
			for (var i = 0; i < selectableitems.length; i++) {
				if (i%2==0) {
					productsarray.push(selectableitems[i].value.split("/")[0]);
					if (selectableitems[i].value.split("/")[0] == '') {
						foundunfilled = true;
					}
					if (selectableitems[i+1].value == '' || Number(selectableitems[i+1].value) < 1) {
						foundunfilled = true;
					}
					if (Number(selectableitems[i+1].value) > Number(selectableitems[i].value.split("/")[1])) {
						maxqtyviolet = true;
					}
				}
			}
			if (foundunfilled) {
				alert("banza wuzuze neza ibyigicuruzwa cyibanza byose.");
				return false;
			}
			if (maxqtyviolet) {
				alert("Haribyushaka kuvanga byinshi bitari muri sitoke");
				return false;
			}
			$.ajax({
		        type: "POST",
		        url: "action.php",
		        data: {
		        	action 			: 'getothermixitems',
		        	productsarray 	: productsarray,
		        	totalitems 		: totalitems
		        }, 
		        success: function(message) {
		        	if (message != 'No More') {
						document.getElementById('totalitems').value=(totalitems+1);
			        	$('#mixform #othermixitems').html(message);
			        }
			        else {
			        	alert('Ntabindi bisigaye muri stock byo kuvangamo');
			        }
		        }
		    });
		}
		function makemixture() {
			var totalitems = document.getElementById('totalitems').value;
			var mixprice = document.getElementById('mixprice').value;
			var selectableitems = document.getElementsByClassName('selectableitem');
			var mixture = [];
			var foundunfilled = false;
			var maxqtyviolet = false;
			if (totalitems<2) {
				alert('Uvanga nibura ibicuruzwa bibiri');
				return false;
			}
			for (var i = 0; i < selectableitems.length; i++) {
				if (i%2==0) {
					if (selectableitems[i].value.split("/")[0] == '') {
						foundunfilled = true;
					}
					if (selectableitems[i+1].value == '' || Number(selectableitems[i+1].value) < 1) {
						foundunfilled = true;
					}
					if (Number(selectableitems[i+1].value) > Number(selectableitems[i].value.split("/")[1])) {
						maxqtyviolet = true;
					}
					var product = {};
					product.productId = selectableitems[i].value.split("/")[0];
					product.Qty = Number(selectableitems[i+1].value);
					mixture.push(product);
				}
			}
			if (foundunfilled) {
				alert("banza wuzuze neza ibyigicuruzwa cyibanza byose.");
				return false;
			}
			if (maxqtyviolet) {
				alert("Haribyushaka kuvanga byinshi bitari muri sitoke");
				return false;
			}
			$('#mixform #messageplace').html('<p class="text-success">System iri kuvanga...</p>');
			$.ajax({
		        type: "POST",
		        url: "action.php",
		        data: {
		        	action 		: 'mix',
		        	mixture 	: mixture,
		        	mixprice 	: mixprice,
		        	totalitems 	: totalitems
		        }, 
		        success: function(message) {
		        	if(message == 'Saved') {
			        	$('#mixform #messageplace').html('<p class="text-success">Imvange yakozwe.</p>');
			        	$('#mixform #othermixitems').html('');
						document.getElementById("mixform").reset();
			        }
			        else {
			        	$('#mixform #messageplace').html('<p class="text-danger">'+message+'</p>');
			        }
		        },
		        error: function(e) {
		        	alert(e);
		        }
		    });
		}
		// END OF MAKE MIXTURE FUNCTIONS

		// STOCK ADJUSTMENT
		function adjustproduct(proid) {
			// alert(proid);
			var lostqty = document.getElementById('lostqty'+proid).value;
			var comment = document.getElementById('comment'+proid).value;
			if (lostqty<1) {
				alert('Reba neza ingano yibyapfuyubusa ushyizemo');
				return false;
			}
			if (comment.length<5) {
				alert('Sobanura uko byapfuyubusa neza');
				return false;
			}
			$('#adjuststatus').html('<p class="text-success">System iri gukuramo impfabusa...</p>');
			$.ajax({
		        type: "POST",
		        url: "action.php",
		        data: {
		        	action 		: 'adjust',
		        	productId 	: proid,
		        	lostqty 	: lostqty,
		        	comment 	: comment
		        }, 
		        success: function(message) {
		        	if(message == 'Saved') {
						$('#adjuststatus'+proid).html('<p class="text-success">Impfabusa zakuwemo muri system.</p>');
						document.getElementById("adjustform"+proid).reset();			        
					}
			        else {
						$('#adjuststatus'+proid).html('<p class="text-success">'+message+'</p>');
			        }
		        },
		        error: function(e) {
		        	alert(e);
		        }
		    });
		}
		// END OF STOCK ADJUSTMENT

	</script>
</body>
</html>
