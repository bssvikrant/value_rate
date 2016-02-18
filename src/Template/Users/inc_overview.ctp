<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<style>
.ui-datepicker-calendar {
    display: none;
 }
</style>
<div class="x_panel">
	
	<div class="x_title">
		<h2>Overview<small></small></h2>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<?= $this->element('adminElements/validations'); ?>
		<!--Form edit user -->
			<?php echo $this->Form->create(null, [
				'url' => ['controller' => 'users', 'action' => 'edit-user'],
				'class'=>'form-horizontal form-label-left input_mask',
				'id'=>'edituser',
				'style'=>'margin-top: 10px !important;float: left;',
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
				echo $this->Form->input('Users.org_password',[
						'label' => false,
						'class'=>'form-control has-feedback-left',
						'placeholder'=>'Password',
						'value'=>$userInfo->org_password != '' ?$userInfo->org_password:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-globe form-control-feedback left"></span>
			</div>
			<!--div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback"-->
				<?php 
				echo $this->Form->hidden('Users.user_detail.id',['value'=>$userInfo->user_detail->id != '' ?$userInfo->user_detail->id:'']);
				 ?>
			<!--/div-->
						<!---->
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.company_name',[
						'label' => false,
						'placeholder'=>'Company Name',
						'class'=>'form-control ',
						'value'=>$userInfo->user_detail->company_name != '' ?$userInfo->user_detail->company_name:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-picture-o form-control-feedback right"></span>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.brief_des',[
						'label' => false,
						'class'=>'form-control  has-feedback-left',
						'placeholder'=>'Brief Description',
						'value'=>$userInfo->user_detail->brief_des != '' ?$userInfo->user_detail->brief_des:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-globe form-control-feedback left"></span>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				
				echo $this->Form->input('Users.user_detail.currency',[
						'label' => false,
						'type'=>'select',
						'options'=>array('USD'=>'USD','UAE'=>'UAE','INR'=>'INR'),
						'placeholder'=>'Currency',
						'class'=>'form-control',
						'value'=>$userInfo->user_detail->currency != '' ?$userInfo->user_detail->currency:'']);
				 ?>
				<!--span aria-hidden="true" class="fa fa-picture-o form-control-feedback right"></span-->
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.industry',[
						'label' => false,
						'class'=>'form-control',
						'placeholder'=>'Industry',
						'type'=>'select',
						'options'=>array('IT Service'=>'IT Service','SEO'=>'SEO','Other'=>'Other'),
						'value'=>$userInfo->user_detail->industry != '' ?$userInfo->user_detail->industry:'']);
				 ?>
				<!--span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span-->
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.date_found',[
						'label' => false,
						'class'=>'form-control  ',
						'id'=>'datepicker',
						'placeholder'=>'Date Found',
						'value'=>$userInfo->user_detail->date_found != '' ?$userInfo->user_detail->date_found:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-globe form-control-feedback right"></span>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.website',[
						'label' => false,
						'placeholder'=>'Website',
						'class'=>'form-control has-feedback-left',
						'value'=>$userInfo->user_detail->website != '' ?$userInfo->user_detail->website:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-picture-o form-control-feedback left"></span>
			</div>
			

			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.facebook_url',[
						'label' => false,
						'placeholder'=>'Facebook Url',
						'class'=>'form-control',
						'value'=>$userInfo->user_detail->facebook_url != '' ?$userInfo->user_detail->facebook_url:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-picture-o form-control-feedback right"></span>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.linkedin_url',[
						'label' => false,
						'class'=>'form-control  has-feedback-left',
						'placeholder'=>'Linkedin Url',
						'value'=>$userInfo->user_detail->linkedin_url != '' ?$userInfo->user_detail->linkedin_url:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-globe form-control-feedback left"></span>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.twitter_url',[
						'label' => false,
						'placeholder'=>'Twitter Url',
						'class'=>'form-control',
						'value'=>$userInfo->user_detail->twitter_url != '' ?$userInfo->user_detail->twitter_url:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-picture-o form-control-feedback right"></span>
			</div>
			
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<?php 
				echo $this->Form->input('Users.user_detail.google_url',[
						'label' => false,
						'class'=>'form-control  has-feedback-left',
						'placeholder'=>'Google Url ',
						'value'=>$userInfo->user_detail->google_url != '' ?$userInfo->user_detail->google_url:'']);
				 ?>
				<span aria-hidden="true" class="fa fa-globe form-control-feedback left"></span>
			</div>
			
			<!---->
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<?php 
					echo $this->Form->textarea('Users.user_detail.company_summary',['rows' => '8', 'cols' => '15',
					'label' => false,
					'placeholder'=>'Company Summary',
					'class'=>'form-control ',
					'value'=>$userInfo->user_detail->company_summary != '' ?$userInfo->user_detail->company_summary:'']);
				?>				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<?php 
					echo $this->Form->input('Users.user_detail.company_video',[
					'label' => false,
					'placeholder'=>'Company video',
					'class'=>'form-control ',
					'type'=>'url',
					'value'=>$userInfo->user_detail->company_video != '' ?$userInfo->user_detail->company_video:'']);
				?>
				
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
				<img alt="Image not found" style="margin:5px" height="100px"; width="100px"; src="<?php echo HTTP_ROOT.'img/uploads/'.($userInfo->image != ''?$userInfo->image:'prof_photo.png'); ?>"/>
				
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
					'type'=>'url',
					'value'=>$userInfo->user_detail->i_goal != '' ?$userInfo->user_detail->i_goal:'']);
				?>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<?php 
					echo $this->Form->input('Users.user_detail.i_type',[
					'label' => false,
					'placeholder'=>'Investment Type',
					'class'=>'form-control ',
					'type'=>'url',
					'value'=>$userInfo->user_detail->i_type != '' ?$userInfo->user_detail->i_type:'']);
				?>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<?php 
					echo $this->Form->input('Users.user_detail.i_pre_money',[
					'label' => false,
					'placeholder'=>'Pre Money Valuation',
					'class'=>'form-control ',
					'type'=>'url',
					'value'=>$userInfo->user_detail->i_pre_money != '' ?$userInfo->user_detail->i_pre_money:'']);
				?>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<?php 
					echo $this->Form->input('Users.user_detail.i_post_money',[
					'label' => false,
					'placeholder'=>'Post Money Valuation',
					'class'=>'form-control ',
					'type'=>'url',
					'value'=>$userInfo->user_detail->i_post_money != '' ?$userInfo->user_detail->i_post_money:'']);
				?>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<?php 
					echo $this->Form->input('Users.user_detail.i_expected_returns',[
					'label' => false,
					'placeholder'=>'Expected Returns',
					'class'=>'form-control ',
					'type'=>'url',
					'value'=>$userInfo->user_detail->i_expected_returns != '' ?$userInfo->user_detail->i_expected_returns:'']);
				?>
				
			</div>			
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback"></div>
			
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<button type="button"  class="btn btn-primary" onclick="window.history.go(-1);"  >Cancel</button>
				<button id="send" type="submit" class="btn btn-success">Submit</button>
			</div>
			<?php echo $this->form->end(); ?>
		<!-- end form -->
	</div>
