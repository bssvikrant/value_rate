<div class="">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				
				<div class="x_title">
					<h2>Edit Team Member<small></small></h2>
					<div class="clearfix"></div>
				</div>
			
				<div class="x_content">
					<?= $this->element('adminElements/validations'); ?>
					<!--Form edit user -->
						<?php echo $this->Form->create(null, [
							'url' => ['controller' => 'users', 'action' => 'edit-team-member', $main_arr['user_id'], $main_arr['member_id'] ],
							'class'=>'form-horizontal form-label-left input_mask',
							'id'=>'createmember',
							'style'=>'margin-top: 10px !important;float: left;',
							'enctype'=>'multipart/form-data',
							'novalidate'=>'novalidate'
						]);?>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							
							<?php 
							 echo $this->Form->input('UserMembers.name',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'Full Name',
									'value'=>$main_arr['member_info']->name != '' ? $main_arr['member_info']->name :'']);
							 ?>
							<span aria-hidden="true" class="fa fa-user form-control-feedback left"></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							 echo $this->Form->input('UserMembers.position',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'Position',
									'value'=>$main_arr['member_info']->position != '' ? $main_arr['member_info']->position :'']);
							 ?>
							<span aria-hidden="true" class="fa fa-envelope form-control-feedback right"></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							 echo $this->Form->input('UserMembers.linkedin_url',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'LinkedIn Url',
									'value'=>$main_arr['member_info']->linkedin_url != '' ? $main_arr['member_info']->linkedin_url :'']);
							 ?>
							<span aria-hidden="true" class="fa fa-linkedin form-control-feedback left"></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							 echo $this->Form->input('UserMembers.experience',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'Experience',
									'value'=>$main_arr['member_info']->experience != '' ? $main_arr['member_info']->experience :'']);
							 ?>
							<span aria-hidden="true" class="fa fa-circle-o-notch form-control-feedback right"></span>
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
							<img alt="Image not found" style="margin:5px" height="100px"; width="100px"; src="<?php echo HTTP_ROOT.'img/uploads/'.($main_arr['member_info']->image != ''?$main_arr['member_info']->image:'prof_photo.png'); ?>"/>
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

				$('#edituser').submit(function (e) {
				
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
