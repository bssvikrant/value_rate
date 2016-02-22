<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<style>
.ui-datepicker-calendar {
    display: none;
 }
</style>
<div class="">
   <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Share Investment<small></small></h2>
					<div class="clearfix"></div>
					<?php 
							$session = $this->request->session();
							$errorMsg = $session->read('success');
							if(strlen($errorMsg))
							{

						?>
							<div class="alert alert-danger">
								<?php echo $errorMsg; ?>
							</div>
							<?php

							}
							?>
				</div>
				<div class="x_content">
					<?= $this->element('adminElements/validations'); ?>
			
					<?php echo $this->Form->create('Users', [
						'url' => ['controller' => 'users', 'action' => 'share_investments'],
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
					
				<?php 
				 $userId = base64_encode(convert_uuencode($userInfo->id));
				// echo $userId; die(); 
				echo $this->Form->input('userId',[
						'type'=>'hidden',
						'value'=>$userId]);?>
					
					<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<?php 
						echo $this->Form->input('Users.email',[
								'label' => false,
								'class'=>'form-control',
								'placeholder'=>'Email']);
						 ?>
						<span aria-hidden="true" class="fa fa-envelope form-control-feedback right"></span>
					</div>					
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->input('Users.description',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'description']);
							 ?>
							<span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span>
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
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'MM yy',
			onClose: function(dateText, inst) { 
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				$(this).datepicker('setDate', new Date(year, month, 1));
			},
		yearRange: '1950:2016',
		beforeShow: function(el, dp) {
		$('#ui-datepicker-div').toggleClass('hide-calendar', $(el).is('[data-calendar="false"]'));
		}
		});
	});
</script>		
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
