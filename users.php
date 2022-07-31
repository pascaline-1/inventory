<?php 
	include 'adminaccess.php'; 
?>
<?php  
	if (isset($_POST['adduser'])) {
		$telephone = $_POST['userPhone'];
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
			$userId = time();
			$createdDate = time();
			$hashpassword = $_POST['userPassword'];
			$insertuser = $db ->query("INSERT INTO `system_users`(`userId`, `userNames`, `userPhone`, `userEmail`, `userPassword`, `userType`, `confirmationCode`, `remembeCode`, `active`, `disabledTime`) VALUES ('$userId','$_POST[userNames]','$cleanphone','$_POST[userEmail]','$hashpassword','$_POST[userType]',NULL,NULL,'Yes',NULL)");
			if ($insertuser) {
				?>
				<script type="text/javascript">
					alert("Umukozi <?php echo $_POST['userNames'] ?> yashyizwe muri system.");
					document.location.href = '<?php echo $baseurl; ?>users';
				</script>
				<?php
			}
			else {
				?>
				<script type="text/javascript">
					alert("Umukozi <?php echo $_POST['userNames'] ?> ntabashije kujya muri system. ongera ugerageze.");
					document.location.href = '<?php echo $baseurl; ?>users';
				</script>
				<?php
			}
	    }
	    else {
			?>
			<script type="text/javascript">
				alert("Nimero ya telephone mwashyizemo yanditse nabi. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>users';
			</script>
			<?php
	    }

	}
?>
<?php  
	if (isset($_POST['updateuser'])) {
		$telephone = $_POST['userPhone'];
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
			$getUser = $db->query("SELECT * FROM `system_users` WHERE userId = '$_POST[userId]'");
			$user = mysqli_fetch_array($getUser);
			$userPassword = $_POST['userPassword'];
			if ($user['userPassword'] == $userPassword) {
				$updateuser = $db ->query("UPDATE `system_users` SET `userNames`='$_POST[userNames]',`userPhone`='$cleanphone',`userEmail`='$_POST[userEmail]',`userType`='$_POST[userType]',`confirmationCode`=NULL,`remembeCode`=NULL,`active`='$user[active]',`disabledTime`='$user[disabledTime]' WHERE `userId`='$_POST[userId]'");
			}
			else {
				$updateuser = $db ->query("UPDATE `system_users` SET `userNames`='$_POST[userNames]',`userPhone`='$cleanphone',`userEmail`='$_POST[userEmail]',`userPassword`='$userPassword',`userType`='$_POST[userType]',`confirmationCode`=NULL,`remembeCode`=NULL,`active`='$user[active]',`disabledTime`='$user[disabledTime]' WHERE `userId`='$_POST[userId]'");
			}
			if ($updateuser) {
				?>
				<script type="text/javascript">
					alert("Umukozi <?php echo $_POST['userNames'] ?> yahinduriwe ibimuranga");
					document.location.href = '<?php echo $baseurl; ?>users';
				</script>
				<?php
			}
			else {
				?>
				<script type="text/javascript">
					alert("Umukozi <?php echo $_POST['userNames'] ?> ntiyahinduriwe ibimuranga. ongera ugerageze.");
					document.location.href = '<?php echo $baseurl; ?>users';
				</script>
				<?php
			}
		}
	    else {
			?>
			<script type="text/javascript">
				alert("Nimero ya telephone mwashyizemo yanditse nabi. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>users';
			</script>
			<?php
	    }
	}
