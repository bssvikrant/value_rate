    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
				<!--Login form -->
				<?php 
					echo $this->Form->create(null, [
						'url' => ['controller' => 'Users', 'action' => 'forgotPassword'],
						'id'=>'formsubmit'
					]);
				?>
				<?php if(isset($error) && $error!=""){ ?>
					<div>
						<p class="admin_error"><?php echo $error; ?></p>
					</div>
				<?php } ?>
				<?php if(isset($success) && $success!=""){ ?>
					<div>
						<p class="admin_success"><?php echo $success; ?></p>
					</div>
				<?php } ?>
				
				<h1>Forgot Password</h1>
				<div>
					
					<?php
						echo $this->Form->input('email', ['label' => false,'placeholder'=>'Enter you email','class'=>'form-control']);
					?>
					
					<div>
						<a class="btn btn-default submit" id="submit">Reset Password</a>
						<a title="Want to login back ?" class="reset_pass" href="<?php echo HTTP_ROOT."Users/login"; ?>">Back to login?</a>
					</div>
                    <div class="clearfix"></div>
                    <div class="separator">
						<div>
                            <h1><i class="fa fa-paw" style="font-size: 26px;"></i> <?php echo SITE_TITLE; ?></h1>
							<p>©<?php echo CURRENT_YEAR; ?> All Rights Reserved. <?php echo SITE_TITLE; ?>. Privacy and Terms</p>
                        </div>
                    </div>
					<?php echo $this->Form->end();?>
                    <!-- form -->
				</div>
			</section>
            <!-- content -->	
        </div>
    </div>
<script>
$(document).ready(function(){
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
.admin_success {
    color: #1ABB9CS;
}
</style>