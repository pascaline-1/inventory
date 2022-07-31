<?php  
    session_start();
    include 'db.php';
    include 'base.php';
    $url = explode('/', $_SERVER['QUERY_STRING']);
    $message = '';
    if (isset($_POST['login'])) {
        $phonemail = $_POST['phonemail'];
        $password = $_POST['password'];

        $telephone = $_POST['phonemail'];
        if (substr(preg_replace('/[^0-9]/', '', $telephone),0,4)=='2507' && strlen($telephone)==12) {
            $phonemail = $telephone;
        }
        else {
            if (substr(preg_replace('/[^0-9]/', '', $telephone),0,2)=='07' && strlen($telephone)==10) {
                $phonemail = '25'.$telephone;
            }
        }

        // check user with that phone or email or idpassport
        $selectuser = $db ->query("SELECT * FROM `system_users` WHERE (userEmail='$phonemail' OR userPhone='$phonemail') AND userPassword='$password'");
        if (mysqli_num_rows($selectuser)!=0) {
            $loggedUser = mysqli_fetch_array($selectuser);
            if ($loggedUser['active'] == 'No') {
                if ($loggedUser['disabledTime'] != NULL) {
                    $message = 'Your account was disabled, please contact app manager to activate your account';
                }
                else {
                    $message = 'Your account is not confirmed';
                }
            }
            else {
                $_SESSION['userId'] = $loggedUser['userId'];
                if (isset($url[1]) && $url[1]!='') {
                    $redirection_page = $baseurl.'/'.$url[1];
                }
                else{
                    $redirection_page = $baseurl;
                }
                ?>
                    <script type="text/javascript">
                        document.location.href="<?php echo $redirection_page; ?>";
                    </script>
                <?php
            }
        }
        else {
            $message = 'Access Denied! Invalid Email/Phone or Password';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shop | Login</title>
        <?php include 'dashboardhead.php'; ?>
    </head>
    <body class="pace-top">
    	<!-- begin #page-loader -->
    	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
    	<!-- end #page-loader -->
    	
    	<div class="login-cover">
    	    <div class="login-cover-image"><img src="assets/img/login-bg/bg-1.jpg" data-id="login-cover-image" alt="" /></div>
    	    <div class="login-cover-bg"></div>
    	</div>
    	<!-- begin #page-container -->
    	<div id="page-container" class="fade">
    	    <!-- begin login -->
            <div class="login login-v2" data-pageload-addclass="animated fadeIn">
                <!-- begin brand -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> Shop
                        <small>Login</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>
                <!-- end brand -->
                <div class="login-content">
                    <form method="POST" class="margin-bottom-0">
                        <div class="form-group m-b-20">
                            <label>Email or Phone</label>
                            <input type="text" class="form-control input-md inverse-mode no-border" placeholder="Email or Phone" required name="phonemail" />
                        </div>
                        <div class="form-group m-b-20">
                            <label>Password</label>
                            <input type="password" class="form-control input-md inverse-mode no-border" placeholder="Password" required name="password" />
                        </div>
                        <p class="text-danger"><?php echo $message; ?></p>
                        <div class="login-buttons">
                            <button type="submit" name="login" class="btn btn-success btn-block btn-md btn-curve">Login</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end login -->
    	</div>
    	<!-- end page container -->
    	
    	<!-- ================== BEGIN BASE JS ================== -->
    	<?php include 'js.php'; ?>
    	<!-- ================== END BASE JS ================== -->
    	
    	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    	<script src="assets/js/login-v2.demo.min.js"></script>
    	<script src="assets/js/apps.min.js"></script>
    	<!-- ================== END PAGE LEVEL JS ================== -->

    	<script>
    		$(document).ready(function() {
    			App.init();
    			LoginV2.init();
    		});
    	</script>
    </body>
</html>
