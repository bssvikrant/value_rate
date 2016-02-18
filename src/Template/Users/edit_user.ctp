<div class="">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
			<li><a data-toggle="tab" href="#exesum">Executive Summary</a></li>
			<li><a data-toggle="tab" href="#fundmat">Funding Materials</a></li>
		</ul>
		
		<div class="tab-content">
		
			<div id="overview" class="tab-pane fade in active">
				<?php include('inc_overview.ctp'); ?>
			</div><!-- @vik Overview tab  -->	
			
			<div id="exesum" class="tab-pane fade">
				<?php include('inc_exe_sum.ctp'); ?>
			</div><!-- @vik Executive Summary tab  -->	
			
			<div id="fundmat" class="tab-pane fade">
				<?php include('inc_fund_mat.ctp'); ?>
			</div><!-- @vik Funding Materials tab  -->	
			
		</div><!-- @vik tab content --> 	
		
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
