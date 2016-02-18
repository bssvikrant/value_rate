
 <!--[header]--> 
    <header class="head-wrap">    	
        <div class="container">        	
            <div class="row">            	
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">                	
                	<div class="logo-area">
                    	<a href="#" title="Value Rate">
							<?= $this->Html->image('Frontend/logo_main.png', ["alt" => "Value Rate", "class" => "img-responsive"]); ?>
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
        <li><a href="#">Startup</a></li>
        <li> <a  href="#">Investor</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact Us</a></li>
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
							
                                <li><a href="<?php echo HTTP_ROOT."users/usersignup"; ?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                                <li><a href="<?php echo HTTP_ROOT."users/userlogin"; ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            </ul>
                        </div>
                       
                   </div>     
                   <!--/Serach Login-->
                </div>
            	
            	
            </div>
        
        
        </div>
    </header>
 <!--[/header]--> 