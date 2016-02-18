<div class="x_panel">
	
	<div class="x_title">
		<h2>Financial Projections<small></small></h2>
		<a href="<?php echo HTTP_ROOT."users/create-doc/".base64_encode(convert_uuencode($userInfo->id));?>">
			<button class="btn btn-default pull-right" type="button"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span> Add Document</button>
		</a>
		<div class="clearfix"></div>
	</div>

	<div class="x_content">
	<?php 
		
		$userFundingMaterials = $userInfo->user_funding_materials;
		if(count($userFundingMaterials)){
			foreach($userFundingMaterials as $fmdoc){
	?>
		 <div class="row">
			<div class="col-sm-12">
				<div class="col-sm-4">
				<h2>
					<i class="fa fa-file-word-o"></i>
					<a href="<?php echo HTTP_ROOT.'files/doc/'.$fmdoc->document_path; ?>" target="_blank"><?php echo $fmdoc->document_name; ?></a>
				</h2>
				</div>
				
				<div class="col-sm-4">
				<h2>
					<?php echo date("F j, Y", strtotime($fmdoc->create_date)); ?>
				</h2>
				</div>
				
				<div class="col-sm-4">
				<h2>
					<a title="Edit Document" href="<?php echo HTTP_ROOT."users/edit-doc/".base64_encode(convert_uuencode($userInfo->id))."/".$fmdoc->id; ?>"><span><i class="fa fa-pencil-square"></i></span></a> | 
					<?php if($fmdoc->document_path) { ?>
					<a title="Download Document" target="_blank" href="<?php echo HTTP_ROOT.'files/doc/'.$fmdoc->document_path; ?>" ><i class="fa fa-download"></i></a> |
					<?php } ?>
					<a title="Delete Document" href="<?php echo HTTP_ROOT."users/delete-row/".'UserFundingMaterials'.'/'.base64_encode(convert_uuencode($fmdoc->id));?>" onclick="if(!confirm('Are you sure to delete this Document ?')){return false;}" ><span class="fa fa-fw fa-trash-o"></span></a>					
					

				</h2>
				</div>
			</div>
		</div>
		<hr style="width: 100%; color: black; height: 1px; background-color:black;" />
	<?php } }else{ echo "<h5  class='text-center' > No Document Found. </h5>"; } ?>	
	</div>
</div>

