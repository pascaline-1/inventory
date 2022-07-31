<?php  
	$url = explode('/', $_SERVER['QUERY_STRING']);
	if ($url[0] == '') {
		$page = 'home.php';
	}
	else {	
		$page = './'.$url[0].'.php';
	}
	if (is_file($page)) {
		require_once($page);
	}
	else {
		require_once('404.php');
	}
?>