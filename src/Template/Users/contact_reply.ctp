<?php echo $this->element('adminElements/main_editor');
   
?>
  
<div class="">
                   
                    <div class="clearfix"></div>

                    <div class="row">
					<?php @$errrVal = $this->request->session()->read("error"); 
					if($errrVal !=""){ ?>
						        <div class="alert alert-danger alert-dismissible fade in" role="alert">
											 <button class="close" aria-label="Close" data-dismiss="alert" type="button">
											 <strong>ERROR!</strong>
										<?php echo  @$this->request->session()->read("error");
										 @$this->request->session()->write("error","");
										?>
								</div>
					<?php }
					?>
					<?php @$successVal = $this->request->session()->read("success"); 
					if($successVal !=""){ ?>
						        <div class="alert alert-success alert-dismissible fade in" role="alert">
											 <button class="close" aria-label="Close" data-dismiss="alert" type="button">
											 <strong>Success!</strong>
										<?php echo  @$this->request->session()->read("success");
										 @$this->request->session()->write("success","");
										?>
								</div>
								
					<?php }
					?>
					
                         <div class="col-md-12 col-sm-12 col-xs-12">
						    <div class="x_panel">
                                <div class="x_title">
                                    <h2>Contact Request Reply</h2>
									<div class="clearfix"></div>
							 </div>
								<div class="x_content">
                                  <!--site settings form-->
								    <?php echo $this->Form->create(null, [
										'url' => ['controller' => 'users', 'action' => 'contact-reply'],
										'class'=>'form-horizontal form-label-left',
										'id'=>'contactReply',
										'enctype'=>'multipart/form-data',
										'novalidate'=>'novalidate'
										
									]);?>
									<?php 
									echo $this->Form->input('ContactRequests.id',[
												'type' => 'hidden',
												'value'=>$contactRequest->id]);
									?>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Email <span class="required">*</span>
										</label>
										<?php 
										//echo "<pre>"; print_r($admininfo);
										 echo $this->Form->input('ContactRequests.email',[
												'templates' => ['inputContainer' => '<div class="col-md-6 col-sm-6 col-xs-12">{{content}}</div>'],
												'label' => false,
												'class'=>'form-control col-md-7 col-xs-12',
												'value'=>$contactRequest->email != ''?$contactRequest->email:'']);
										 ?>
									</div>
									
									
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="reply">Description<span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											 <?php echo $this->Form->textarea('ContactRequests.reply',
											 ['escape' => false,
											 'value'=>$contactReplyContent->description != ''?$contactReplyContent->description:'',
											 'class'=>'form-control col-md-7 col-xs-12 tinymce', 'id'=>'elm1']);?>
										</div>
									</div>
									<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-6 col-md-offset-3">
											<button type="button"  class="btn btn-primary" onclick="window.history.go(-1);"  >Cancel</button>
											<button id="send" type="submit" class="btn btn-success">Submit</button>
										</div>
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

				$('#contactReply').submit(function (e) {
				
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
