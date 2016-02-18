<div class="">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				
				<div class="x_title">
					<h2>Edit Document<small></small></h2>
					<div class="clearfix"></div>
				</div>
			
				<div class="x_content">
					<?= $this->element('adminElements/validations'); ?>
					<!--Form edit user -->
						<?php echo $this->Form->create(null, [
							'url' => ['controller' => 'users', 'action' => 'edit-doc', $main_arr['user_id'], $main_arr['doc_id'] ],
							'class'=>'form-horizontal form-label-left input_mask',
							'id'=>'editdoc',
							'style'=>'margin-top: 10px !important;float: left;',
							'enctype'=>'multipart/form-data',
							'novalidate'=>'novalidate'
						]);?>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							
							<?php 
							 echo $this->Form->input('UserFundingMaterials.document_name',[
									'label' => false,
									'class'=>'form-control has-feedback-left',
									'placeholder'=>'Document Name',
									'value'=>$main_arr['doc_info']->document_name != '' ? $main_arr['doc_info']->document_name :'']);
							 ?>
							<span aria-hidden="true" class="fa fa-user form-control-feedback left"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<?php 
							echo $this->Form->file('doc',[
									'label' => false,
									'class'=>'form-control has-feedback-left']);
							 ?>
							<span aria-hidden="true" class="fa fa-file-word-o form-control-feedback left"></span>
						</div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
						<h2>
						<?php if($main_arr['doc_info']->document_path){ ?>
						
							<a title="Download Document" href="<?php echo HTTP_ROOT.'files/doc/'.$main_arr['doc_info']->document_path; ?>" target="_blank" ><i class="fa fa-download"></i> Download Document</a>
							
						<?php }else{ "<h5> Document not Uploaded. </h5>"; }	?>
						<h2>	
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
