<?php  
	session_start();
	$url = explode('/', $_SERVER['QUERY_STRING']);
	include 'db.php';
	include 'base.php';
	if (!isset($_SESSION['userId'])) {
		?>
			<script type="text/javascript">
				document.location.href='<?php echo $baseurl; ?>auth';
			</script>
		<?php
	}
	else {
		$userId = $_SESSION['userId'];
		$selectuser = $db ->query("SELECT * FROM `system_users` WHERE userId='$userId'");
		$loggedUser = mysqli_fetch_array($selectuser);
		if ($loggedUser['userType'] != 'Admin') {
			?>
				<script type="text/javascript">
					document.location.href='<?php echo $baseurl; ?>auth';
				</script>
			<?php
		}
	}
?>