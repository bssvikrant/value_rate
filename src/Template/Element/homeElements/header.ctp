
<!--[header]-->
<header class="head-wrap">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="logo-area">
					<a href="#" title="Value Rate"><img src="<?php echo HTTP_ROOT ?>img/Home/logo_main.png" alt="Value Rate" class="img-responsive" />
					</a>
				</div>

			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="nav-area">
					<nav class="navbar navbar-inverse">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="myNavbar">
							<ul class="nav navbar-nav">
								<li><a href="#">Startup</a>
								</li>
								<li> <a href="#">Investor</a>
								</li>
								<li><a href="#">Blog</a>
								</li>
								<li><a href="#">Contact Us</a>
								</li>
							</ul>


						</div>
					</nav>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<!--Serach Login-->
				<div class="search-login">
					<div class="search-box form-group">
						<a href="#"> <span class="glyphicon glyphicon-search"></span> </a>
						<input type="text" class="form-control" />
					</div>
					<div class="login-box">
						<ul class="login-list">
							<li>
								<?php
									$session = $this->request->session();
									$userSesData = 	$session->read('User');
									if(count($userSesData)){
									
										echo '<span style="color:white" >'.$userSesData['name'].', </span> ';
										echo $this->Html->link(
										'<i class="fa fa-sign-out"></i> Log Out',
										['controller' => 'Home', 'action' => 'logout', '_full' => true],
										['escape' => false]
										);
									}else{
									
										echo $this->Html->link(
										'<i class="fa fa-sign-in"></i> Log In',
										['controller' => 'Home', 'action' => 'login', '_full' => true],
										['escape' => false]
										);
									}
								?>
							</li>
							
						</ul>
					</div>

				</div>
				<!--/Serach Login-->
			</div>


		</div>


	</div>
</header>
<!--[/header]-->