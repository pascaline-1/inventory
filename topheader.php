<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle pull-left" data-click="sidebar-toggled">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="./" class="navbar-brand"><img src="assets/img/favicon_1.ico" style="width: 30px;display: inline; margin-bottom: 5px;"> <span class="hidden-xxs">Shop</span></a>
		</div>
		<!-- end mobile sidebar expand / collapse button -->
		
		<!-- begin header navigation right -->
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown navbar-user">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
					<img src="assets/img/user-13.jpg" alt="" /> 
					<span class="hidden-xs"><?php echo $loggedUser['userNames'] ?></span> <b class="caret"></b>
				</a>
				<ul class="dropdown-menu animated fadeInLeft">
					<li class="arrow"></li>
					<li><a href="javascript:;">Edit Profile</a></li>
					<li><a href="javascript:;">Setting</a></li>
					<li class="divider"></li>
					<li><a href="./destroy-user-auth">Log Out</a></li>
				</ul>
			</li>
			<li class="divider hidden-xs"></li>
		</ul>
		<!-- end header navigation right -->
	</div>
	<!-- end container-fluid -->
</div>
<!-- end #header -->
