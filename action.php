<?php  
	include 'access.php';
	if (isset($_POST['action'])) {
		// GET PRODUCT AND WRITES OTHER PURCHASE INFO
		if($_POST['action'] == 'selectpurchase'){
			$productId = $_POST['productId'];
			$getselectedproduct = $db->query("SELECT * FROM `products` WHERE `productId` ='$productId'");
			if (mysqli_num_rows($getselectedproduct)>0) {
				$selectedproduct= mysqli_fetch_array($getselectedproduct);
				?>
					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Ingano:</label>
							<div class="input-group">
								<span class="input-group-addon"><?php echo $selectedproduct['productUnit']; ?></span>
								<input autocomplete="off" type="number" required="" min="1" name="Qty" id="Qty" onchange="purchaseTotal()" onkeyup="purchaseTotal()" class="form-control">
							</div>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Ikiranguzo:</label>
							<div class="input-group">
								<span class="input-group-addon">Rwf</span>
								<input autocomplete="off" type="number" min="1" class="form-control" placeholder=" < <?php echo $selectedproduct['productPrice']; ?>" required="" name="unityPrice" id="unityPrice" onchange="purchaseTotal()" onkeyup="purchaseTotal()">
							</div>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Arangura yose:</label>
							<div class="input-group">
								<span class="input-group-addon">Rwf</span>
								<input type="text" id="purchaseTotalPrice" class="form-control" disabled="">
							</div>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Uranguza:</label>
						    <select class="default-select2 form-control" name="supplierId" id="supplierId">
		                        <optgroup label="Hitamo Uranguza">
		                        	<option value="">HITAMO</option>
									<?php
										$getallsuppliers = $db->query("SELECT * FROM `suppliers` ORDER BY `supplierNames` ASC");
										while($supplier = mysqli_fetch_array($getallsuppliers))
										{
											echo'<option value="'.$supplier['supplierId'].'">'.$supplier['supplierNames'].'</option>';
										}
									?>
		                        </optgroup>
		                    </select>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Uko Yishyuwe:</label>
							<select name="paymentMethod" id="paymentMethod" class="form-control">
								<option value="Cash">Cash Payment</option>
								<option value="Mobile">Mobile Payment</option>
								<option value="Bank">Bank Payment</option>
							</select>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Ingano yayishyuwe:</label>
							<select class="form-control" name="paymentStatus" id="paymentStatus" onchange="paidamountchange()">
								<option value="">Hitamo</option>
								<option value="Full Paid">Yishyuwe yose</option>											
								<option value="Partial Paid">Ntiyishyuwe yose</option>											
								<option value="Zero Paid">Ntayishyuwe Nidene</option>											
							</select>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Ayishyuwe:</label>
							<div class="input-group">
								<span class="input-group-addon">Rwf</span>
								<input type="number" name="purchasePaidPrice" id="purchasePaidPrice" class="form-control" min="100" value="0">
							</div>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-12 col-sm-12 col-md-12">
						<div class="flexedcentered">
							<button type="button" onclick="insertItem()" class="btn btn-curve btn-md width-half-full btn-success text-white">RANGURA <i class="fa fa-long-arrow-left"></i></button>
						</div>
					</div>
				<?php
			}
		}

		// GET PRODUCT AND WRITES OTHER SELL INFO
		if($_POST['action'] == 'selectsell'){
			$productId = $_POST['productId'];
			$getselectedproduct = $db->query("SELECT * FROM `products` WHERE `productId` ='$productId'");
			if (mysqli_num_rows($getselectedproduct)>0) {
				$selectedproduct= mysqli_fetch_array($getselectedproduct);
				$selectFi = $db ->query("SELECT SUM(inTrQty) AS inTrQty FROM `intransactions` WHERE `inTrProductId` = '$productId'");
				$thisItem = mysqli_fetch_array($selectFi);
				$itemQty = $thisItem['inTrQty'];
				?>
					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label for="itemCode" class="control-label">Ingano y'ibiguzwe:</label>
							<div class="input-group">
								<span class="input-group-addon"><?php echo $selectedproduct['productUnit'] ?></span>
								<input type="number" required max="<?php echo $itemQty ?>" onkeyup="sellTotal()" name="soldQty" id="soldQty" class="form-control"/>
								<input type="number" required value="<?php echo $itemQty ?>" id="maxsoldqty" name="maxsoldqty" hidden/>
								<span class="input-group-addon"> <= <?php echo $itemQty ?></span>
							</div>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label for="itemCode" class="control-label">Igiciro:</label>
							<input type="number" required name="soldUnityPrice" id="soldUnityPrice" value="<?php echo $selectedproduct['productPrice'] ?>" onclick="sellTotal()" onkeyup="sellTotal()" class="form-control" min="100" />
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Ayishyurwa yose:</label>
							<div class="input-group">
								<span class="input-group-addon">Rwf</span>
								<input id="sellTotalPrice" class="form-control" disabled/>
							</div>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Umukiriya:</label>
						    <select class="default-select2 form-control" name="clientId" id="clientId">
		                        <optgroup label="Hitamo Umukiriya">
		                        	<option value="">HITAMO</option>
									<?php
										$getallclients = $db->query("SELECT * FROM `clients` ORDER BY `clientNames` ASC");
										while($client = mysqli_fetch_array($getallclients))
										{
											echo'<option value="'.$client['clientId'].'">'.$client['clientNames'].'</option>';
										}
									?>
		                        </optgroup>
		                    </select>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Uko Yishyuye:</label>
							<select name="soldpaymentMethod" id="soldpaymentMethod" class="form-control">
								<option value="Cash">Cash Payment</option>
								<option value="Mobile">Mobile Payment</option>
								<option value="Bank">Bank Payment</option>
							</select>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Ingano yayishyuwe:</label>
							<select class="form-control" name="soldpaymentStatus" id="soldpaymentStatus" onchange="soldpaidamountchange()">
								<option value="">Hitamo</option>
								<option value="Full Paid">Yishyuye yose</option>											
								<option value="Partial Paid">Ntiyishyuye yose</option>											
								<option value="Zero Paid">Ntayishyuye Nidene</option>											
							</select>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-6 col-sm-4 col-md-3">
						<div class="form-group"> 
							<label>Ayishyuwe:</label>
							<div class="input-group">
								<span class="input-group-addon">Rwf</span>
								<input type="number" name="sellPaidPrice" id="sellPaidPrice" class="form-control" min="100" value="0">
							</div>
						</div>
					</div>

					<div class="col-xxs-12 col-xs-12 col-sm-12 col-md-12">
						<div class="flexedcentered">
							<button type="button" onclick="sellItem()" class="btn btn-curve btn-md width-half-full btn-primary text-white">CURUZA <i class="fa fa-long-arrow-right"></i></button>
						</div>
					</div>
				<?php
			}
		}

		// INSERT IN TRANSACTION
		if($_POST['action'] == 'intransaction') {
			$ID = time();
			$doneOn = time();
			$nonPayedAmount = ($_POST['unityPrice'] * $_POST['Qty']) - $_POST['purchasePaidPrice'];
			$insertIntoIn = $db->query("INSERT INTO `intransactions`(`inTrId`, `InTrUnityprice`, `inTrQty`, `inPurchasedQty`, `inTrProductId`, `inTrDoneOn`) VALUES ('$ID','$_POST[unityPrice]','$_POST[Qty]','$_POST[Qty]','$_POST[productId]','$doneOn')")or die(mysqli_error());
			$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$ID','$_POST[supplierId]','$_POST[productId]','In','$_POST[unityPrice]','$_POST[unityPrice]','$_POST[Qty]','$_POST[purchasePaidPrice]','$nonPayedAmount','$_POST[paymentMethod]','$_POST[paymentStatus]','$doneOn','$loggedUser[userId]')")or die(mysqli_error());

			$getProduct = $db->query("SELECT * FROM `products` WHERE `productId` = '$_POST[productId]'");
			$purchasedproduct = mysqli_fetch_array($getProduct);
			echo'
				<div class="alert alert-success alert-dismissable">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <a href="#" class="alert-link">Kurangura '.$purchasedproduct['productName'].'</a> byabitswe muri system.
	            </div>
			';
		}

		// INSERT OUT TRANSACTION
		if($_POST['action'] == 'outtransaction'){
			$transId = time();
			$doneOn = time();

			$unityPrice = $_POST['soldUnityPrice'];
			$qty = $_POST['soldQty'];
			$productId = $_POST['productId'];
			$operation = 'Out';
			$nonPayedAmount = ($_POST['soldUnityPrice'] * $_POST['soldQty']) - $_POST['sellPaidPrice'];
			
			// USE FIFO METHOD IN intransaction TABLE
			$selectFi = $db ->query("SELECT * FROM `intransactions` WHERE `inTrProductId` = '$productId' AND `inTrQty` > 0 LIMIT 1");
			$thisItem = mysqli_fetch_array($selectFi);
			$itemQty = $thisItem['inTrQty'];
			$trID = $thisItem['inTrId'];
			$itemPurchasePrice = $thisItem['InTrUnityprice'];
			if ($itemQty >= $qty) {
				$itemQty = $itemQty - $qty;
				$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId','$_POST[clientId]','$productId','$operation','$itemPurchasePrice','$unityPrice','$qty','$_POST[sellPaidPrice]','$nonPayedAmount','$_POST[paymentMethod]','$_POST[paymentStatus]','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
				if ($insertIntoTr) {
					$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = '$itemQty' WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
				}
				
			}
			else {
				$sellPaidPrice = $_POST['sellPaidPrice'];
				if ($sellPaidPrice >= $_POST['soldUnityPrice'] * $itemQty) {
					$payedAmount = $_POST['soldUnityPrice'] * $itemQty;
					$nonPayedAmount = 0;
					$paymentStatus = 'Full Paid';
					$sellPaidPrice = $sellPaidPrice - $_POST['soldUnityPrice'] * $itemQty;
				}
				else {
					$payedAmount = $sellPaidPrice;
					$nonPayedAmount = ($_POST['soldUnityPrice'] * $itemQty) - $sellPaidPrice;
					if ($payedAmount == 0) {
						$paymentStatus = 'Zero Paid';
					}
					else {
						$paymentStatus = 'Partial Paid';
					}
					$sellPaidPrice = 0;
				}
				$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId','$_POST[clientId]','$productId','$operation','$itemPurchasePrice','$unityPrice','$itemQty','$payedAmount','$nonPayedAmount','$_POST[paymentMethod]','$paymentStatus','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
				if ($insertIntoTr) {
					$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = 0 WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
				}
				$qty = $qty - $itemQty;
				while ($qty > 0) {
					$selectFi = $db ->query("SELECT * FROM `intransactions` WHERE `inTrProductId` = '$productId' AND `inTrQty` > 0 LIMIT 1");
					$thisItem = mysqli_fetch_array($selectFi);
					$itemQty = $thisItem['inTrQty'];
					$trID = $thisItem['inTrId'];
					$itemPurchasePrice = $thisItem['InTrUnityprice'];
					sleep(1);
					$transId = time();
					if ($sellPaidPrice >= $_POST['soldUnityPrice'] * $itemQty) {
						$payedAmount = $_POST['soldUnityPrice'] * $itemQty;
						$nonPayedAmount = 0;
						$paymentStatus = 'Full Paid';
						$sellPaidPrice = $sellPaidPrice - $_POST['soldUnityPrice'] * $itemQty;
					}
					else {
						$payedAmount = $sellPaidPrice;
						$nonPayedAmount = ($_POST['soldUnityPrice'] * $itemQty) - $sellPaidPrice;
						if ($payedAmount == 0) {
							$paymentStatus = 'Zero Paid';
						}
						else {
							$paymentStatus = 'Partial Paid';
						}
						$sellPaidPrice = 0;
					}
					if ($itemQty >= $qty) {
						$itemQty = $itemQty - $qty;
						$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId','$_POST[clientId]','$productId','$operation','$itemPurchasePrice','$unityPrice','$qty','$payedAmount','$nonPayedAmount','$_POST[paymentMethod]','$paymentStatus','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
						if ($insertIntoTr) {
							$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = '$itemQty' WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
							$qty = 0;	
						}
						
					}
					else {
						$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId','$_POST[clientId]','$productId','$operation','$itemPurchasePrice','$unityPrice','$itemQty','$payedAmount','$nonPayedAmount','$_POST[paymentMethod]','$paymentStatus','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
						if ($insertIntoTr) {
							$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = 0 WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
							$qty = $qty - $itemQty;	
						}		
					}
				}
			}

			$getsoldproduct = $db->query("SELECT `productName` FROM `products` WHERE `productId` = '$productId' ");
			$product = mysqli_fetch_array($getsoldproduct);
			echo'
				<div class="alert alert-success alert-dismissable">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		            <a href="javascript:;" class="alert-link">Ugurishije '.$product['productName'].'.</a> Byashyizwe muri system.
	        	</div>
	        ';
		}

		// GET SALES ACCORDING TO DATES
		if($_POST['action'] == 'getsales'){
			$paymethod = $_POST['paymethod'];
			$paystatus = $_POST['paystatus'];
			$from = $_POST['from'];
			$to = $_POST['to'];

			if ($paystatus == 'Full Paid') {
				$querypaystatus = '`trPaymentStatus` = "Full Paid"';
				$paystatusmsg = 'Kishyuye';
			}
			elseif ($paystatus == "Partial or Zero Paid") {
				$querypaystatus = '(`trPaymentStatus` = "Partial Paid" OR `trPaymentStatus` = "Zero Paid")';
				$paystatusmsg = 'Kitishyuye cg kishyuye igice';
			}
			else {
				$querypaystatus = '(`trPaymentStatus` = "Full Paid" OR `trPaymentStatus` = "Partial Paid" OR `trPaymentStatus` = "Zero Paid")';
				$paystatusmsg = '';
			}
			if ($paymethod == 'uburyo bwose') {
				if ($from != '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from == '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from != '' && $to == '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND $querypaystatus ORDER BY `trId` DESC");
				}
				else {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE $querypaystatus ORDER BY `trId` DESC");
				}
			}
			else {
				if ($from != '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from == '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from != '' && $to == '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
				else {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
			}
			?>
				<div class="table-responsive">
	                <table id="data-table" class="table table-striped table-bordered table-condensed">
	                    <thead>
	                        <tr>
								<th>#</th>
								<th>Itariki</th>
								<th>Icyakozwe</th>
								<th>Ingano</th>
								<th>Igiciro</th>
								<th>Yose hamwe</th>
								<th>Ayishuye</th>
								<th>Atishyuye</th>
								<th>Uko yishyuye</th>
								<th>Umukiriya</th>
								<th>Uwabikoze</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php  
	                    	$n=1;
                        	$loan = 0;
                        	$paid = 0;
	                    	while ($trans = mysqli_fetch_array($selectedtrans)) {
                        		$paid = $paid + $trans['trPayedAmount'];
                        		$loan = $loan + $trans['trNonPaidAmount'];
                        		if ($trans['trOperation']=='Out') {
                        			$trOperation = 'Gucuruza';
                        		}
                        		else {
                        			$trOperation = 'Gukora imvange';
                        		}
	                    		?>
	                    		<tr>
	                    			<td><?php echo $n++; ?></td>
	                    			<td><?php echo date("d M Y",$trans['doneDate']); ?></td>
	                    			<td><?php echo $trOperation; ?></td>
	                    			<td><?php echo $trans['productName'].', '. $trans['productUnit'].' '.number_format($trans['trQty']); ?></td>
	                    			<td><?php echo number_format($trans['trUnityPrice']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trUnityPrice']*$trans['trQty']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trPayedAmount']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trNonPaidAmount']); ?> Rwf</td>
	                    			<td><?php echo $trans['trPaymentMethod']; ?></td>
	                    			<td><?php echo $trans['clientNames']; ?></td>
	                    			<td><?php echo $trans['userNames']; ?></td>
	                    		</tr>
	                    		<?php
	                    	}
                        	if (mysqli_num_rows($selectedtrans)==0) {
                        		?>
                        		<tr>
                        			<td colspan="10">
                        				<center>Ntacyagurishijwe kuva <?php echo $from ?> kugeza <?php echo $to; ?> hakoreshejwe <?php echo $paymethod.' '.$paystatusmsg ?></center>
                        			</td>
                        		</tr>
                        		<?php
                        	}
	                    ?>
	                	</tbody>
	                </table>
                    <div class="small-modal">
                    	<div class="btn btn-curve bg-blue text-white form-control">Ayarangujwe  : <?php echo number_format($loan + $paid); ?> Rwf</div>
                    	<div class="btn btn-curve bg-green text-white form-control">Ayishyuwe  : <?php echo number_format($paid); ?> Rwf</div>
                    	<div class="btn btn-curve bg-red text-white form-control">Atarishyurwa : <?php echo number_format($loan); ?> Rwf</div>
                    </div>
	            </div>
			<?php
		}

		// GET PURCHASES ACCORDING TO DATES
		if($_POST['action'] == 'getpurchases'){
			$paymethod = $_POST['paymethod'];
			$paystatus = $_POST['paystatus'];
			$from = $_POST['from'];
			$to = $_POST['to'];
			if ($paystatus == 'Full Paid') {
				$querypaystatus = '`trPaymentStatus` = "Full Paid"';
				$paystatusmsg = 'Kishyuye';
			}
			elseif ($paystatus == "Partial or Zero Paid") {
				$querypaystatus = '(`trPaymentStatus` = "Partial Paid" OR `trPaymentStatus` = "Zero Paid")';
				$paystatusmsg = 'Kitishyuye cg kishyuye igice';
			}
			else {
				$querypaystatus = '(`trPaymentStatus` = "Full Paid" OR `trPaymentStatus` = "Partial Paid" OR `trPaymentStatus` = "Zero Paid")';
				$paystatusmsg = '';
			}
			if ($paymethod == 'uburyo bwose') {
				if ($from != '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from == '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from != '' && $to == '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND $querypaystatus ORDER BY `trId` DESC");
				}
				else {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE $querypaystatus ORDER BY `trId` DESC");
				}
			}
			else {
				if ($from != '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from == '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
				elseif ($from != '' && $to == '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
				else {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE `trPaymentMethod` = '$paymethod' AND $querypaystatus ORDER BY `trId` DESC");
				}
			}
			?>
				<div class="table-responsive">
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
								<th>Uko Yishyuwe</th>
								<th>Uranguza</th>
								<th>Uwabikoze</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php  
	                    	$n=1;
                        	$loan = 0;
                        	$paid = 0;
	                    	while ($trans = mysqli_fetch_array($selectedtrans)) {
                        		$paid = $paid + $trans['trPayedAmount'];
                        		$loan = $loan + $trans['trNonPaidAmount'];
                        		if ($trans['trOperation']=='In') {
                        			$trOperation = 'Kurangura';
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
	                    			<td><?php echo number_format($trans['trUnityPrice']*$trans['trQty']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trPayedAmount']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trNonPaidAmount']); ?> Rwf</td>
	                    			<td><?php echo $trans['trPaymentMethod']; ?></td>
	                    			<td><?php echo $trans['supplierNames']; ?></td>
	                    			<td><?php echo $trans['userNames']; ?></td>
	                    		</tr>
	                    		<?php
	                    	}
                        	if (mysqli_num_rows($selectedtrans)==0) {
                        		?>
                        		<tr>
                        			<td colspan="10">
                        				<center>Ntacyaranguwe kuva <?php echo $from ?> kugeza <?php echo $to; ?> hakoreshejwe <?php echo $paymethod.' '.$paystatusmsg ?></center>
                        			</td>
                        		</tr>
                        		<?php
                        	}
	                    ?>
	                	</tbody>
	                </table>
                    <div class="small-modal">
                    	<div class="btn btn-curve bg-blue text-white form-control">Ayarangujwe  : <?php echo number_format($loan + $paid); ?> Rwf</div>
                    	<div class="btn btn-curve bg-green text-white form-control">Ayishyuwe  : <?php echo number_format($paid); ?> Rwf</div>
                    	<div class="btn btn-curve bg-red text-white form-control">Atarishyurwa : <?php echo number_format($loan); ?> Rwf</div>
                    </div>
	            </div>
			<?php
		}

		// GET LOANS ACCORDING TO DATES
		if($_POST['action'] == 'getloans'){
			$loantype = $_POST['loantype'];
			$from = $_POST['from'];
			$to = $_POST['to'];
			if ($loantype == 'In') {
				$loantypemsg = 'ry\'iduka';
				if ($from != '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trOperation`='In' ORDER BY `trId` DESC");
				}
				elseif ($from == '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trOperation`='In' ORDER BY `trId` DESC");
				}
				elseif ($from != '' && $to == '') {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND `trOperation`='In' ORDER BY `trId` DESC");
				}
				else {
	                $selectedtrans = $db->query("SELECT * FROM `intransactionsview` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND `trOperation`='In' ORDER BY `trId` DESC");
				}
			}
			else {
				$loantypemsg = 'ry\'abakiriya';
				if ($from != '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trOperation`='Out' ORDER BY `trId` DESC");
				}
				elseif ($from == '' && $to != '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' AND `trOperation`='Out' ORDER BY `trId` DESC");
				}
				elseif ($from != '' && $to == '') {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND `trOperation`='Out' ORDER BY `trId` DESC");
				}
				else {
	                $selectedtrans = $db->query("SELECT * FROM `outtransactions` WHERE (`trPaymentStatus` = 'Partial Paid' OR `trPaymentStatus` = 'Zero Paid') AND `trOperation`='Out' ORDER BY `trId` DESC");
				}
			}
			?>
				<div class="table-responsive">
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
		                        	if ($loantype == 'In') {
	                            		echo '<th>Uranguza</th>';
	                            	}                             	
		                        	else {
	                            		echo '<th>Umukiriya</th>';
	                            	} 
                    			?>
								<th>Uko Yishyuwe</th>
								<th>Uwabikoze</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php  
	                    	$n=1;
	                    	while ($trans = mysqli_fetch_array($selectedtrans)) {
	                    		?>
	                    		<tr>
	                    			<td><?php echo $n++; ?></td>
	                    			<td><?php echo date("d M Y",$trans['doneDate']); ?></td>
	                    			<td>Kurangura</td>
	                    			<td><?php echo $trans['productName'].', '. $trans['productUnit'].' '.number_format($trans['trQty']); ?></td>
	                    			<td><?php echo number_format($trans['trUnityPrice']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trUnityPrice']*$trans['trQty']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trPayedAmount']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trNonPaidAmount']); ?> Rwf</td>
                        			<?php                             	
			                        	if ($loantype == 'In') {
		                            		echo '<td>'.$trans['supplierNames'].'</td>';
		                            	}                             	
			                        	else {
		                            		echo '<td>'.$trans['clientNames'].'</td>';
		                            	} 
                        			?>
	                    			<td><?php echo $trans['trPaymentMethod']; ?></td>
	                    			<td><?php echo $trans['userNames']; ?></td>
	                    		</tr>
	                    		<?php
	                    	}
                        	if (mysqli_num_rows($selectedtrans)==0) {
                        		?>
                        		<tr>
                        			<td colspan="10">
                        				<center>Ntadene <?php echo $loantypemsg ?> kuva <?php echo $from ?> kugeza <?php echo $to; ?></center>
                        			</td>
                        		</tr>
                        		<?php
                        	}
	                    ?>
	                	</tbody>
	                </table>
	            </div>
			<?php
		}

		// GET WASTED ACCORDING TO DATES
		if($_POST['action'] == 'getwasted'){
			$from = $_POST['from'];
			$to = $_POST['to'];
			if ($from != '' && $to != '') {
	        	$selectedtrans = $db->query("SELECT * FROM `wastedtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' AND FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' ORDER BY `trId` DESC");
			}
			elseif ($from == '' && $to != '') {
	        	$selectedtrans = $db->query("SELECT * FROM `wastedtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') <= '$to' ORDER BY `trId` DESC");
			}
			elseif ($from != '' && $to == '') {
	        	$selectedtrans = $db->query("SELECT * FROM `wastedtransactions` WHERE FROM_UNIXTIME(doneDate,'%Y-%m-%d') >= '$from' ORDER BY `trId` DESC");
			}
			else {
	        	$selectedtrans = $db->query("SELECT * FROM `wastedtransactions` ORDER BY `trId` DESC");
			}
			?>
				<div class="table-responsive">
	                <table id="data-table" class="table table-striped table-bordered table-condensed">
	                    <thead>
	                        <tr>
								<th>#</th>
								<th>Itariki</th>
								<th>Icyakozwe</th>
								<th>Ingano</th>
								<th>Ikiranguzo</th>
								<th>Yose Hamwe</th>
								<th>Uwabikoze</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    <?php  
	                    	$n=1;
			                $wastedprice = 0;
	                    	while ($trans = mysqli_fetch_array($selectedtrans)) {
			                    $wastedprice = $watedprice + ($trans['trPurchasePrice']*$trans['trQty']);
	                    		?>
	                    		<tr>
	                    			<td><?php echo $n++; ?></td>
	                    			<td><?php echo date("d M Y",$trans['doneDate']); ?></td>
	                                <td><?php echo 'Impfabusa: '.$trans['trComment']; ?></td>
	                    			<td><?php echo $trans['productName'].', '. $trans['productUnit'].' '.number_format($trans['trQty']); ?></td>
	                    			<td><?php echo number_format($trans['trUnityPrice']); ?> Rwf</td>
	                    			<td><?php echo number_format($trans['trUnityPrice']*$trans['trQty']); ?> Rwf</td>
	                    			<td><?php echo $trans['userNames']; ?></td>
	                    		</tr>
	                    		<?php
	                    	}
                        	if (mysqli_num_rows($selectedtrans)==0) {
                        		?>
                        		<tr>
                        			<td colspan="10">
                        				<center>Ntampfabusa kuva <?php echo $from ?> kugeza <?php echo $to; ?></center>
                        			</td>
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
			<?php
		}

		// GET CREDITS ACCORDING TO DATES
		if($_POST['action'] == 'getcredits'){
			$from = $_POST['from'];
			$to = $_POST['to'];
			if ($from != '' && $to != '') {
	        	$selectcredits = $db->query("SELECT * FROM `credits` INNER JOIN `system_users` ON `credits`.`givenBy`=`system_users`.`userId` WHERE `crNonPaidAmount` > 0 AND FROM_UNIXTIME(creditDate) >= '$from' AND FROM_UNIXTIME(creditDate) <= '$to' ORDER BY `creditId` DESC");
			}
			elseif ($from == '' && $to != '') {
	        	$selectcredits = $db->query("SELECT * FROM `credits` INNER JOIN `system_users` ON `credits`.`givenBy`=`system_users`.`userId` WHERE `crNonPaidAmount` > 0 AND FROM_UNIXTIME(creditDate) <= '$to' ORDER BY `creditId` DESC");
			}
			elseif ($from != '' && $to == '') {
	        	$selectcredits = $db->query("SELECT * FROM `credits` INNER JOIN `system_users` ON `credits`.`givenBy`=`system_users`.`userId` WHERE `crNonPaidAmount` > 0 AND FROM_UNIXTIME(creditDate) >= '$from' ORDER BY `creditId` DESC");
			}
			else {
	        	$selectcredits = $db->query("SELECT * FROM `credits` INNER JOIN `system_users` ON `credits`.`givenBy`=`system_users`.`userId` WHERE `crNonPaidAmount` > 0 ORDER BY `creditId` DESC");
			}
			?>
				<div class="table-responsive">
	                <table id="data-table" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
								<th>#</th>
								<th>Itariki</th>
								<th>Inguzanyo</th>
								<th>Ayishyuye</th>
								<th>Atishyuye</th>
								<th>Uburyo</th>
								<th>Uwabikoze</th>
								<th>Ishyura</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        	$n=1;
                        	$totalcreditamount = 0;
                        	while ($credit = mysqli_fetch_array($selectcredits)) {
                        		$totalcreditamount = $totalcreditamount + $credit['crNonPaidAmount'];
                        		?>
                        		<tr>
                        			<td><?php echo $n++; ?></td>
                        			<td><?php echo date("d M Y",$credit['creditDate']); ?></td>
                        			<td><?php echo number_format($credit['creditAmount']); ?></td>
                        			<td><?php echo number_format($credit['crPaidAmount']); ?> Rwf</td>
                        			<td><?php echo number_format($credit['crNonPaidAmount']); ?> Rwf</td>
                        			<td><?php echo $credit['crPaymentMethod']; ?></td>
                        			<td><?php echo $credit['userNames']; ?></td>
                        			<td>
										<a href="credits/pay/<?php echo $credit['creditId'] ?>" class="btn btn-success btn-sm btn-curve w-100">
		                                    <i class="fa fa-money text-white"></i> Pay
		                                </a>
					                </td>
                        		</tr>
                        		<?php
                        	}
                        	if (mysqli_num_rows($selectcredits)==0) {
                        		?>
                        		<tr>
                        			<td colspan="10">
                        				<center>Ntanguzanyo kuva <?php echo $from ?> kugeza <?php echo $to; ?></center>
                        			</td>
                        		</tr>
                        		<?php
                        	}
                        ?>
                    	</tbody>
	                </table>
                    <div class="small-modal">
                    	<div class="btn btn-curve bg-red text-white form-control">Igiteranyo cy'inguzanyo itarishyurwa : <?php echo number_format($totalcreditamount); ?> Rwf</div>
                    </div>
	            </div>
			<?php
		}

		// GET OTHER MIXTURE ITEMS
		if($_POST['action'] == 'getothermixitems'){
			$productsarray = $_POST['productsarray'];
			$getallproducts = $db->query("SELECT * FROM `products` WHERE (SELECT SUM(inTrQty) AS inTrQty FROM `intransactions` WHERE `inTrProductId` = `products`.`productId`)>0 AND `productId` NOT IN ('" . implode( "', '" , $productsarray ) . "') ORDER BY `productName` ASC");
			if (mysqli_num_rows($getallproducts) == 0) {
				echo "No More";
			}
			else {
				?>
	      			<div class="row mixitem" id="mixitem<?php echo ($_POST['totalitems']+1) ?>">
						<div class="col-xxs-8 col-xs-8 col-sm-8 col-md-8">
							<div class="form-group"> 
							    <select class="default-select2 form-control selectableitem" name="mixproduct<?php echo ($_POST['totalitems']+1) ?>" id="mixproduct<?php echo ($_POST['totalitems']+1) ?>">
	                                <optgroup label="Hitamo igicuruzwa">
	                                	<option value="">HITAMO</option>
										<?php
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
								<input type="number" class="selectableitem form-control" name="mixqty<?php echo ($_POST['totalitems']+1) ?>" id="mixqty<?php echo ($_POST['totalitems']+1) ?>">
							</div>
						</div>
					</div>
				<?php
			}
		}

		// MAKE A MIXTURE OF ITEMS
		if($_POST['action'] == 'mix'){
			$mixture = $_POST['mixture'];
			$mixturePrice = $_POST['mixprice'];
			$conditions = array(); //
			$mixturenamearray = array();
			$mixtureIdsarray = array();
			// $totalmixturePrice = 0;
			$totalqty = 0;
			$mixtureUnit = '';
			foreach($mixture as $key => $value){
				sleep(1);
				$productId = $value['productId'];
				$getproduct =  $db->query("SELECT * FROM `products` WHERE `productId` = '$productId'");
				$pro = mysqli_fetch_array($getproduct);
				$productPrice = $pro['productPrice'];
				// $totalmixturePrice += $productPrice * $value['Qty']; 
				$totalqty += $value['Qty'];
			    $conditions[] = "productMixed LIKE '%$productId%'";
			    $mixtureIdsarray[] = $pro['productId'];
			    $mixturenamearray[] = $pro['productName'];
				$mixtureUnit = $pro['productUnit'];
				$qty = $value['Qty'];
				$getAllInTrans = $db ->query("SELECT SUM(inTrQty) AS inTrQty FROM `intransactions` WHERE `inTrProductId` = '$productId'");
				$gainedtrans = mysqli_fetch_array($getAllInTrans);
				$maxqty = $gainedtrans['inTrQty'];
				if ($maxqty < $qty) {
					echo 'Ingano ntarengwa yarengejwe. reba neza ibyurikuvanga utabifite muri sitoke.';	
					exit();				
				}
			}
			$mixtureId = time();
			$mixtureName = addslashes('Imvange ('.implode(", ", $mixturenamearray).')');
			// $mixturePrice = $totalmixturePrice / $totalqty;
			$mixtureIds = serialize($mixtureIdsarray);
			$createdDate = time();
			$query =  $db->query("SELECT * FROM `products` WHERE " . implode( " AND " , $conditions ) . "");

			if (mysqli_num_rows($query) > 0) {
				$mix = mysqli_fetch_array($query);
				$mixtureId = $mix['productId'];
				$makemixture = $db ->query("UPDATE `products` SET `productPrice`='$mixturePrice' WHERE `productId` = '$mixtureId'");
				// echo $mixtureName." Exist<br>";
			}
			else {
				$makemixture = $db ->query("INSERT INTO `products`(`productId`, `productName`, `productPrice`, `productUnit`, `productType`, `productMixed`, `createdBy`, `createdDate`, `deletedDate`, `deletedBy`) VALUES ('$mixtureId','$mixtureName','$mixturePrice','$mixtureUnit','Mixture','$mixtureIds','$loggedUser[userId]','$createdDate',NULL,NULL)");
				// echo $mixtureName." not Exist<br>";
			}
			if ($makemixture) {
				foreach($mixture as $key => $value){
					sleep(1);
					$productId = $value['productId'];
					$getproduct =  $db->query("SELECT * FROM `products` WHERE `productId` = '$productId'");
					$pro = mysqli_fetch_array($getproduct);

					$transId = time();
					$doneOn = time();

					$unityPrice = 0;
					$qty = $value['Qty'];
					$operation = 'Out';
					$nonPayedAmount = 0;
					
					// USE FIFO METHOD IN intransaction TABLE
					$selectFi = $db ->query("SELECT * FROM `intransactions` WHERE `inTrProductId` = '$productId' AND `inTrQty` > 0 LIMIT 1");
					$thisItem = mysqli_fetch_array($selectFi);
					$itemQty = $thisItem['inTrQty'];
					$trID = $thisItem['inTrId'];
					$itemPurchasePrice = $thisItem['InTrUnityprice'];
					if ($itemQty >= $qty) {
						$itemQty = $itemQty - $qty;
						$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Mixout','$itemPurchasePrice','$unityPrice','$qty',0,0,'Imvange','Full Paid','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
						if ($insertIntoTr) {
							$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = '$itemQty' WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
						}
					}
					else {
						$sellPaidPrice = 0;
						$payedAmount = 0;
						$nonPayedAmount = 0;
						$paymentStatus = 'Full Paid';
						$sellPaidPrice = 0;

						$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Mixout','$itemPurchasePrice','$unityPrice','$itemQty','$payedAmount','$nonPayedAmount','Imvange','$paymentStatus','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
						if ($insertIntoTr) {
							$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = 0 WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
						}
						$qty = $qty - $itemQty;
						while ($qty > 0) {
							$selectFi = $db ->query("SELECT * FROM `intransactions` WHERE `inTrProductId` = '$productId' AND `inTrQty` > 0 LIMIT 1");
							$thisItem = mysqli_fetch_array($selectFi);
							$itemQty = $thisItem['inTrQty'];
							$trID = $thisItem['inTrId'];
							$itemPurchasePrice = $thisItem['InTrUnityprice'];
							sleep(1);
							$transId = time();
							$sellPaidPrice = 0;
							$payedAmount = 0;
							$nonPayedAmount = 0;
							$paymentStatus = 'Full Paid';
							$sellPaidPrice = 0;
							if ($itemQty >= $qty) {
								$itemQty = $itemQty - $qty;
								$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Mixout','$itemPurchasePrice','$unityPrice','$qty','$payedAmount','$nonPayedAmount','Imvange','$paymentStatus','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
								if ($insertIntoTr) {
									$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = '$itemQty' WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
									$qty = 0;	
								}
								
							}
							else {
								$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Mixout','$itemPurchasePrice','$unityPrice','$itemQty','$payedAmount','$nonPayedAmount','Imvange','$paymentStatus','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
								if ($insertIntoTr) {
									$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = 0 WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
									$qty = $qty - $itemQty;	
								}		
							}
						}
					}
				}
				$ID = time();
				$doneOn = time();
				$nonPayedAmount = 0;
				$insertIntoIn = $db->query("INSERT INTO `intransactions`(`inTrId`, `InTrUnityprice`, `inTrQty`, `inPurchasedQty`, `inTrProductId`, `inTrDoneOn`) VALUES ('$ID',0,'$totalqty','$totalqty','$mixtureId','$doneOn')")or die(mysqli_error());
				sleep(1);
				$ID = time();
				$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `doneDate`, `doneBy`) VALUES ('$ID',NULL,'$mixtureId','Mixin',0,0,'$totalqty',0,'$nonPayedAmount','Imvange','Full Paid','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
				echo "Saved";
			}
			else {
				echo "DB Error. try again or contact developers if it continue like that";
			}
		}

		// MAKE A MIXTURE OF ITEMS
		if($_POST['action'] == 'adjust'){
			$transId = time();
			$doneOn = time();
			$productId = $_POST['productId'];
			$lostqty = $_POST['lostqty'];
			$comment = addslashes(nl2br($_POST['comment']));

			$getprototalqty = $db ->query("SELECT SUM(inTrQty) AS inTrQty FROM `intransactions` WHERE `inTrProductId` = '$productId'");
			$pro = mysqli_fetch_array($getprototalqty);
			$maxqty = $pro['inTrQty'];
			if ($maxqty < $lostqty) {
				echo "Ingano yibyapfubusa iraruta ibyo waranguye. Reba neza";
				exit();
			}
			else {
				// USE FIFO METHOD IN intransaction TABLE
				$selectFi = $db ->query("SELECT * FROM `intransactions` WHERE `inTrProductId` = '$productId' AND `inTrQty` > 0 LIMIT 1");
				$thisItem = mysqli_fetch_array($selectFi);
				$itemQty = $thisItem['inTrQty'];
				$trID = $thisItem['inTrId'];
				$itemPurchasePrice = $thisItem['InTrUnityprice'];
				if ($itemQty >= $lostqty) {
					$itemQty = $itemQty - $lostqty;
					$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `trComment`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Wasted','$itemPurchasePrice',0,'$lostqty',0,0,'Impfabusa','Full Paid','$comment','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
					if ($insertIntoTr) {
						$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = '$itemQty' WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
						echo "Saved";
					}
					else {
						echo "Ikibazo cya database. Ongera ugerageze.";
					}
				}
				else {
					$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `trComment`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Wasted','$itemPurchasePrice',0,'$itemQty',0,0,'Impfabusa','Full Paid','$comment','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
					if ($insertIntoTr) {
						$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = 0 WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
					}
					$lostqty = $lostqty - $itemQty;
					while ($lostqty > 0) {
						$selectFi = $db ->query("SELECT * FROM `intransactions` WHERE `inTrProductId` = '$productId' AND `inTrQty` > 0 LIMIT 1");
						$thisItem = mysqli_fetch_array($selectFi);
						$itemQty = $thisItem['inTrQty'];
						$trID = $thisItem['inTrId'];
						$itemPurchasePrice = $thisItem['InTrUnityprice'];
						sleep(1);
						$transId = time();
						if ($itemQty >= $lostqty) {
							$itemQty = $itemQty - $lostqty;
							$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `trComment`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Wasted','$itemPurchasePrice',0,'$lostqty',0,0,'Impfabusa','Full Paid','$comment','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
							if ($insertIntoTr) {
								$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = '$itemQty' WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
								$lostqty = 0;	
							}
							
						}
						else {
							$insertIntoTr = $db->query("INSERT INTO `transactions`(`trId`, `clientorsupplierId`, `trProductId`, `trOperation`, `trPurchasePrice`, `trUnityPrice`, `trQty`, `trPayedAmount`, `trNonPaidAmount`, `trPaymentMethod`, `trPaymentStatus`, `trComment`, `doneDate`, `doneBy`) VALUES ('$transId',NULL,'$productId','Wasted','$itemPurchasePrice',0,'$itemQty',0,0,'Impfabusa','Full Paid','$comment','$doneOn','$loggedUser[userId]')")or die(mysqli_error());
							if ($insertIntoTr) {
								$updateintransaction = $db ->query("UPDATE intransactions SET inTrQty = 0 WHERE inTrProductId = '$productId' AND inTrId = '$trID'");
								$lostqty = $lostqty - $itemQty;	
							}		
						}
					}
					if ($insertIntoTr) {
						echo "Saved";
					}
					else {
						echo "Ikibazo cya database. Ongera ugerageze.";
					}
				}
			}
		}
	}
?>