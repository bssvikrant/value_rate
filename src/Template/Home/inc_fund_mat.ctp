<div id="menu2" class="tab-pane fade">
	<!--Overview Summery-->
	<div class="osum-area funding">
		<div class="heading-box">
			<p class="head-p">Financial projections</p>
		</div>
		<?php if(count($userInfo['user_funding_materials'])){ ?>
		<div class="fundinf-text">
			<?php foreach($userInfo['user_funding_materials'] as $key => $doc){   ?> 
				<div class="row">
					<div class="col-lg-1 col-md-4 col-sm-4 col-xs-4">
						<p style="text-align:center" ><?php echo $key+1; ?><p>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<p style="text-align:center"" > <i class="fa fa-file-word-o"></i> <?php echo $doc['document_name']; ?><p>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<p style="text-align:center" ><?php echo date("F j, Y", strtotime($doc['create_date'])); ?></p>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<p style="text-align:center" >
							<?php if($doc['document_path']) { ?>
								<a title="Download Document" target="_blank" href="<?php echo HTTP_ROOT.'files/doc/'.$doc['document_path']; ?>" ><i class="fa fa-download"></i></a> 
							<?php } ?>
						</p>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<hr class="fun-line">
					</div>
				</div>
			<?php } ?>
		</div>
		<?php }else{ echo "<div class='fundinf-text'><div class='row'><div class='col-lg-12 col-md-4 col-sm-4 col-xs-4'><h5 class='text-center'>No data Found.</h5></div></div></div>"; } ?>
	</div>

	<!--/Overview Summery-->


	<!--[end of overview_management]-->


</div>