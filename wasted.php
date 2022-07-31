<?php 
	include 'adminaccess.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>IMPFABUSA</title>		
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
			    <!-- <div class="col-md-2">
			    </div> -->
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-12">
                    <div class="panel panel-topborder-green">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-sm btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <h4 class="panel-title"><b>IBYAPFUYUBUSA</b></h4>
                        </div>
                        <div class="panel-body">
                        	<div class="row m-b-10">
                        		<div class="col-md-3"></div>
								<div class="flexedspaced col-md-6">
									<input type="date" class="form-control" id="startdate" max="<?php
								         echo date('Y-m-d');
								     	?>" 
								     onchange="minchange()" />
									<div style="padding-right: 10px;padding-left: 10px;padding-top: 10px">Kugeza</div>
									<input type="date" class="form-control" id="enddate" onchange="maxchange()" />
								</div>
                        		<div class="col-md-3"></div>
	                        </div>
                        	<div id="tablespace">
	                            <table id="data-table" class="table table-striped table-bordered table-condensed">
	                                <thead>
	                                    <tr>
											<th>#</th>
											<th>Itariki</th>
											<th>Icyakozwe</th>
											<th>Ingano</th>
											<th>Ikiranguzo</th>
											<th>Yose hamwe</th>
											<th>Uwabikoze</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                <?php  
	                                	$selectedtrans = $db->query("SELECT * FROM `wastedtransactions` ORDER BY `trId` DESC");
	                                	$n=1;
			                        	$wastedprice = 0;
				                    	while ($trans = mysqli_fetch_array($selectedtrans)) {
			                        		$wastedprice = $watedprice + ($trans['trPurchasePrice']*$trans['trQty']);
	                                		?>
	                                		<tr>
	                                			<td><?php echo $n++; ?></td>
	                                			<td><?php echo date("d M Y",$trans['doneDate']); ?></td>
	                                			<td><?php echo 'Impfabusa: '.$trans['trComment']; ?></td>
	                                			<td><?php echo $trans['productName'].', '.$trans['productUnit'].' '.number_format($trans['trQty']); ?></td>
	                                			<td><?php echo number_format($trans['trPurchasePrice']); ?> Rwf</td>
	                                			<td><?php echo number_format($trans['trPurchasePrice']*$trans['trQty']); ?> Rwf</td>
	                                			<td><?php echo $trans['userNames']; ?></td>
	                                		</tr>
	                                		<?php
	                                	}
	                                ?>
	                            	</tbody>
	                            </table>
	                            <div class="small-modal">
	                            	<div class="btn btn-curve bg-red text-white form-control">Igiteranyo cyayarangujwe  : <?php echo number_format($wastedprice); ?> Rwf</div>
	                            </div>
	                        </div>
                        </div>
                    </div>
			    </div>
			    <!-- end col-10 -->
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
			enddate.setAttribute("min", startdate.value);

			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 		: 'getwasted',
					from 		: startdate.value,
					to 			: enddate.value
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
			$.ajax({
				type : "POST",
				url : "action.php",
				dataType : "html",
				cache : "false",
				data : {
					action 		: 'getwasted',
					from 		: startdate.value,
					to 			: enddate.value
				},
				success : function(html, textStatus){
					$("#tablespace").html(html);
				},
				error : function(xht, textStatus, errorThrown){
					alert("Error : " + errorThrown);
				}
			});
		}
	</script>
</body>
</html>
