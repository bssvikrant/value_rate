
<div id="menu1" class="tab-pane fade">
	<!--Overview Summery-->
	<?php 
		if(count($userInfo['user_executive_summaries'])){
			
			foreach ($userInfo['user_executive_summaries'] as $summary) {
	?>
			<div class="osum-area">
				<div class="heading-box">
				<p class="head-p"><?php echo $summary['title']; ?></p>
				</div>
				<p><?php echo $summary['description']; ?></p>
			</div>

	<?php		
			}

	} else { ?>

		<h5 class='text-center'>No Data Found.</h5>		
	<?php } ?>

</div>