<!-- begin #sidebar -->
<div id="sidebar" class="sidebar sidebar-transparent">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<div class="image">
					<a href="javascript:;"><img src="assets/img/user-13.jpg" alt="" /></a>
				</div>
				<div class="info">
					<?php echo $loggedUser['userNames'] ?>
					<small><?php echo $loggedUser['userType'] ?></small>
				</div>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<?php  
			if ($loggedUser['userType'] == 'Admin') {
				?>
					<ul class="nav">
				        <!-- begin sidebar minify button -->
						<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				        <!-- end sidebar minify button -->
						<li class="
							<?php if ($url[0] == '' || $url[0] == 'home'): ?>
								active
							<?php endif ?>
						">
							<a href="./">
							    <i class="fa fa-laptop"></i>
							    <span>Ahabanza</span>
						    </a>
						</li>
						<li class="
							<?php if ($url[0] == 'stock'): ?>
								active
							<?php endif ?>
						">
							<a href="stock">
							    <i class="fa fa-database"></i>
							    <span>Sitoke</span>
						    </a>
						</li>
						<li class="has-sub
							<?php if ($url[0] == 'loan'): ?>
								active
							<?php endif ?>
						">
							<a href="javascript:;">
							    <b class="caret pull-right"></b>
							    <i class="fa fa-money"></i>
							    <span>Amadene</span>
						    </a>
							<ul class="sub-menu">
								<li class="
									<?php if ($url[0] == 'loan' && $url[1] == 'shop' || ($url[0] == 'loan' && $url[1] != 'clients')): ?>
										active
									<?php endif ?>
								">
									<a href="loan/shop">Ayiduka</a>
								</li>
								<li class="
									<?php if ($url[0] == 'loan' && $url[1] == 'clients' || ($url[0] == 'loan' && $url[1] != 'shop')): ?>
										active
									<?php endif ?>
								">
									<a href="loan/clients">Ayabakiriya</a>
								</li>
							</ul>
						</li>
						<li class="
							<?php if ($url[0] == 'suppliers'): ?>
								active
							<?php endif ?>
						">
							<a href="suppliers">
							    <i class="fa fa-users"></i>
							    <span>Abaranguza</span>
						    </a>
						</li>
						<li class="
							<?php if ($url[0] == 'clients'): ?>
								active
							<?php endif ?>
						">
							<a href="clients">
							    <i class="fa fa-money"></i>
							    <span>Abakiriya</span>
						    </a>
						</li>
						<li class="
							<?php if ($url[0] == 'users'): ?>
								active
							<?php endif ?>
						">
							<a href="users">
							    <i class="fa fa-gears"></i>
							    <span>Abakozi</span>
						    </a>
						</li>
						<li class="has-sub
							<?php if ($url[0] == 'purchase' || $url[0] == 'sales' || $url[0] == 'wasted'): ?>
								active
							<?php endif ?>
						">
							<a href="javascript:;">
							    <b class="caret pull-right"></b>
							    <i class="fa fa-list"></i>
							    <span>Raporo</span>
						    </a>
							<ul class="sub-menu">
								<li class="
									<?php if ($url[0] == 'purchase'): ?>
										active
									<?php endif ?>
								">
									<a href="purchase">Kurangura</a>
								</li>
								<li class="
									<?php if ($url[0] == 'sales'): ?>
										active
									<?php endif ?>
								">
									<a href="sales">Gucuruza</a>
								</li>
								<li class="
									<?php if ($url[0] == 'wasted'): ?>
										active
									<?php endif ?>
								">
									<a href="wasted">Impfabusa</a>
								</li>
							</ul>
						</li>
						<!-- <li class="
							<?php if ($url[0] == 'reports'): ?>
								active
							<?php endif ?>
						">
							<a href="reports">
							    <i class="fa fa-flash"></i>
							    <span>Ibyihuta Cyane</span>
						    </a>
						</li>
						<li class="
							<?php if ($url[0] == 'reports'): ?>
								active
							<?php endif ?>
						">
							<a href="reports">
							    <i class="fa fa-long-arrow-up"></i>
							    <span>Ibyunguka cyane</span>
						    </a>
						</li> -->
					</ul>
				<?php
			}
			else {
				?>
					<ul class="nav">
				        <!-- begin sidebar minify button -->
						<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
				        <!-- end sidebar minify button -->
						<li class="
							<?php if ($url[0] == '' || $url[0] == 'home'): ?>
								active
							<?php endif ?>
						">
							<a href="./">
							    <i class="fa fa-laptop"></i>
							    <span>Ahabanza</span>
						    </a>
						</li>
						<li class="
							<?php if ($url[0] == 'stock'): ?>
								active
							<?php endif ?>
						">
							<a href="stock">
							    <i class="fa fa-database"></i>
							    <span>Sitoke</span>
						    </a>
						</li>
						<li class="has-sub
							<?php if ($url[0] == 'loan'): ?>
								active
							<?php endif ?>
						">
							<a href="javascript:;">
							    <b class="caret pull-right"></b>
							    <i class="fa fa-money"></i>
							    <span>Amadene</span>
						    </a>
							<ul class="sub-menu">
								<li class="
									<?php if ($url[0] == 'loan' && $url[1] == 'shop' || ($url[0] == 'loan' && $url[1] != 'clients')): ?>
										active
									<?php endif ?>
								">
									<a href="loan/shop">Ayiduka</a>
								</li>
								<li class="
									<?php if ($url[0] == 'loan' && $url[1] == 'clients' || ($url[0] == 'loan' && $url[1] != 'shop')): ?>
										active
									<?php endif ?>
								">
									<a href="loan/clients">Ayabakiriya</a>
								</li>
							</ul>
						</li>
						<li class="
							<?php if ($url[0] == 'suppliers'): ?>
								active
							<?php endif ?>
						">
							<a href="suppliers">
							    <i class="fa fa-users"></i>
							    <span>Abaranguza</span>
						    </a>
						</li>
						<li class="
							<?php if ($url[0] == 'clients'): ?>
								active
							<?php endif ?>
						">
							<a href="clients">
							    <i class="fa fa-money"></i>
							    <span>Abakiriya</span>
						    </a>
						</li>
					</ul>
				<?php				
			}
		?>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->