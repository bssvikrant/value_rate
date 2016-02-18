<!--[Inner Content Area Start]-->
	<section class="inner-cont">
		<section class="login-wrap">
			<div class="container">
				<!--login area-->
				<div class="login-area sign-up">
					<h1>Welcome to Valuerate</h1>
					<div class="form-area">
						<div class="form-box form-box-2 form-group">
							<?php 
								echo $this->Form->create(null, [
								'url' => ['controller' => 'Home', 'action' => 'login'],
								'id'=>'formsubmit',"data-toggle"=>"validator"
								]);
								 if(isset($error) && $error!=""){ 
							?>
								<div>
									<p class="admin_error"><?php echo $error; ?></p>
								</div>
							<?php } ?>
							
							<?php
								echo $this->Form->input('email', ['label' => false,'placeholder'=>'Email','class'=>'form-control','required'=>true]);
								echo $this->Form->password('password', ['label' => false, 'placeholder'=>'Password', 'class'=>'form-control', 'required'=>true, 'data-minlength'=>"5", "data-error"=>"Minimum of 5 characters"]);
								
							?>
							<div class="help-block with-errors"></div>
							<div class="row">
								<div class="col-md-6 col-md-6 col-sm-6 col-xs-6">
								
									<button type="submit" class="btn btn-default" id="submit">Login</button>
								</div>
								<div class="col-md-6 col-md-6 col-sm-6 col-xs-6">
									<div class="checkbox">
										<label>
											<a class="reset_pass" title="Forgot Password ?" href="<?php echo HTTP_ROOT."Home/forgot-password"; ?>" style ="color:white";>Lost your password ?</a>
									</div>
								</div>
							</div>
							<?php echo $this->Form->end();?>
						</div>
					</div>
				</div>
				<!--/login area-->
			</div>
		</section>
	</section>
<!--[Inner Content Area End]-->
<script>

$(document).ready(function(){
//$('#formsubmit').validator();
	$("input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$("#formsubmit").submit();
		}
	});
	$("#submit").click(function(){
	    $( "#formsubmit" ).submit();
	});
});

</script>
<style>
.login_content h1::before, .login_content h1::after {
    width: 15%;
}
.admin_error{color:#C12529}
#register, #login {
    background: #f7f7f7 none repeat scroll 0 0;
    border-radius: 5px;
    padding: 10px;
    position: absolute;
    top: 0;
	opacity: 0.90;
}
body {
    color: #73879C;
	background: #f7f7f7 none repeat scroll 0 0;
}
</style>