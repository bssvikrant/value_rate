
<div id="menu1" class="tab-pane fade">
	<!--Overview Summery-->
 <?php
     $session = $this->request->session();
     $usertype = $session->read('User.type');
    // echo $usertype; die();   
 ?>  
	<?php 
		if(count($userInfo['user_executive_summaries'])){

			foreach ($userInfo['user_executive_summaries'] as $summary) {
	?>
			<div class="osum-area">
				<div class="heading-box">
					<p class="head-p">

						<?php echo $summary['title']; ?>
					<?php	 if($usertype=='valuerater') { ?>
           
						<button type="button" class="btn btn-info btn-sm ratingmodal" exeicutive-id="<?php echo $summary['id']; ?>" data-toggle="modal" data-target="#exeicutiveRating">Add Rating</button>
			<?php	} ?>
					</p>
				</div>
				<p><?php echo $summary['description']; ?></p>
			</div>

	<?php		
			}

	} else { ?>

		<h5 class='text-center'>No Data Found.</h5>		
	<?php } ?>

</div>