</div>


<!-- @vik Code for Add/Edit/Del User Team Members Start-->
<div class="x_panel">
	
	<div class="x_title">
		<h2>Management Team<small></small></h2>
		<a href="<?php echo HTTP_ROOT."users/create-team-member/".base64_encode(convert_uuencode($userInfo->id));?>">
			<button class="btn btn-default pull-right" type="button"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span> Add</button>
		</a>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<?php 
		$teamData = $userInfo->user_members;
		if(count($teamData)){
			foreach ($teamData as $team){ 
		?>	
		 <div class="row">
			<div class="col-sm-12">
				<div class="col-sm-2">
					<img alt="Image not found" style="margin:5px" height="100px"; width="100px"; src="<?php echo HTTP_ROOT.'img/uploads/'.($team->image != ''?$team->image:'prof_photo.png'); ?>"/>
				</div>
				<div class="col-sm-10">
					<p>
						<?php echo $team->name.", ".$team->position ; 
						if($team->linkedin_url) { echo '&nbsp;&nbsp;'; ?>
						<a href="<?php echo $team->linkedin_url; ?>" >
							<i class="fa fa-linkedin"></i>
						</a>
						<?php } ?>
						|
						<a title="Delete Team Member" href="<?php echo HTTP_ROOT."users/delete-row/".'UserMembers'.'/'.base64_encode(convert_uuencode($team->id));?>" onclick="if(!confirm('Are you sure to delete this Member ?')){return false;}" ><span class="fa fa-fw fa-trash-o"></span></a>
						<a title="Edit Team Member" href="<?php echo HTTP_ROOT."users/edit-team-member/".base64_encode(convert_uuencode($userInfo->id))."/".$team->id; ?>"><span><i class="fa fa-pencil-square"></i></span></a>
						
					</p>
					<p><?php echo $team->experience; ?></p>
				</div>
			</div>
		</div>
		<hr style="width: 100%; color: black; height: 1px; background-color:black;" />
		<?php } } else { echo "<h5 class='text-center' > No Team Member Added</h5>
		<hr style='width: 100%; color: black; height: 1px; background-color:black;' />"; } ?>
	</div>
	
</div>


<!-- @vik Code for Add/Edit/Del User Team Members End-->
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
