<div class="">
   <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Add User<small></small></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<?= $this->element('adminElements/validations'); ?>
			
					<?php echo $this->Form->create('Users', [
						'url' => ['controller' => 'users', 'action' => 'add-new-user'],
						'context' => [
						'validator' => [
							'Users' => 'register',
							'Comments' => 'default'
						  ]
						],
						'class'=>'form-horizontal form-label-left input_mask',
						'style'=>'margin-top: 10px !important;float: left;',
						'id'=>'adduser',
						'enctype'=>'multipart/form-data',
						'novalidate'=>'novalidate'
						
					]);?>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							
						<?php 
						 $userId = base64_encode(convert_uuencode($userInfo->id));
						echo $this->Form->input('userId',[
								'type'=>'hidden',
								'value'=>$userId]);?>
						<?php 
						 echo $this->Form->input('Users.name',[
								'label' => false,
								'class'=>'form-control has-feedback-left',
								'placeholder'=>'Full Name',
								'value'=>$userInfo->name != '' ?$userInfo->name:'']);
						 ?>
						<span aria-hidden="true" class="fa fa-user form-control-feedback left"></span>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<?php 
						echo $this->Form->input('Users.email',[
								'label' => false,
								'class'=>'form-control',
								'placeholder'=>'email',
								'value'=>$userInfo->email != '' ?$userInfo->email:'']);
						 ?>
						<span aria-hidden="true" class="fa fa-envelope form-control-feedback right"></span>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							
							<?php 
							echo $this->Form->input('Users.phone',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'Phone',
									'value'=>$userInfo->phone != '' ?$userInfo->phone:'']);
							 ?>
							<span aria-hidden="true" class="fa fa-phone form-control-feedback left"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->input('Users.country',[
									'label' => false,
									'class'=>'form-control',
									'placeholder'=>'Country',
									'value'=>$userInfo->country != '' ?$userInfo->country:'']);
							 ?>
							<span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->input('Users.city',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'City',
									'value'=>$userInfo->city != '' ?$userInfo->city:'']);
							 ?>
							<span aria-hidden="true" class="fa fa-globe form-control-feedback left"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->input('Users.state',[
									'label' => false,
									'class'=>'form-control',
									'placeholder'=>'State',
									'value'=>$userInfo->state != '' ?$userInfo->state:'']);
							 ?>
							<span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span>
						</div>
						
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->input('Users.address',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'Address',
									'value'=>$userInfo->address != '' ?$userInfo->address:'']);
							 ?>
							<span aria-hidden="true" class="fa fa-globe form-control-feedback left"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->input('Users.zip',[
									'label' => false,
									'class'=>'form-control',
									'placeholder'=>'Zip',
									'value'=>$userInfo->zip != '' ?$userInfo->zip:'']);
							 ?>
							<span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->file('image',[
									'label' => false,
									'class'=>'form-control has-feedback-left']);
							 ?>
							<span aria-hidden="true" class="fa fa-picture-o form-control-feedback left"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->input('Users.org_password',[
									'label' => false,
									'class'=>'form-control',
									'placeholder'=>'Password',
									'value'=>$userInfo->zip != '' ?$userInfo->zip:'']);
							 ?>
							<span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span>
						</div>
						
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<?php 
								echo $this->Form->textarea('Users.user_detail.company_summary',['rows' => '8', 'cols' => '15',
								'label' => false,
								'placeholder'=>'Company Summary',
								'class'=>'form-control ']);
							?>
							
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<?php 
								echo $this->Form->input('Users.user_detail.company_video',[
								'label' => false,
								'placeholder'=>'Company video',
								'class'=>'form-control ',
								'type'=>'url']);
								echo $this->Form->hidden('Users.user_executive_summary.business_model',['value'=>' ']);
							?>
							
						</div>
						
						
						<div class="x_title">
							<h2>Investment Details<small></small></h2>
							<div class="clearfix"></div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<?php 
								echo $this->Form->input('Users.user_detail.i_goal',[
								'label' => false,
								'placeholder'=>'Investment Goal',
								'class'=>'form-control ',
								'type'=>'url']);
							?>
							
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<?php 
								echo $this->Form->input('Users.user_detail.i_type',[
								'label' => false,
								'placeholder'=>'Investment Type',
								'class'=>'form-control ',
								'type'=>'url']);
							?>
							
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<?php 
								echo $this->Form->input('Users.user_detail.i_pre_money',[
								'label' => false,
								'placeholder'=>'Pre Money Valuation',
								'class'=>'form-control ',
								'type'=>'url']);
							?>
							
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<?php 
								echo $this->Form->input('Users.user_detail.i_post_money',[
								'label' => false,
								'placeholder'=>'Post Money Valuation',
								'class'=>'form-control ',
								'type'=>'url']);
							?>
							
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
							<?php 
								echo $this->Form->input('Users.user_detail.i_expected_returns',[
								'label' => false,
								'placeholder'=>'Expected Returns',
								'class'=>'form-control ',
								'type'=>'url']);
							?>
							
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<button type="button"  class="btn btn-primary" onclick="window.history.go(-1);"  >Cancel</button>
							<button id="send" type="submit" class="btn btn-success">Submit</button>
						</div>
					<?php echo $this->form->end(); ?>
					<!-- end form -->
				</div>
			</div>
		</div>
	</div>
</div>
				
<script>

$(document).ready(function(){
	// initialize the validator function
	validator.message['date'] = 'not a real date';

	// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
	$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);

	$('.multi.required')
		.on('keyup blur', 'input', function () {
			validator.checkField.apply($(this).siblings().last()[0]);
		});

	// bind the validation to the form submit event
	//$('#send').click('submit');//.prop('disabled', true);

	$('#adduser').submit(function (e) {
	
		e.preventDefault();
		var submit = true;
		// evaluate the form using generic validaing
		if (!validator.checkAll($(this))) {
			submit = false;
		}
		if (submit)
			this.submit();
		return false;
	});

	/* FOR DEMO ONLY */
	$('#vfields').change(function () {
		$('form').toggleClass('mode2');
	}).prop('checked', false);

	$('#alerts').change(function () {
		validator.defaults.alerts = (this.checked) ? false : true;
		if (this.checked)
			$('form .alert').remove();
	}).prop('checked', false);
	
	/*$("#send").click(function(){
	   //$("#profileform").submit();  
	});*/
});
</script>
