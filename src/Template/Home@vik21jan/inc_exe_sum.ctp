
<div id="menu1" class="tab-pane fade">
	<!--Overview Summery-->
	

<?php $i=0; if(str_replace(' ', '', $userInfo['user_executive_summary']['business_model'])){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Business Model</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['business_model']; ?></p>
	</div>
<?php $i++; } ?>

<?php if($userInfo['user_executive_summary']['product_roadmap']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Product Roadmap/Tech Stack</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['product_roadmap']; ?></p>
	</div>
<?php $i++; } ?>

<?php if($userInfo['user_executive_summary']['customers']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Customers</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['customers']; ?></p>

	</div>
<?php $i++; } ?>
	
<?php if($userInfo['user_executive_summary']['target_markit']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Target Market</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['target_markit']; ?></p>
	</div>
<?php $i++; } ?>

<?php if($userInfo['user_executive_summary']['revenue_model']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Revenue Model</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['revenue_model']; ?></p>
	</div>
<?php $i++; } ?>

<?php if($userInfo['user_executive_summary']['buzz']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Buzz</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['buzz']; ?></p>
	</div>
<?php $i++; } ?>
	
<?php if($userInfo['user_executive_summary']['exit_plan']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Exit Plan</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['exit_plan']; ?></p>
	</div>
<?php $i++; } ?>
	
<?php if($userInfo['user_executive_summary']['financial']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Financial</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['financial']; ?></p>
	</div>
<?php $i++; } ?>
	
<?php if($userInfo['user_executive_summary']['valuation']){ ?>
	<div class="osum-area">
		<div class="heading-box">
			<p class="head-p">Valuations</p>
		</div>
		<p><?php echo $userInfo['user_executive_summary']['valuation']; ?></p>
	</div>
<?php $i++; } ?>
	<!--/Overview Summery-->

<?php if(!$i){ ?>
	
	<h5 class='text-center'>No Data Found.</h5>
	
<?php } ?>
	<!--[end of overview_management]-->


</div>