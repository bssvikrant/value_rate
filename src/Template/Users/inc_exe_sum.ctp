<div class="x_panel">
	
	<div class="x_title">
		<h2>executive summry<small></small></h2>
		<a href="<?php echo HTTP_ROOT."users/add_summary/".base64_encode(convert_uuencode($userInfo->id));?>">
			<button class="btn btn-default pull-right" type="button"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span> Add Summary</button>
		</a>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
		<?= $this->element('adminElements/validations'); ?>
		<!--Form edit user -->
			<?php echo $this->Form->create(null, [
				'url' => ['controller' => 'users', 'action' => 'executive-summary',base64_encode(convert_uuencode($userInfo->id))],
				'class'=>'form-horizontal form-label-left input_mask',
				'id'=>'edituser',
				'style'=>'margin-top: 10px !important;float: left;',
				'enctype'=>'multipart/form-data',
				'novalidate'=>'novalidate'
			]);
			echo $this->Form->hidden('Users.user_executive_summary.id',['value'=>$userInfo->user_executive_summary->id != '' ?$userInfo->user_executive_summary->id:'']);
			?>
  <div class="x_content">
		<?php
		$exicutiveData = $userInfo->user_executive_summaries;
		if(count($teamData)){
			foreach ($exicutiveData as $exicutive){ 
		?>		
		 <div class="row">
			<div class="col-sm-12">
				<div class="col-sm-12">
					<h1><?php echo $exicutive->title; ?></h1>
					<p>	<?php echo $exicutive->description; ?></p>
					<a title="Delete Team Member" href="<?php echo HTTP_ROOT."users/delete-row/".'UserExecutiveSummaries'.'/'.base64_encode(convert_uuencode($exicutive->id));?>" onclick="if(!confirm('Are you sure to delete this Member ?')){return false;}" ><span class="fa fa-fw fa-trash-o"></span></a>
						<a title="Edit Team Member" href="<?php echo HTTP_ROOT."users/editsummary/".base64_encode(convert_uuencode($userInfo->id))."/".$exicutive->id; ?>"><span><i class="fa fa-pencil-square"></i></span></a>
				</div>
			</div>
		</div>
		<hr style="width: 100%; color: black; height: 1px; background-color:black;" />
		<?php } } else { echo "<h5 class='text-center' > No Executive Summary Added</h5>
		<hr style='width: 100%; color: black; height: 1px; background-color:black;' />"; } ?>
	</div>
			<?php echo $this->form->end(); ?>
		<!-- end form -->
	</div>
</div>