?>
<?php  
	if (isset($url[1]) && isset($url[2]) && $url[1] == 'disableuser') {
		$disabledTime = time();
		$disableuser = $db ->query("UPDATE `system_users` SET `disabledTime`='$disabledTime', `active`='No' WHERE `userId`='$url[2]'");
		if ($disableuser) {
			?>
			<script type="text/javascript">
				alert("umukozi <?php echo $_POST['userName'] ?> yafungiwe konte ye.");
				document.location.href = '<?php echo $baseurl; ?>users';
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("umukozi <?php echo $_POST['userName'] ?> ntiyafungiwe konte ye. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>users';
			</script>
			<?php
		}
	}
?>
<?php    
	if (isset($url[1]) && isset($url[2]) && $url[1] == 'enableuser') {
		$enabledTime = time();
		$enableuser = $db ->query("UPDATE `system_users` SET `disabledTime`=NULL, `active`='Yes' WHERE `userId`='$url[2]'");
		if ($enableuser) {
			?>
			<script type="text/javascript">
				alert("umukozi <?php echo $_POST['userName'] ?> yasubijwe konte ye");
				document.location.href = '<?php echo $baseurl; ?>users';
			</script>
			<?php
		}
		else {
			?>
			<script type="text/javascript">
				alert("umukozi <?php echo $_POST['userName'] ?> ntarasubizwa konte ye. ongera ugerageze.");
				document.location.href = '<?php echo $baseurl; ?>users';
			</script>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Abakozi</title>		
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
                                <a href="users#userfoarm" class="xs-hidden btn btn-sm btn-icon btn-circle btn-success"><i class="fa fa-plus"></i></a>
                            </div>
                            <h4 class="panel-title"><b>ABAKOZI BOSE</b></h4>
                        </div>
                        <div class="panel-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Amazina</th>
                                        <th>Telephone</th>
                                        <th>Email</th>
                                        <th>Icyakora</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php  
                                		$selectusers = $db->query("SELECT * FROM `system_users` ORDER BY `userId` ASC");
                                		$n=0;
                                		while ($user = mysqli_fetch_array($selectusers)) {
											if ($user['active'] == 'No') {
												$background = 'bg-red';
												$status = 'Konte irafunze';
											}
											else {
												$background = '';
												$status = 'Konte Irafunguye';
											}	
                                			?>
		                                	<tr>
		                                		<td class="<?php echo $background ?>">
		                                			#<?php echo ++$n; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $user['userNames']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $user['userPhone']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $user['userEmail']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $user['userType']; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
		                                			<?php echo $status; ?>
		                                		</td>
		                                		<td class="<?php echo $background ?>">
													<a href="users/updateuser/<?php echo $user['userId']; ?>">
				                                    	<center class="action">
					                                    	<i class="fa fa-edit pull-left text-green" style="font-size: 20px;cursor:pointer"></i>
					                                    </center>
					                                </a>
					                                <?php  
					                                	if ($user['userId'] != $loggedUser['userId']) {
															if ($user['disabledTime'] == NULL) {
																?>
																	<a href="javascript:;" onclick="return disableuser('<?php echo $user['userId']; ?>')">
								                                    	<center class="action">
									                                    	<i class="fa fa-trash pull-right text-danger" style="font-size: 20px;cursor:pointer"></i>
									                                    </center>
									                                </a>
																<?php
															}
															else {
																?>
																	<a href="javascript:;" onclick="return enableuser('<?php echo $user['userId']; ?>')">
								                                    	<center class="action">
									                                    	<i class="fa fa-check pull-right text-success" style="font-size: 20px;cursor:pointer"></i>
									                                    </center>
									                                </a>
																<?php
															}
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
			    <div class="col-md-3" id="userfoarm">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div> 
                            <?php
				     			if (isset($url[1]) && $url[1]=='updateuser' && isset($url[2]) && $url[2]!='') {
				     				$getusertoedit = $db ->query("SELECT * FROM `system_users` WHERE `userId` = '$url[2]'");
				     				if (mysqli_num_rows($getusertoedit)>0) {
				     					$edituser = mysqli_fetch_array($getusertoedit);
				     					?>
                            			<h4 class="panel-title"><b>HINDURA <?php echo strtoupper($edituser['userNames']) ?></b></h4>
				     					<?php
				     				}
				     				else {
				     					?>
										<script type="text/javascript">
											alert("Umukozi mushaka guhindura ntari muri system yanyu.");
											document.location.href = 'users';
										</script>
				     					<?php
				     				}
				     			}
				     			else {
			     					?>
                            		<h4 class="panel-title"><b>UMUKOZI MUSHYA</b></h4>
			     					<?php
								}
							?>
                        </div>
                        <div class="panel-body">
                            <?php
				     			if (isset($url[1]) && $url[1]=='updateuser' && isset($url[2]) && $url[2]!='') {
				     				$getusertoedit = $db ->query("SELECT * FROM `system_users` WHERE userId = '$url[2]'");
				     				if (mysqli_num_rows($getusertoedit)>0) {
				     					$edituser = mysqli_fetch_array($getusertoedit);
				     					?>
										 	<form method="post">
										 		<div class="form-group">
								     				<label>Amazina*</label>
								     				<input type="text" id="userNames" name="userNames" class="form-control" value="<?php echo $edituser['userNames'] ?>" required>
								     				<input type="hidden" id="userId" name="userId" value="<?php echo $edituser['userId'] ?>" required>
								     			</div>
										 		<div class="form-group">
								     				<label>Telephone*</label>
								     				<input type="text" id="userPhone" name="userPhone" class="form-control" value="<?php echo $edituser['userPhone'] ?>" required>
								     			</div>
										 		<div class="form-group">
								     				<label>Email (Sitegeko)</label>
								     				<input type="email" id="userEmail" name="userEmail" class="form-control" value="<?php echo $edituser['userEmail'] ?>">
								     			</div>
										 		<div class="form-group">
								     				<label>Icyakora</label>
								     				<select id="userType" name="userType" class="form-control">
								     					<option value="Cashier" 
								     						<?php 
								     						if ($edituser['userType'] == 'Cashier') {
									     						echo 'selected';
									     					} 
									     					?>
								     					>
									     					Ucuruza
									     				</option>
								     					<option value="Stock" 
								     						<?php 
								     						if ($edituser['userType'] == 'Stock') {
									     						echo 'selected';
									     					} 
									     					?>
								     					>
								     						Ushinzwe Sitoke</option>
								     					<option value="Admin" 
								     						<?php 
								     						if ($edituser['userType'] == 'Admin') {
								     							echo 'selected';
									     					} 
									     					?>
									     				>
									     					Ugenzura byose
									     				</option>
								     				</select>
								     			</div>
										 		<div class="form-group">
								     				<label>Password</label>
								     				<input type="password" id="userPassword" name="userPassword" class="form-control" value="<?php echo $edituser['userPassword'] ?>" required>
								     			</div>
										 		<div class="form-group" style="margin-top: 30px">
										 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="HINDURA IBIMURANGA" name="updateuser">
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
						     				<input type="text" id="userNames" name="userNames" class="form-control" placeholder="Ex: Aizo Kini" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Telephone*</label>
						     				<input type="text" id="userPhone" name="userPhone" class="form-control" placeholder="Ex: 0789754425" required>
						     			</div>
								 		<div class="form-group">
						     				<label>Email (Sitegeko)</label>
						     				<input type="email" id="userEmail" name="userEmail" class="form-control" placeholder="Ex: aizokini@gmail.com">
						     			</div>
								 		<div class="form-group">
						     				<label>Icyakora</label>
						     				<select id="userType" name="userType" class="form-control">
						     					<option value="Cashier">Ucuruza</option>
						     					<option value="Stock">Ushinzwe Sitoke</option>
						     					<option value="Admin">Ugenzura byose</option>
						     				</select>
						     			</div>
								 		<div class="form-group">
						     				<label>Password</label>
						     				<input type="password" id="userPassword" name="userPassword" class="form-control" placeholder="******" required>
						     			</div>
								 		<div class="form-group" style="margin-top: 30px">
								 			<input type="submit" class="btn-curve custom-card form-control bg-green text-white" value="ONGERAHO UMUKOZI" name="adduser">
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
		function disableuser(userId) {
			var confirming = confirm("Urashaka gufunga konte yuyu mukozi?");
			if (!confirming) {
				alert('Ok! Konte ye aracyayifite!');
				return false;
			}
			else {
				document.location.href = 'users/disableuser/'+userId;
			}
		}
		function enableuser(userId) {
			var confirming = confirm("Urashaka gufungura konte yuyu mukozi?");
			if (!confirming) {
				alert('Ok! Konte ye iracyafunze!');
				return false;
			}
			else {
				document.location.href = 'users/enableuser/'+userId;
			}
		}
	</script>
</body>
</html>
